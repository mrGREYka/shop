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
use app\models\Params;


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
            Order::DELIVERY_PEC => 'ПЭК',
            Order::DELIVERY_DOSTAVISTA => 'Dostavista',
        ];
    }

    public static function getName($status)
    {
        return ArrayHelper::getValue(self::getList(), $status);
    }

    public static function getPrice($status)
    {
        $params = Params::findOne(1);

        switch ($status) {
            case Order::DELIVERY_COURIER:
                $price = $params->price_сourier;
                break;
            case Order::DELIVERY_SDEK_PVZ:
                $price = $params->pickup;
                break;
            case Order::DELIVERY_MAIL:
                $price = $params->russia_mail;
                break;
            case Order::DELIVERY_SDEK_COURIER:
                $price = 0;
                break;
            case Order::DELIVERY_OFFICE:
                $price = 0;
                break;
            case Order::DELIVERY_PEC:
                $price = 0;
                break;
            case Order::DELIVERY_DOSTAVISTA:
                $price = 0;
                break;
            default:
                $price = 0;
        }

        return $price;

    }

    public static function getMinSumFree()
    {
        $params = Params::findOne(1);
        return $params->three_shiping_sum;
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
            case Order::DELIVERY_PEC:
                $class = 'badge badge-pill badge-dark';
                break;
            case Order::DELIVERY_DOSTAVISTA:
                $class = 'badge badge-pill badge-success';
                break;
            default:
                $class = 'badge badge-pill badge-light';
        }

        return Html::tag('span', ArrayHelper::getValue(self::getList(), $status), [
            'class' => $class,
        ]);
    }
}