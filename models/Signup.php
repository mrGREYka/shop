<?php

namespace app\models;

use yii\base\Model;
use Yii;

class Signup extends Model
{
	public $username;
	public $email;
	public $password;
	public $fild_number;
    public $verifyCode;

	public function rules()
    {
        return [
            [['username', 'email', 'password', 'fild_number'], 'required', 'message' => 'Поле обязательно для заполнения!', ],
            ['username', 'unique', 'targetClass' => 'app\models\User', 'message' => 'Имя пользователя уже используется на сайте!', ],
            ['email', 'email', 'message' => 'Укажите почтовый адрес!', ],
            ['email', 'unique', 'targetClass' => 'app\models\User', 'message' => 'Почтовый адрес уже используется!', ],
            ['fild_number', 'integer', 'message' => 'Можно указать только целое число!', ],
            ['password', 'string', 'min' => 8, 'max'=> 12, 'message' => 'Длина пароля от 8 до 12 символов!', ],
            ['verifyCode', 'captcha', 'message' => 'Код с картинки введен не верно!' ],
        ];
    }
	
    public function signup()
    {
        $user               = new User();
        $user->username     = $this->username;
        $user->email        = $this->email;
        $user->password     = $this->password;
        $user->fild_number  = $this->fild_number;
        return $user->Save();
    }

    public function contact()
    {
        Yii::$app->mailer->compose()
            ->setTo($this->email)
            ->setFrom( 'sergey@shop' )
            ->setSubject('Подтверждение регистрации shop.tyulyakov.ru')
            ->setHTMLBody('Добрый день! Вы зарегистрированы. Пожалуйста не отвечайте на это письмо.' )
            ->send();
            
    }
}
