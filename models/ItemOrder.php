<?php

namespace app\models;

use Yii;

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
            [['order_id', 'group_product_id', 'product_id', 'count'], 'integer'],
            [['price', 'sum'], 'number'],
            [['group_product_id'], 'exist', 'skipOnError' => true, 'targetClass' => GroupProduct::className(), 'targetAttribute' => ['group_product_id' => 'id']],
            [['order_id'], 'exist', 'skipOnError' => true, 'targetClass' => Order::className(), 'targetAttribute' => ['order_id' => 'id']],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Product::className(), 'targetAttribute' => ['product_id' => 'id']],
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
}
