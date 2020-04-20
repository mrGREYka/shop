<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "file_product".
 *
 * @property int $id
 * @property int $product_id
 * @property string $title
 * @property string $filename
 * @property string $filepath
 * @property string $filename_thumb
 * @property string $filepath_thumb
 *
 * @property Product $product
 */
class FileProduct extends \yii\db\ActiveRecord
{

    public $image;
    public $image_thumb;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'file_product';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['product_id'], 'integer'],
            [['title', 'filename', 'filepath', 'filename_thumb', 'filepath_thumb'], 'string', 'max' => 255],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Product::className(), 'targetAttribute' => ['product_id' => 'id']],
            [['image'], 'file', 'extensions' => 'png, jpg', 'maxFiles' => 1, 'minSize' => 25000, 'maxSize' => 150000],
            [['image_thumb'], 'file', 'extensions' => 'png, jpg', 'maxFiles' => 1, 'minSize' => 5000, 'maxSize' => 40000],
            [['product_id','title',], 'required'],
            [['image','image_thumb',], 'required'],

        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'product_id' => 'Product ID',
            'title' => 'Краткое описание картинки',
            'filename' => 'Filename',
            'filepath' => 'Filepath',
            'filename_thumb' => 'Filename Thumb',
            'filepath_thumb' => 'Filepath Thumb',
            'image' => 'Картинка',
            'image_thumb' => 'Представление картики',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Product::className(), ['id' => 'product_id']);
    }
}
