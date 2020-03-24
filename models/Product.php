<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "product".
 *
 * @property int $id
 * @property string $title
 * @property string $content
 * @property int $group_product_id
 *
 * @property GroupProduct $groupProduct
 */
class Product extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'product';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['content'], 'string'],
            [['group_product_id'], 'integer'],
            [['title'], 'string', 'max' => 255],
            [['group_product_id'], 'exist', 'skipOnError' => true, 'targetClass' => GroupProduct::className(), 'targetAttribute' => ['group_product_id' => 'id']],
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
            'group_product_id' => 'Группа товаров',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGroupProduct()
    {
        return $this->hasOne(GroupProduct::className(), ['id' => 'group_product_id']);
    }
}
