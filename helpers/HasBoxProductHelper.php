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


class HasBoxProductHelper
{
    public static function statusList()
    {
        return [
            Product::HAS_BOX_YES => 'Да',
            Product::HAS_BOX_NO => 'Нет',
        ];
    }

    public static function statusName($status)
    {
        return ArrayHelper::getValue(self::statusList(), $status);
    }

    public static function statusLabel($status)
    {
        switch ($status) {
            case Product::HAS_BOX_YES:
                $class = 'label label-success';
                break;
            case Product::HAS_BOX_NO:
                $class = 'label label-danger';
                break;
            default:
                $class = 'label label-danger';
        }

        return Html::tag('span', ArrayHelper::getValue(self::statusList(), $status), [
            'class' => $class,
        ]);
    }
}