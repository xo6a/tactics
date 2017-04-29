<?php

namespace tactics;

class Debug
{
    public static function dump($var)
    {
        echo '<div><pre>';
        \yii\helpers\VarDumper::dump($var, 10, true);
        echo '</pre></div>';
    }
}