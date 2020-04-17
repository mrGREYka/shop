<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use app\models\Order;
use app\models\OrderSerch;
use app\models\OrderPrintSerch;
use app\models\OrderMySerch;
use app\models\OrderWarehouseSerch;
use app\models\ItemOrder;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * OrderController implements the CRUD actions for order model.
 */
class OrderController extends Controller
{
    /**
     * {@inheritdoc}
     */

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index','view','create','update','createitem', 'deleteitem', 'print', 'my', 'warehouse'],
                'rules' => [
                    [
                        'actions' => ['index','view','create','update','createitem', 'deleteitem', 'print', 'my', 'warehouse'],
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
     * Lists all order models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new OrderSerch();

        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->pagination = ['pageSize' => 20];

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionPrint()
    {
        $searchModel = new OrderPrintSerch();

        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->pagination = ['pageSize' => 20];

        return $this->render('print', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionMy()
    {
        $searchModel = new OrderMySerch();

        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->pagination = ['pageSize' => 20];

        return $this->render('my', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionWarehouse()
    {
        $searchModel = new OrderWarehouseSerch();

        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->pagination = ['pageSize' => 20];

        return $this->render('warehouse', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }



    /**
     * Displays a single order model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id, $breadcrumbs_label = null, $breadcrumbs_url = null)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
            'breadcrumbs_label' => $breadcrumbs_label,
            'breadcrumbs_url' => $breadcrumbs_url,
            ]);

    }

    /**
     * Creates a new order model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($partner_id = null )
    {
        $model = new order();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            // $model->sentSms(); // не используем, т-к при записи заказа у него еще не будет позиций товароы

            return $this->redirect(['view', 'id' => $model->id]);
        }

        if ( $partner_id != null ) {
            $model->partner_id = $partner_id;
        }

        return $this->render('create', [
            'model' => $model,
        ]);

    }

    /**
     * Updates an existing order model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id, $breadcrumbs_label = null, $breadcrumbs_url = null)
    {

        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view',
                'id' => $model->id,
                'breadcrumbs_label' => $breadcrumbs_label,
                'breadcrumbs_url' => $breadcrumbs_url,
            ]);
        }

        return $this->render('update', [
            'model' => $model,
            'breadcrumbs_label' => $breadcrumbs_label,
            'breadcrumbs_url' => $breadcrumbs_url,
        ]);

    }

    public function actionCreateitem($id, $breadcrumbs_label = null, $breadcrumbs_url = null)
    {
        $model_item             = new ItemOrder();
        $model_item->order_id   = $id;

        if ($model_item->load(Yii::$app->request->post()) && $model_item->save()) {

            $order = Order::findOne($id);
            $order->sum = $order->countSum();
            $order->save();

            return $this->redirect(['view',
                'id' => $id,
                'breadcrumbs_label' => $breadcrumbs_label,
                'breadcrumbs_url' => $breadcrumbs_url,
            ]);
        }

        return $this->render('itemcreate', [
            'model' => $model_item,
            'order_id' => $id,
            'breadcrumbs_label' => $breadcrumbs_label,
            'breadcrumbs_url' => $breadcrumbs_url,
        ]);

    }

    public function actionUpdateitem($id, $breadcrumbs_label = null, $breadcrumbs_url = null)
    {

        $model_item = ItemOrder::findOne($id);

        if ($model_item->load(Yii::$app->request->post()) && $model_item->save()) {
            return $this->redirect(['view',
                'id' => $model_item->order_id,
                'breadcrumbs_label' => $breadcrumbs_label,
                'breadcrumbs_url' => $breadcrumbs_url,
            ]);
        }

        return $this->render('itemupdate', [
            'model' => $model_item,
            'order_id' => $model_item->order_id,
            'breadcrumbs_label' => $breadcrumbs_label,
            'breadcrumbs_url' => $breadcrumbs_url,
        ]);

    }

    public function actionDeleteitem($id)
    {
        $model_item = ItemOrder::findOne($id);
        $order_id   = $model_item->order_id;
        $model_item->delete( );

        $order = Order::findOne($order_id);
        $order->sum = $order->countSum();
        $order->save();

        return $this->redirect(['view', 'id' => $order_id]);

    }

    /**
     * Finds the order model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return order the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = order::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
