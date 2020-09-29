<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "gallery".
 *
 * @property int $id
 * @property string $title
 * @property string $content
 *
 * @property FileGallery[] $fileGalleries
 */
class Gallery extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'gallery';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['content'], 'string'],
            [['title'], 'string', 'max' => 150],
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
    public function getFilesGallery()
    {
        return $this->hasMany(FileGallery::className(), ['gallery_id' => 'id']);
    }

    public function allFilesGallery( )
    {
        $files_gallery = $this->filesGallery;

        return \Yii::$app->view->render( 'all_files_gallery', [ 'files_gallery' => $files_gallery, ] );

    }
}
