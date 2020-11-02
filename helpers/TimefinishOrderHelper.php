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
use app\models\Order;


class TimefinishOrderHelper
{
    public static function getList()
    {
        return [
            Order::TIME_FINISH_10_18 => 'с 10.00 до 18.00',
            Order::TIME_FINISH_10_14 => 'с 10.00 до 14.00',
            Order::TIME_FINISH_14_18 => 'с 14.00 до 18.00',
            Order::TIME_FINISH_18_22 => 'с 18.00 до 22.00',
        ];
    }

    public static function getName($status)
    {
        return ArrayHelper::getValue(self::List(), $status);
    }

    public static function getLabel($status)
    {
        return Html::tag('span', ArrayHelper::getValue(self::getList(), $status), [ 'class' => 'label label-default', ]);
    }

    public static function intervalFrom($status)
    {
        switch ($status) {
            case Order::TIME_FINISH_10_18:
                $result = 10;
                break;
            case Order::TIME_FINISH_10_14:
                $result = 10;
                break;
            case Order::TIME_FINISH_14_18:
                $result = 14;
                break;
            case Order::TIME_FINISH_18_22:
                $result = 18;
                break;
            default:
                $result = 10;
        }

        return $result;
    }

    public static function intervalBy($status)
    {
        switch ($status) {
            case Order::TIME_FINISH_10_18:
                $result = 18;
                break;
            case Order::TIME_FINISH_10_14:
                $result = 14;
                break;
            case Order::TIME_FINISH_14_18:
                $result = 18;
                break;
            case Order::TIME_FINISH_18_22:
                $result = 22;
                break;
            default:
                $result = 18;
        }

        return $result;
    }
}