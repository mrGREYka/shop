<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "taste_group_product".
 *
 * @property int $id
 * @property int $group_product_id
 * @property int $taste_id
 *
 * @property GroupProduct $groupProduct
 * @property Taste $taste
 */
class TasteGroupProduct extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'taste_group_product';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['group_product_id', 'taste_id'], 'integer'],
            [['group_product_id'], 'exist', 'skipOnError' => true, 'targetClass' => GroupProduct::className(), 'targetAttribute' => ['group_product_id' => 'id']],
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
            'group_product_id' => 'Группа товаров',
            'taste_id' => 'Вкус',
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
    public function getTaste()
    {
        return $this->hasOne(Taste::className(), ['id' => 'taste_id']);
    }
}
