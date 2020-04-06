<?php

namespace app\models;

use app\models\ItemOrder;
use app\controllers\AppController;


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
    const STATUS_NEW                = 1;
    const STATUS_ON_COORDINATION    = 2;
    const STATUS_AGREED             = 3;
    const STATUS_PRINTED            = 4;
    const STATUS_COLLECTED          = 5;
    const STATUS_IN_DELIVERY        = 6;
    const STATUS_DELIVERED          = 7;
    const STATUS_CANCEL             = 0;

    const TIME_FINISH_10_18         = 0;
    const TIME_FINISH_10_14         = 1;
    const TIME_FINISH_14_18         = 2;
    const TIME_FINISH_18_22         = 3;

    const DELIVERY_COURIER          = 1;
    const DELIVERY_SDEK_PVZ         = 2;
    const DELIVERY_MAIL             = 3;
    const DELIVERY_SDEK_COURIER     = 4;
    const DELIVERY_OFFICE           = 5;

    const PAID_NO                   = 0;
    const PAID_YES                  = 1;

    const CONSIGNMENT_NOTE_NO       = 0;
    const CONSIGNMENT_NOTE_YES      = 1;

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
            [['partner_id'], 'required'],
            [['number',
                'dost',
                'product_id',
                'partner_id',
                'user_id',
                'type_id',
                'taste_id',
                'count',
                'has_box',
                'status',
                'paid',
                'consignment_note', ], 'integer'],
            [['sum'], 'number'],
            [['email',
                'username',
                'phone',
                'address',
                'datefinish',
                'timefinish',
                'promocode',
                'product_name',
                'type_name',
                'taste_name',
                'uri',
                'url'], 'string', 'max' => 150],
            [['comment',
                'message'], 'string'],

            ['timefinish', 'default', 'value' => self::TIME_FINISH_10_18],
            ['timefinish', 'in', 'range' => [
                self::TIME_FINISH_10_18,
                self::TIME_FINISH_10_14,
                self::TIME_FINISH_14_18,
                self::TIME_FINISH_18_22, ]
            ],
            ['status', 'default', 'value' => self::STATUS_NEW],
            ['status', 'in', 'range' => [
                self::STATUS_NEW,
                self::STATUS_ON_COORDINATION,
                self::STATUS_AGREED,
                self::STATUS_PRINTED,
                self::STATUS_COLLECTED,
                self::STATUS_IN_DELIVERY,
                self::STATUS_DELIVERED,
                self::STATUS_CANCEL, ]
            ],
            ['dost', 'default', 'value' => self::DELIVERY_COURIER],
            ['dost', 'in', 'range' => [
                self::DELIVERY_COURIER,
                self::DELIVERY_SDEK_PVZ,
                self::DELIVERY_MAIL,
                self::DELIVERY_SDEK_COURIER,
                self::DELIVERY_OFFICE, ]
            ],
            ['paid', 'default', 'value' => self::PAID_NO],
            ['paid', 'in', 'range' => [
                self::PAID_NO,
                self::PAID_YES, ]
            ],
            ['consignment_note', 'default', 'value' => self::CONSIGNMENT_NOTE_NO],
            ['consignment_note', 'in', 'range' => [
                self::CONSIGNMENT_NOTE_NO,
                self::CONSIGNMENT_NOTE_YES, ]
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Номер',
            'number' => 'Номер',
            'created' => 'Дата',
            'partner_id' => 'Партнер',
            'user_id' => 'Менеджер',
            'email' => 'Почта клиента',
            'username' => 'Имя клиента',
            'phone'  => 'Телефон',
            'address' => 'Адрес',
            'dost' => 'Тип доставки',
            'datefinish' => 'Дата завершения',
            'timefinish' => 'Время завершения',
            'comment' => 'Комментарий',
            'message' => 'Сообщение',
            'promocode' => 'Промокод',
            'product_id' => 'ID продукта',
            'type_id' => 'ID типа продукта',
            'taste_id' => 'ID вкуса',
            'product_name' => 'Продукт',
            'type_name' => 'Тип продукта',
            'taste_name' => 'Вкус продукта',
            'count' => 'Количество',
            'sum' => 'Сумма',
            'has_box' => 'Является набором',
            'status' => 'Статус',
            'paid' => 'Оплачен',
            'consignment_note' => 'ТНакладная',
        ];
    }

    public function getPartner( )
    {
        return $this->hasOne( Partner::className( ), [ 'id' => 'partner_id' ] );
    }

    public function getUser( )
    {
        return $this->hasOne( User::className( ), [ 'id' => 'user_id' ] );
    }

    public function getItemsorder( )
    {
        return $this->hasMany( ItemOrder::className( ), [ 'order_id' => 'id' ] );
    }

    public function countSum( )
    {
        return floatval( yii::$app->db->createCommand( "SELECT SUM([[sum]]) FROM {{item_order}} WHERE [[order_id]]=:order_id" )->bindValue( ':order_id', $this->id )->queryScalar());
    }

    public function sentSms()
    {
        $sms_api_key    = '0D285306-FD12-F190-3ED1-3966142C80EB';

// используем данную логику, т-к старая архитектура пока используется
        if ( empty( $this->partner ) ) {
// если указан партнер в заказе, берем телефон из партнера
            $sms_phone = $this->phone;
        } else {
// если партнер не указан в заказе, берем телефон из заказа
            $sms_phone = $this->partner->phone;
        }

        $sms_phone = str_replace("+", "", $sms_phone );
        $sms_phone = str_replace("(", "", $sms_phone );
        $sms_phone = str_replace(")", "", $sms_phone );
        $sms_phone = str_replace("-", "", $sms_phone );

        $sms_message    = urlencode('Ваш заказ №'.$this->id.' на сумму '.$this->sum.'₽ принят. Ожидайте ответ на E-mail.' );
        $sms_url        = "https://sms.ru/sms/send?api_id=$sms_api_key&to=$sms_phone&msg=$sms_message&json=1";

        $body           = file_get_contents( $sms_url );
    }
}
