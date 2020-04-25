<?php

namespace app\models;

use Yii;
use yii\web\NotFoundHttpException;

/**
 * This is the model class for table "item_order".
 *
 * @property int $id
 * @property int $order_id
 * @property int $group_product_id
 * @property int $product_id
 * @property int $count
 * @property string $price
 * @property string $sum
 *
 * @property GroupProduct $groupProduct
 * @property Order $order
 * @property Product $product
 */
class ItemOrder extends \yii\db\ActiveRecord
{
    const FOIL_SILVER   = 1;
    const FOIL_GOLD     = 2;
    const FOIL_MIX      = 3;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'item_order';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [

            ['product_id', 'integer', 'message'=>'Не выбран товар!'],
            ['taste_id', 'integer', 'message'=>'Не выбран вкус товара!'],

            [['order_id', 'group_product_id', 'count', 'foil'], 'integer'],
            [['price', 'sum'], 'number', 'message'=>'Укажите число!' ],
            [['group_product_id'], 'exist', 'skipOnError' => true, 'targetClass' => GroupProduct::className(), 'targetAttribute' => ['group_product_id' => 'id']],
            [['order_id'], 'exist', 'skipOnError' => true, 'targetClass' => Order::className(), 'targetAttribute' => ['order_id' => 'id']],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Product::className(), 'targetAttribute' => ['product_id' => 'id']],
            [['taste_id'], 'exist', 'skipOnError' => true, 'targetClass' => Taste::className(), 'targetAttribute' => ['taste_id' => 'id']],

            ['group_product_id', 'required', 'message'=>'Не выбрана группа товаров!'],
            ['product_id', 'required', 'message'=>'Не выбран товар!'],
            ['taste_id', 'required', 'message'=>'Не выбран вкус товара!'],
            ['count', 'required', 'message'=>'Не указано количество!'],
            ['sum', 'required', 'message'=>'Не указана сумма!'],

            ['foil', 'default', 'value' => self::FOIL_SILVER],
            ['foil', 'in', 'range' => [
                self::FOIL_SILVER,
                self::FOIL_GOLD,
                self::FOIL_MIX, ]
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'order_id' => 'Заказ',
            'group_product_id' => 'Группа товаров',
            'product_id' => 'Товар',
            'taste_id' => 'Вкус',
            'foil' => 'Фольга',
            'count' => 'Количество',
            'price' => 'Цена',
            'sum' => 'Сумма',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGroupProduct()
    {
        return $this->hasOne(GroupProduct::className(), ['id' => 'group_product_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrder()
    {
        return $this->hasOne(Order::className(), ['id' => 'order_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Product::className(), ['id' => 'product_id']);
    }

    public function getTaste()
    {
        return $this->hasOne(Taste::className(), ['id' => 'taste_id']);
    }

    public function afterSave($insert, $changedAttributes)
    {

        $order      = $this->order;
        $order->sum = $order->countSum( );
        if (!$order->save( )) {
            throw new NotFoundHttpException('Ошибка записи заказа! По какой-то причине не удается перезаписать заказ!');
        }



        //var_dump( $this->order );
    }

    public function afterDelete( ) {
        $order      = $this->order;
        $order->sum = $order->countSum( );
        if (!$order->save( )) {
            throw new NotFoundHttpException('Ошибка записи заказа! По какой-то причине не удается перезаписать заказ!');
        }
    }
}
