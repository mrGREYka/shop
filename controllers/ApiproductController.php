<?php

namespace app\controllers;
use app\models\Product;
use app\models\GroupProduct;
use yii\helpers\Url;

class ApiproductController extends \yii\rest\Controller
{
    public function actionIndex($groupproduct_id = null)
    {
        $result         = [];
        $group_product  = GroupProduct::findOne($groupproduct_id);
        $products       = Product::find()->where( ['group_product_id' => $groupproduct_id ] ) ->all();
        foreach ($products as $product):

            $result_product = [];
            $result_product['nameProduct']  = $product->title;
            $result_product['typeProduct']  = $group_product->title;
            $result_product['id']           = $product->id;
            $result_product['hasBox']       = $product->has_box;
            $result_product['description']  = $product->content;

            $result_product['photos']       = $this->images($product);

            $result[] = $result_product;

        endforeach;

        return $result;


        //return Json.encode( Product::find()->all() );

        //return $this->images(5);

    }

    protected function images($product)
    {
        $files = $product->files;
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
