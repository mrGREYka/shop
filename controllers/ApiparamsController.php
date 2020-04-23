<?php

namespace app\controllers;
use app\models\Params;
use yii;

class ApiparamsController extends \yii\rest\Controller
{
    public function actionIndex()
    {
        $headers = Yii::$app->response->headers;
        $headers->add('Access-Control-Allow-Origin', '*');

        $result = [];
        $params = Params::findOne(1);
        $result['cdek_url']             = $params->cdek_url;
        $result['three_shiping_sum']    = $params->three_shiping_sum;
        $result['up_1']                 = $params->up_1;
        $result['up_2']                 = $params->up_2;

        return $result;
    }
}
