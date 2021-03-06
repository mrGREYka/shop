<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

class User extends ActiveRecord implements \yii\web\IdentityInterface
{

    public static function tableName()
    {
        return 'user';
    }

    public function rules()
    {
        return [
            [['username', 'password'], 'required'],
            [['status'], 'integer'],
            [['email',
                'username',
                'name_f',
                'name_i',
                'name_o',
                'email',
                'phone',
                'password',
                ], 'string', 'max' => 50],
        ];
    }

    public function attributeLabels()
    {
        return [
            'username ' => 'Логин',
            'name_f ' => 'Фамилия',
            'name_i ' => 'Имя',
            'name_o ' => 'Отчество',
            'email ' => 'Почта',
            'phone ' => 'Телефон',
            'password ' => 'Пароль',
            'status' => 'Доступ',
        ];
    }

    public static function findIdentity($id)
    {
        return self::findOne($id);
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return self::findOne( [ 'accessToken' => $token ] );
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return self::findOne( [ 'username' => $username ] );
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        return $this->authKey;
    }

    public function getOrder( )
    {
        return $this->hasMany( Order::className( ), [ 'user_id' => 'id' ] );
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return $this->password === $password;
    }

    public function validateStatus()
    {
        return $this->status === 1;
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($this->isNewRecord) {
                $this->accessToken = hash('sha256',$this->email.Yii::$app->params['salt']);
                $this->authKey= hash('sha256',$this->username.Yii::$app->params['salt']);
            }
            return true;
        }
        return false;
    }

}
