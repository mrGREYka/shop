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


class DeliveryOrderHelper
{
    public static function getList()
    {
        return [
            Order::DELIVERY_COURIER => 'Курьер',
            Order::DELIVERY_SDEK_PVZ => 'Самовывоз СДЭК',
            Order::DELIVERY_MAIL => 'Почта России',
            Order::DELIVERY_SDEK_COURIER => 'Курьер СДЭК',
            Order::DELIVERY_OFFICE => 'Офис',
        ];
    }

    public static function getName($status)
    {
        return ArrayHelper::getValue(self::getList(), $status);
    }

    public static function getLabel($status)
    {
        switch ($status) {
            case Order::DELIVERY_COURIER:
                $class = 'badge badge-pill badge-light';
                break;
            case Order::DELIVERY_SDEK_PVZ:
                $class = 'badge badge-pill badge-info';
                break;
            case Order::DELIVERY_MAIL:
                $class = 'badge badge-pill badge-primary';
                break;
            case Order::DELIVERY_SDEK_COURIER:
                $class = 'badge badge-pill badge-secondary';
                break;
            case Order::DELIVERY_OFFICE:
                $class = 'badge badge-pill badge-warning';
                break;
            default:
                $class = 'badge badge-pill badge-light';
        }

        return Html::tag('span', ArrayHelper::getValue(self::getList(), $status), [
            'class' => $class,
        ]);
    }
}