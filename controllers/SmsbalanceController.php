<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\httpclient\Client;

/**
 * BalanceController implements the CRUD actions for Balance model.
 */
class SmsbalanceController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['get' ],
                'rules' => [
                    [
                        'actions' => ['get' ],
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
     * Lists all Balance models.
     * @return mixed
     */
    public function actionGet()
    {

        $sms_api_key    = Yii::$app->params['sms_api'];
        $client         = new Client( [ 'baseUrl' => 'https://sms.ru' ] );
        $response       = $client->get('my/balance', [ 'api_id' => $sms_api_key, 'json' => 1 ] )->send( );

        /*echo '<pre>';
        var_dump($response->data['status_text']);
        var_dump($response->data['status']);
        echo '</pre>';
        die;*/

        if ($response->isOk) {
            if ( $response->data["status_code"] === 100 ) {
                return $response->data['balance'];
            } else {
                return $response->data['status_text'];
            }
        } else {
            return "Not connect...";
        }

    }
}
