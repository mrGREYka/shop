<?php

namespace app\controllers;

use app\models\Partner;
use app\models\ItemOrder;
use app\models\Order;
use app\models\Product;
use yii\rest\Controller;
use yii\filters\auth\HttpBasicAuth;
use Yii;

class ApiorderController extends Controller
{

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class' => HttpBasicAuth::className(),
        ];
        return $behaviors;
    }

    public function actionNew()
    {
        $model              = new Order();
        $model->attributes  = Yii::$app->request->post();
        $partner            = Partner::find()->where(['phone' => $model->phone])->one();

        if ( empty( $partner ) ) {
            $partner = new Partner();
            $partner->name = $model->username;
            $partner->phone = $model->phone;
            $partner->email = $model->email;
            $partner->type = 0;
            $partner->save();
        }

        $model->partner_id = $partner->id;
        $model->interaction = Order::INTERACTION_EMAIL;

        if ( $model->save( ) ) {

            $itemOrder = new ItemOrder();

            $product = Product::find()->where(['id' => $model->product_id])->one();
            $itemOrder->order_id            = $model->id;
            $itemOrder->product_id          = $product->id;
            $itemOrder->group_product_id    = $product->group_product_id;
            $itemOrder->taste_id            = $model->taste_id;
            $itemOrder->count               = $model->count;
            $itemOrder->sum                 = $model->sum;
            $itemOrder->save();



            $model->sentSms();
            return $model;
        }

        return false;
    }
}
