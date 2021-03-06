<?php

namespace app\controllers;
use app\models\Product;
use app\models\GroupProduct;
use app\models\ProductapiSerch;
use yii\helpers\Url;
use yii;

class ApiproductController extends \yii\rest\Controller
{
    public function actionIndex()
    {
        $headers = Yii::$app->response->headers;
        $headers->add('Access-Control-Allow-Origin', '*');

        $result         = [];
        $searchModel = new ProductapiSerch();
        $products = $searchModel->search(Yii::$app->request->get())->getModels();

        foreach ($products as $product):

            $result_product = [];
            $result_product['nameProduct']  = $product->title;
            $result_product['typeProduct']  = $product->groupProduct->title;
            $result_product['id']           = $product->id;
            $result_product['hasBox']       = $product->has_box != 0;
            $result_product['kit']          = $product->kit != 0;;
            $result_product['withoutPhoto'] = $product->without_photo != 0;
            $result_product['description']  = $product->content;

            $result_product['attributes']   = $this->attribues_( $product );
            $result_product['price']        = $this->prices($product);
            $result_product['tasteSelect']  = $this->tastes( $product );
            $result_product['photos']       = $this->images( $product );


            $result[] = $result_product;

        endforeach;

        return $result;



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

    protected function tastes($product)
    {
        $tastes = $product->taste;
        $result = [];

        foreach ($tastes as $taste):
            $file_arr = [];
            $file_arr['id'] = $taste->id;
            $file_arr['name'] = $taste->title;
            $file_arr['included'] = true;
            $result[] = $file_arr;
        endforeach;

        return $result;
    }

    protected function attribues_($product)
    {
        $attributes_ = $product->attributes_;
        $result = [];

        foreach ($attributes_ as $attribute_):
            $file_arr = [];
            $file_arr['nameAt'] = $attribute_->title;
            $file_arr['valAtt'] = $attribute_->content;
            $result[] = $file_arr;
        endforeach;

        return $result;
    }

    protected function prices($product)
    {
        $prices = $product->price;
        $result = [];

        foreach ($prices as $price):
            $file_arr = [];
            $file_arr['minCount'] = $price->min_count;
            $file_arr['price'] = $price->price;
            $result[] = $file_arr;
        endforeach;

        if ( count($result) === 0 ) {
            $file_arr = [];
            $file_arr['minCount'] = 1;
            $file_arr['price'] = 0;
            $result[] = $file_arr;
        }

        return $result;
    }

}
