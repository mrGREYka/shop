<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\Signup;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect( ['/site/login'] );
        } else {
            return $this->render('index');
        }    
    }

    
    public function actionLogin()
    {
        if ( Yii::$app->user->isGuest ) {

            $model = new LoginForm();
            if ( $model->load( Yii::$app->request->post( ) ) && $model->login( ) ) {
                return $this->redirect( ['/'] ) ;
            }

            $model->password = '';
            return $this->render('login', [
                'model' => $model,
            ]);
            
        } else {
            
            return $this->redirect( ['/'] ) ;        

        }
    }

    
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->redirect( ['/site/login'] ) ;
    }

    public function actionSignup( )
    {
        if ( Yii::$app->user->isGuest ) {

            $model = new Signup();
            
            if (isset( $_POST[ 'Signup' ] )) {
                $model->attributes = Yii::$app->request->post( 'Signup' );

                if ( $model->validate( ) && $model->signup( ) )  {

                    Yii::$app->session->setFlash('signup');
                    $model->contact();
                    return $this->redirect( [ '/site/login' ] );
                }

            }

            return $this->render('signup', [ 'model' => $model ] );

        } else {
            return $this->redirect( ['/'] ) ;
        }    
    }

    public function actionDownload($filename)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect( ['/site/login'] ) ;
        } else {
            return \Yii::$app->response->sendFile( "c:\\path\\$filename" );
        }
    }
}
