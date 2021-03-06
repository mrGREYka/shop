<?php

namespace app\models;

use Yii;
use app\models\TasteGroupProduct;

/**
 * This is the model class for table "group_product".
 *
 * @property int $id
 * @property string $title
 * @property string $content
 *
 * @property Product[] $products
 */
class GroupProduct extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'group_product';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['content'], 'string'],
            [['title'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Наименование',
            'content' => 'Описание',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Product::className(), ['group_product_id' => 'id']);
    }



    public function getTastegroupproduct()
    {
        return $this->hasMany(TasteGroupProduct::className(), ['group_product_id' => 'id']);
    }

    public function getTastes()
    {
        return $this->hasMany(Taste::className(), ['id' => 'taste_id'])->via('tastegroupproduct');
    }
}
