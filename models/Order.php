<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "order".
 *
 * @property int $id
 * @property int $number
 * @property string $email
 * @property string $username
 */
class Order extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'order';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['number',
                'dost',
                'product_id',
                'type_id',
                'taste_id',
                'count',
                'sum',
                'has_box'], 'integer'],
            [['email',
                'username',
                'phone',
                'address',
                'datefinish',
                'timefinish',
                'comment',
                'message',
                'promocode',
                'uri',
                'url'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Номер БД',
            'number' => 'Номер',
            'created' => 'Дата создания',
            'email' => 'Почта клиента',
            'username' => 'Имя клиента',
            'phone'  => 'телефон',
            'address' => 'адрес',
            'dost' => 'доставка',
            'datefinish' => 'дата завершения',
            'timefinish' => 'время завершения',
            'comment' => 'комментарий',
            'message' => 'сообщение',
            'promocode' => 'промокод',
            'product_id' => 'продукт',
            'type_id' => 'тип продукта',
            'taste_id' => 'вкус',
            'count' => 'количество',
            'sum' => 'сумма',
            'has_box' => 'является набором',
        ];
    }
}
