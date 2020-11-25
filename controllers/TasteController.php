<?php

namespace app\controllers;

use Yii;
use app\models\Taste;
use app\models\TasteGroupProduct;
use app\models\TasteProduct;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * TasteController implements the CRUD actions for Taste model.
 */
class TasteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index','view','create','update','tastesofgroup'],
                'rules' => [
                    [
                        'actions' => ['index','view','create','update','tastesofgroup'],
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
     * Lists all Taste models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Taste::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Taste model.
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
     * Creates a new Taste model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Taste();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Taste model.
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

    /* более не используется, т-к вкусы мы привязали к товару*/
    public function actionTastesofgroup($id){

        $rows = TasteGroupProduct::find()->where(['group_product_id' => $id])->all();

        if(count($rows)>0){
            $text =  '<option value>Выбор вкуса...</option>';

            foreach($rows as $row){
                $text = $text.'<option value='.$row->taste->id.'>'.$row->taste->title.'</option>';
            }

            return $text;
        }
        else{
            return '<option value>Отсутствуют вкусы по группе</option>';
        }

    }

    public function actionTastesofproduct($id){

        $rows = TasteProduct::find()->where(['product_id' => $id])->all();

        if(count($rows)>0){
            $text =  '<option value>Выбор вкуса...</option>';

            foreach($rows as $row){
                $text = $text.'<option value='.$row->taste->id.'>'.$row->taste->title.'</option>';
            }

            return $text;
        }
        else{
            return '<option value>Отсутствуют вкусы по товару</option>';
        }

    }

    /**
     * Finds the Taste model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Taste the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Taste::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
