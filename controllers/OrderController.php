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
                'only' => ['index','view','create','update', 'copy', 'createitem', 'deleteitem', 'copyitem', 'print', 'my', 'warehouse'],
                'rules' => [
                    [
                        'actions' => ['index','view','create','update', 'copy', 'createitem', 'deleteitem', 'copyitem', 'print', 'my', 'warehouse'],
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
        $model = new Order();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            // $model->sentSms(); // не используем, т-к при записи заказа у него еще не будет позиций товароы

            return $this->redirect(['view', 'id' => $model->id]);
        }

        if ( $partner_id != null ) {
            $model->partner_id = $partner_id;
        }

        $model->created     = date('Y-m-d'); // новому заказу устанавливаем текущую дату

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

    public function actionCopy($id, $breadcrumbs_label = null, $breadcrumbs_url = null)
    {

        $model = $this->findModel($id);

        $model_copy = new Order();
        $model_copy->created = $model->created;
        $model_copy->partner_id = $model->partner_id;
        $model_copy->contact_id = $model->contact_id;
        $model_copy->user_id = $model->user_id;
        $model_copy->email = $model->email;

        if ( empty( $model->username ) ) {
            $model_copy->username = Yii::$app->user->identity;
        } else {
            $model_copy->username = $model->username;
        }

        $model_copy->phone = $model->phone;
        $model_copy->address = $model->address;
        $model_copy->dost = $model->dost;
        $model_copy->datefinish = $model->datefinish;
        $model_copy->dateend = $model->dateend;
        $model_copy->timefinish = $model->timefinish;
        $model_copy->comment = $model->comment;
        $model_copy->comment_user = $model->comment_user;
        $model_copy->message = $model->message;
        $model_copy->promocode = $model->promocode;
        $model_copy->sum = $model->sum;
        $model_copy->sum_delivery = $model->sum_delivery;
        $model_copy->sum_total = $model->sum_total;
        $model_copy->status = Order::STATUS_NEW;
        $model_copy->paid = Order::PAID_NO;
        $model_copy->consignment_note = $model->consignment_note;
        $model_copy->num_pack = $model->num_pack;
        $model_copy->weight = $model->weight;
        $model_copy->interaction = $model->interaction;

        if ($model_copy->save()) {
            $itemsorder = $model->itemsorder;
            foreach ($itemsorder as $itemorder):
                $model_copy_item = new ItemOrder();
                $model_copy_item->order_id = $model_copy->id;
                $model_copy_item->group_product_id = $itemorder->group_product_id;
                $model_copy_item->product_id = $itemorder->product_id;
                $model_copy_item->taste_id = $itemorder->taste_id;
                $model_copy_item->foil = $itemorder->foil;
                $model_copy_item->count = $itemorder->count;
                $model_copy_item->price = $itemorder->price;
                $model_copy_item->sum = $itemorder->sum;
                $model_copy_item->save();
            endforeach;

            return $this->redirect(['view',
                'id' => $model_copy->id,
                'breadcrumbs_label' => $breadcrumbs_label,
                'breadcrumbs_url' => $breadcrumbs_url,
            ]);
        }
    }

    public function actionCreateitem($id, $breadcrumbs_label = null, $breadcrumbs_url = null)
    {
        $model_item             = new ItemOrder();
        $model_item->order_id   = $id;

        if ($model_item->load(Yii::$app->request->post()) && $model_item->save()) {

            return $this->redirect(['view',
                'id' => $model_item->order_id,
                'breadcrumbs_label' => $breadcrumbs_label,
                'breadcrumbs_url' => $breadcrumbs_url,
            ]);
        }

        return $this->render('itemcreate', [
            'model' => $model_item,
            'order_id' => $model_item->order_id,
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

    public function actionCopyitem($id, $breadcrumbs_label = null, $breadcrumbs_url = null)
    {
        $model_item         = ItemOrder::findOne($id);
        $model_item_copy    = new ItemOrder();

        if ( $model_item_copy->load( Yii::$app->request->post( ) ) )  {
            $model_item_copy->order_id          = $model_item->order_id;
            if ( $model_item_copy->save() ) {
                return $this->redirect(['view',
                    'id' => $model_item->order_id,
                    'breadcrumbs_label' => $breadcrumbs_label,
                    'breadcrumbs_url' => $breadcrumbs_url,
                ]);
            }
        }


        $model_item_copy->order_id          = $model_item->order_id;
        $model_item_copy->group_product_id  = $model_item->group_product_id;
        $model_item_copy->product_id        = $model_item->product_id;
        $model_item_copy->taste_id          = $model_item->taste_id;
        $model_item_copy->foil              = $model_item->foil;
        $model_item_copy->count             = $model_item->count;
        $model_item_copy->price             = $model_item->price;
        $model_item_copy->sum               = $model_item->sum;

        return $this->render('itemcopy', [
            'model' => $model_item_copy,
            'order_id' => $model_item_copy->order_id,
            'breadcrumbs_label' => $breadcrumbs_label,
            'breadcrumbs_url' => $breadcrumbs_url,
        ]);

    }

    public function actionDeleteitem($id, $breadcrumbs_label = null, $breadcrumbs_url = null)
    {
        $model_item = ItemOrder::findOne($id);
        $model_item->delete( );

        return $this->redirect(['view',
            'id' => $model_item->order_id,
            'breadcrumbs_label' => $breadcrumbs_label,
            'breadcrumbs_url' => $breadcrumbs_url,
        ]);
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
        if (($model = Order::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
