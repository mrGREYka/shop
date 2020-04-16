<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use app\models\Product;
use app\models\ProductSerch;
use app\models\FileProduct;
use yii\web\Controller;
use yii\web\UploadedFile;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\FileHelper;

/**
 * ProductController implements the CRUD actions for Product model.
 */
class ProductController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index','view','create','update','productsofgroup','createfile', 'deletefile' ],
                'rules' => [
                    [
                        'actions' => ['index','view','create','update','productsofgroup','createfile', 'deletefile' ],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Product models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProductSerch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Product model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Product model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Product();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Product model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Finds the Product model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Product the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */

    public function actionProductsofgroup($id){

        $rows = Product::find()->where(['group_product_id' => $id])->all();

        if(count($rows)>0){
            $text = '<option value>Выбор товара...</option>';
            foreach($rows as $row){
                $text = $text.'<option value='.$row->id.'>'.$row->title.'</option>';
            }
            return $text;
        }
        else{
            return '<option value>Отсутствуют товары по группе</option>';
        }

    }

    public function actionCreatefile( $id, $breadcrumbs_label = null, $breadcrumbs_url = null ){

        $model_file = new FileProduct();
        $model_file->product_id = $id;

        if ($model_file->load(Yii::$app->request->post())) {


            // иначе мне смог сделать проверку на обязательное указание файлов
            $model_file->image          = 1;
            $model_file->image_thumb    = 1;

            if ($model_file->validate()) {

                if ($model_file->save()) { // сохраним модель для уникальново имени файла картинки $file_thumb->baseName . $model_file->id

                    $file = UploadedFile::getInstance($model_file, 'image');
                    $patch_file = 'images/product/' . md5($file->baseName . $model_file->id) . '.' . $file->extension;

                    $file_thumb = UploadedFile::getInstance($model_file, 'image_thumb');
                    $patch_file_thumb = 'images/product/' . md5($file_thumb->baseName . $model_file->id.'thumb') . '.' . $file_thumb->extension;

                    if (($file->saveAs($patch_file)) && ($file_thumb->saveAs($patch_file_thumb))) {
                        $model_file->filename = $file->baseName . '.' . $file->extension;
                        $model_file->filepath = $patch_file;
                        $model_file->image = 1;

                        $model_file->filename_thumb = $file_thumb->baseName . '.' . $file_thumb->extension;
                        $model_file->filepath_thumb = $patch_file_thumb;
                        $model_file->image_thumb = 1;

                        if ($model_file->save()) {
                            return $this->redirect(['view',
                                'id' => $id,
                                'breadcrumbs_label' => $breadcrumbs_label,
                                'breadcrumbs_url' => $breadcrumbs_url,
                            ]);
                        }
                    }
                }
            }
        }

        return $this->render('filescreate', [
            'model' => $model_file,
            'breadcrumbs_label' => $breadcrumbs_label,
            'breadcrumbs_url' => $breadcrumbs_url,
        ]);
    }

    public function actionDeletefile($file_id, $breadcrumbs_label = null, $breadcrumbs_url = null)
    {
        $model_fileproduct = FileProduct::findOne($file_id);
        $id = $model_fileproduct->product_id;

        FileHelper::unlink($model_fileproduct->filepath);
        FileHelper::unlink($model_fileproduct->filepath_thumb);

        $model_fileproduct->delete();

        return $this->redirect(['view',
            'id' => $id,
            'breadcrumbs_label' => $breadcrumbs_label,
            'breadcrumbs_url' => $breadcrumbs_url,
        ]);
    }

    protected function findModel($id)
    {
        if (($model = Product::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
