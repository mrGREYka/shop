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


class StatusOrderHelper
{
    public static function statusList()
    {
        return [
            Order::STATUS_NEW => 'Новый',
            Order::STATUS_ON_COORDINATION => 'На согласовании',
            Order::STATUS_AGREED => 'Согласован',
            Order::STATUS_PRINTED => 'Напечатан',
            Order::STATUS_IN_DELIVERY => 'На сборке',
            Order::STATUS_COLLECTED => 'Собран',
            Order::STATUS_DELIVERED => 'Доставлен',
            Order::STATUS_CONTROL => 'На контроле',
            Order::STATUS_CANCEL => 'Отменен',
        ];
    }

    public static function statusListWarehouse()
    {
        return [
            Order::STATUS_PRINTED => 'Напечатан',
            Order::STATUS_COLLECTED => 'Собран',
            Order::STATUS_CONTROL => 'На контроле',
        ];
    }

    public static function statusName($status)
    {
        return ArrayHelper::getValue(self::statusList(), $status);
    }

    public static function statusLabel($status)
    {
        switch ($status) {
            case Order::STATUS_NEW:
                $class = 'badge badge-pill badge-light';
                break;
            case Order::STATUS_ON_COORDINATION:
                $class = 'badge badge-pill badge-info';
                break;
            case Order::STATUS_AGREED:
                $class = 'badge badge-pill badge-primary';
                break;
            case Order::STATUS_PRINTED:
                $class = 'badge badge-pill badge-secondary';
                break;
            case Order::STATUS_COLLECTED:
                $class = 'badge badge-pill badge-warning';
                break;
            case Order::STATUS_IN_DELIVERY:
                $class = 'badge badge-pill badge-dark';
                break;
            case Order::STATUS_DELIVERED:
                $class = 'badge badge-pill badge-success';
                break;
            case Order::STATUS_CONTROL:
                $class = 'badge badge-pill badge-danger badge-control';
                break;
            case Order::STATUS_CANCEL:
                $class = 'badge badge-pill badge-danger';
                break;
            default:
                $class = 'badge badge-pill badge-light';
        }

        return Html::tag('span', ArrayHelper::getValue(self::statusList(), $status), [
            'class' => $class,
        ]);
    }
}