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


class PaidOrderHelper
{
    public static function getList()
    {
        return [
            Order::PAID_YES => 'Да',
            Order::PAID_NO => 'Нет',
        ];
    }

    public static function getName($status)
    {
        return ArrayHelper::getValue(self::getList(), $status);
    }

    public static function getLabel($status)
    {
        switch ($status) {
            case Order::PAID_YES:
                $class = 'label label-success';
                break;
            case Order::PAID_NO:
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