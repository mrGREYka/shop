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


class KitProductHelper
{
    public static function getList()
    {
        return [
            Product::KIT_YES => 'Да',
            Product::KIT_NO => 'Нет',
        ];
    }

    public static function getName($status)
    {
        return ArrayHelper::getValue(self::getList(), $status);
    }

    public static function getLabel($status)
    {
        switch ($status) {
            case Product::KIT_YES:
                $class = 'label label-success';
                break;
            case Product::KIT_NO:
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