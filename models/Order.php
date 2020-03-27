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
            'id' => 'Номер',
            'number' => 'Номер',
            'created' => 'Дата',
            'partner_id' => 'Партнер',
            'user_id' => 'Менеджер',
            'email' => 'Почта клиента',
            'username' => 'Имя клиента',
            'phone'  => 'Телефон',
            'address' => 'Адрес',
            'dost' => 'Доставка',
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

        $items = ItemOrder::findAll(['order_id' => $this->id]);
        $total = 0;

        foreach( $items as $itemorder ):
            $total = $total + $itemorder->sum;
        endforeach;

        return $total;

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
