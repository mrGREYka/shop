<?php

namespace app\controllers;

use app\models\Partner;
use app\models\ItemOrder;
use app\models\Order;
use app\models\Product;
use app\models\User;
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
        $model->created     = date('Y-m-d');
        $partner            = Partner::find()->where(['phone' => $model->phone])->one();

        $user = User::findOne(20);

        if ( empty( $partner ) ) {
            $partner = new Partner();
            $partner->name = $model->username;
            $partner->phone = $model->phone;
            $partner->email = $model->email;
            $partner->type = 0;
            $partner->save();
        }

        $model->partner_id  = $partner->id;
        $model->interaction = Order::INTERACTION_EMAIL;
        $model->user_id     = $user->id;

        if ( $model->save( ) ) {

            $itemOrder = new ItemOrder();

            $product = Product::find()->where(['id' => $model->product_id])->one();
            $itemOrder->order_id            = $model->id;
            $itemOrder->product_id          = $product->id;
            $itemOrder->group_product_id    = $product->group_product_id;
            $itemOrder->taste_id            = $model->taste_id;
            $itemOrder->count               = $model->count;
            $itemOrder->price               = $product->getPriceByCount($model->count);
            $itemOrder->sum                 = $itemOrder->count * $itemOrder->price;
            $itemOrder->save();

            $model->refresh();
            $model->sentSms();

            return $model;
        } else {
            return serialize( $model->errors );
        }

        return false;
    }
}
