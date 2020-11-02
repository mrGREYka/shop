<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "partner".
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $phone
 * @property int $type
 */
class Partner extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'partner';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['phone'], 'required'],
            [['type'], 'integer'],
            [['name'], 'string', 'max' => 150],
            [['email'], 'string', 'max' => 100],
            [['phone'], 'string', 'max' => 50],
            [['comment'], 'string'],
            [['phone'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Наименование',
            'email' => 'Почта',
            'phone' => 'Телефон',
            'type' => 'Тип',
            'comment' => 'Комментарий',
        ];
    }

    public function getOrder( )
    {
        return $this->hasMany( Order::className( ), [ 'partner_id' => 'id' ] )->orderBy( 'id desc' );
    }

    public function getContacts( )
    {
        return $this->hasMany( Contact::className( ), [ 'partner_id' => 'id' ] );
    }
}
