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
                'product_name',
                'type_name',
                'taste_name',
                'uri',
                'url'], 'string', 'max' => 150],
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
            'product_id' => 'ID продукта',
            'type_id' => 'ID типа продукта',
            'taste_id' => 'ID вкуса',
            'product_name' => 'Продукт',
            'type_name' => 'Тип продукта',
            'taste_name' => 'Вкус продукта',
            'count' => 'количество',
            'sum' => 'сумма',
            'has_box' => 'является набором',
        ];
    }

    public function sentSms()
    {
        $sms_api_key    = '97088CD0-2518-83A5-A2D0-8121DA5F515A';
        $sms_phone      = '79263426912';
        $sms_message    = urlencode('Inchoco.ru: новый заказ № '.$this->number.'!' );
        $sms_url        = "https://sms.ru/sms/send?api_id=$sms_api_key&to=$sms_phone&msg=$sms_message&json=1";
        $body           = file_get_contents( $sms_url );
    }
}
