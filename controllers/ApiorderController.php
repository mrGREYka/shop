<?php

namespace app\controllers;

use app\models\Partner;
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
        $model              = new \app\models\Order();
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

        if ( $model->save( ) ) {
            $model->sentSms();
            return $model;
        }

        return false;
    }
}
