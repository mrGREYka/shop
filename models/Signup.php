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
                ], 'required', 'message' => 'Поле обязательно для заполнения!',
            ],
            ['username', 'unique', 'targetClass' => 'app\models\User', 'message' => 'Имя пользователя уже используется на сайте!', ],
            ['email', 'email', 'message' => 'Укажите почтовый адрес!', ],
            ['email', 'unique', 'targetClass' => 'app\models\User', 'message' => 'Почтовый адрес уже используется!', ],
            ['password', 'string', 'min' => 8, 'max'=> 12, 'message' => 'Длина пароля от 8 до 12 символов!', ],
            ['password', 'validatePassword' ],
            ['password_correct', 'validatePassword' ],
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
