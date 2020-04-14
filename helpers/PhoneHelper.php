<?php
/**
 * Created by PhpStorm.
 * User: GREY
 * Date: 01.04.2020
 * Time: 2:02
 */

namespace app\helpers;



class PhoneHelper
{
    public static function CleanPhoneNumber( $param_phone )
    {
        $param_phone = str_replace("+", "", $param_phone );
        $param_phone = str_replace("(", "", $param_phone );
        $param_phone = str_replace(")", "", $param_phone );
        $param_phone = str_replace("-", "", $param_phone );

        return $param_phone;
    }
}