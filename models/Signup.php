<?php

namespace app\models;

use yii\base\Model;
use Yii;

class Signup extends Model
{
	public $username;
    public $name_f;
    public $name_i;
    public $name_o;

	public $email;
    public $phone;
	public $password;
    public $password_correct;

	public $fild_number;
    public $fild_number_cad;

    public $pass_series;
    public $pass_number;
    public $pass_given;

    public $post_code;
    public $entity_rf;
    public $city;
    public $region;
    public $settlement;
    public $street;
    public $house_number;
    public $building_number;
    public $apartment_number;

    public $consent;

    public $verifyCode;

	public function rules()
    {
        return [
            [
                [
                    'username',
                    'name_f',
                    'name_i',
                    'name_o',

                    'email',
                    'phone',
                    'password',
                    'password_correct',

                    'fild_number',
                    'fild_number_cad',

                    'pass_series',
                    'pass_number',
                    'pass_given',
                ], 'required', 'message' => 'Поле обязательно для заполнения!',
            ],
            ['username', 'unique', 'targetClass' => 'app\models\User', 'message' => 'Имя пользователя уже используется на сайте!', ],

            ['email', 'email', 'message' => 'Укажите почтовый адрес!', ],
            ['email', 'unique', 'targetClass' => 'app\models\User', 'message' => 'Почтовый адрес уже используется!', ],

            ['fild_number', 'integer', 'message' => 'Можно указать только целое число!', ],
            ['fild_number_cad', 'integer', 'message' => 'Можно указать только целое число!', ],

            ['password', 'string', 'min' => 8, 'max'=> 12, 'message' => 'Длина пароля от 8 до 12 символов!', ],
            ['password', 'validatePassword' ],
            ['password_correct', 'validatePassword' ],

            ['pass_series', 'integer', 'message' => 'Можно указать только целое число!', ],
            ['pass_number', 'integer', 'message' => 'Можно указать только целое число!', ],

            ['post_code', 'integer', 'message' => 'Можно указать только целое число!', ],
            ['entity_rf', 'string', ],
            ['city', 'string', ],
            ['region', 'string', ],
            ['settlement', 'string', ],
            ['street', 'string', ],
            ['house_number', 'string', ],
            ['building_number', 'string', ],
            ['apartment_number', 'string', ],

            ['consent', 'validateConsent' ],


            ['verifyCode', 'captcha', 'message' => 'Код с картинки введен не верно!' ],
        ];
    }
	
    public function signup()
    {
        $user                   = new User();
        $user->username         = $this->username;
        $user->name_f           = $this->name_f;
        $user->name_i           = $this->name_i;
        $user->name_o           = $this->name_o;

        $user->email            = $this->email;
        $user->phone            = $this->phone;
        $user->password         = $this->password;
        $user->fild_number      = $this->fild_number;
        $user->fild_number_cad  = $this->fild_number_cad;

        $user->pass_series      = $this->pass_series;
        $user->pass_number      = $this->pass_number;
        $user->pass_given       = $this->pass_given;

        $user->post_code        = $this->post_code;
        $user->entity_rf        = $this->entity_rf;
        $user->city             = $this->city;
        $user->region           = $this->region;
        $user->settlement       = $this->settlement;
        $user->street           = $this->street;
        $user->house_number     = $this->house_number;
        $user->building_number  = $this->building_number;
        $user->apartment_number = $this->apartment_number;

        return $user->Save();
    }

    public function contact($htmlBody)
    {
        $adminEmail = Yii::$app->params['adminEmail'];

        Yii::$app->mailer->compose()
            ->setTo($this->email)
            ->setFrom( 'robot@tyulyakov.ru' )
            ->setSubject('Подтверждение регистрации shop.tyulyakov.ru')
            ->setHTMLBody( $htmlBody )
            ->send() ;

        Yii::$app->mailer->compose()
            ->setTo($adminEmail)
            ->setFrom( 'robot@tyulyakov.ru' )
            ->setSubject('Новая регистрация shop.tyulyakov.ru')
            ->setHTMLBody( $htmlBody )
            ->send() ;    
            
    }

    public function validatePassword( $attribute, $params ){
        if ($this->password_correct != $this->password) {
	        $this->addError( $attribute, 'Пароль и подтверждение пароля не совпадают!' );
        }
    }

    public function validateConsent( $attribute, $params ){
	    if ($this->consent != 1) {
            $this->addError( $attribute, 'Необходимо подтверждение!' );
        }
    }
}
