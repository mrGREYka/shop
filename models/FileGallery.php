<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "file_gallery".
 *
 * @property int $id
 * @property int $gallery_id
 * @property string $title
 * @property string $filename
 * @property string $filepath
 * @property string $filename_thumb
 * @property string $filepath_thumb
 *
 * @property Gallery $gallery
 */
class FileGallery extends \yii\db\ActiveRecord
{

    public $image;
    public $image_thumb;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'file_gallery';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['gallery_id'], 'integer'],
            [['title', 'filename', 'filepath', 'filename_thumb', 'filepath_thumb'], 'string', 'max' => 255],
            [['gallery_id'], 'exist', 'skipOnError' => true, 'targetClass' => Gallery::className(), 'targetAttribute' => ['gallery_id' => 'id']],
            [['image'], 'file', 'extensions' => 'png, jpg', 'maxFiles' => 1],
            [['image_thumb'], 'file', 'extensions' => 'png, jpg', 'maxFiles' => 1],
            [['gallery_id', 'image', 'image_thumb',], 'required'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'gallery_id' => 'Галлерея',
            'title' => 'Наименование',
            'filename' => 'Имя картинки',
            'filepath' => 'Путь к файлу картинки',
            'filename_thumb' => 'Имя представления картинки',
            'filepath_thumb' => 'Пуь к файлу представления картинки',
            'image' => 'Картинка',
            'image_thumb' => 'Представление картинки',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGallery()
    {
        return $this->hasOne(Gallery::className(), ['id' => 'gallery_id']);
    }
}
