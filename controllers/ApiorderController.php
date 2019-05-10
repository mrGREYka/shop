<?php

namespace app\controllers;

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
       $model = new \app\models\Order();


        $model->attributes = Yii::$app->request->post();

        if ( $model->save( ) ) {

            $model->sentSms();

            return $model;

        }

        return false;
    }
}
