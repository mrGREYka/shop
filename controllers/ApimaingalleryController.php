<?php

namespace app\controllers;
use app\models\Params;
use app\models\Gallery;
use yii\helpers\Url;
use yii;

class ApimaingalleryController extends \yii\rest\Controller
{
    public function actionIndex()
    {
        $headers = Yii::$app->response->headers;
        $headers->add( 'Access-Control-Allow-Origin', '*' );

        $params = Params::findOne(1);
        $gallery_id = $params->gallery_id;

        $gallery = Gallery::findOne($gallery_id);

        $result = $this->images($gallery);

        return $result;
    }

    protected function images($gallery)
    {
        $files = $gallery->filesGallery;
        $result = [];

        foreach ($files as $file):
            $file_arr = [];
            $file_arr['image'] = Url::to($file->filepath, true);
            $file_arr['alt'] = $file->title;
            $file_arr['imageThumb'] = Url::to($file->filepath_thumb, true);
            $result[] = $file_arr;
        endforeach;

        if ( count($result) === 0 ) {
            $file_arr = [];
            $file_arr['image'] = Url::to('images/nophoto.png', true);
            $file_arr['alt'] = 'без фото';
            $file_arr['imageThumb'] = Url::to('images/nophoto.png', true);
            $result[] = $file_arr;
        }

        return $result;
    }
}
