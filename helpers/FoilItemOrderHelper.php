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
use app\models\ItemOrder;


class FoilItemOrderHelper
{
    public static function getList()
    {
        return [
            ItemOrder::FOIL_SILVER => 'Серебро',
            ItemOrder::FOIL_GOLD => 'Золото',
            ItemOrder::FOIL_MIX => 'Микс',
        ];
    }

    public static function getName($status)
    {
        return ArrayHelper::getValue(self::getList(), $status);
    }

    public static function getLabel($status)
    {
        switch ($status) {
            case ItemOrder::FOIL_SILVER:
                $class = 'label label-default';
                break;
            case ItemOrder::FOIL_GOLD:
                $class = 'label label-warning';
                break;
            case ItemOrder::FOIL_MIX:
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