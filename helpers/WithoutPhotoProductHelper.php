<?php
/**
 * Created by PhpStorm.
 * User: GREY
 * Date: 01.04.2020
 * Time: 2:02
 */

namespace app\helpers;

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use app\models\Product;


class WithoutPhotoProductHelper
{
    public static function getList()
    {
        return [
            Product::WITHOUT_PHOTO_YES => 'Да',
            Product::WITHOUT_PHOTO_NO => 'Нет',
        ];
    }

    public static function getName($status)
    {
        return ArrayHelper::getValue(self::getList(), $status);
    }

    public static function getLabel($status)
    {
        switch ($status) {
            case Product::WITHOUT_PHOTO_YES:
                $class = 'label label-success';
                break;
            case Product::WITHOUT_PHOTO_NO:
                $class = 'label label-danger';
                break;
            default:
                $class = 'label label-danger';
        }

        return Html::tag('span', ArrayHelper::getValue(self::getList(), $status), [
            'class' => $class,
        ]);
    }
}