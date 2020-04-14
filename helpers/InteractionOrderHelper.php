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


class InteractionOrderHelper
{
    public static function getList()
    {
        return [
            Order::INTERACTION_EMAIL => 'eMail',
            Order::INTERACTION_WHATS_APP => 'WhatsApp',
        ];
    }

    public static function getName( $status )
    {
        return ArrayHelper::getValue(self::getList(), $status);
    }

    public static function getLabel($status)
    {
        switch ($status) {
            case Order::INTERACTION_WHATS_APP:
                $class = 'label label-success';
                break;
            case Order::INTERACTION_EMAIL:
                $class = 'label label-info';
                break;
            default:
                $class = 'label label-info';
        }

        return Html::tag('span', ArrayHelper::getValue(self::getList(), $status), [
            'class' => $class,
        ]);
    }
}