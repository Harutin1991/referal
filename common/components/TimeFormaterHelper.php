<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace common\components;

class TimeFormaterHelper {

    const DATE_FORMAT = 'php:Y-m-d';
    const DATETIME_FORMAT = 'php:Y-m-d H:i:s';
    const TIME_FORMAT = 'php:H:i:s';

    public static function convert($dateStr, $type = 'date', $format = null) {
        if ($type === 'datetime') {
            $fmt = ($format == null) ? self::DATETIME_FORMAT : $format;
        } elseif ($type === 'time') {
            $fmt = ($format == null) ? self::TIME_FORMAT : $format;
        } else {
            $fmt = ($format == null) ? self::DATE_FORMAT : $format;
        }
        return \Yii::$app->formatter->asDate($dateStr, $fmt);
    }

}
