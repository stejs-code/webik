<?php

namespace App;

class HandicappedTracy
{
    public static function dump($var)
    {
        echo '<pre>';
        var_dump($var);
        echo '</pre>';
        die();
    }
}
