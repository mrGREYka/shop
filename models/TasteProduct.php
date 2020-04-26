<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "taste_product".
 *
 * @property int $id
 * @property int $product_id
 * @property int $taste_id
 *
 * @property Product $product
 * @property Taste $taste
 */
class TasteProduct extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'taste_product';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['product_id', 'taste_id'], 'integer'],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Product::className(), 'targetAttribute' => ['product_id' => 'id']],
            [['taste_id'], 'exist', 'skipOnError' => true, 'targetClass' => Taste::className(), 'targetAttribute' => ['taste_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'product_id' => 'Товар',
            'taste_id' => 'Вкус',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Product::className(), ['id' => 'product_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTaste()
    {
        return $this->hasOne(Taste::className(), ['id' => 'taste_id']);
    }
}
