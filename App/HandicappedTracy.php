<?php

namespace App;

class HandicappedTracy
{
    public static function dumpe($var)
    {
        echo '<pre>';
        var_dump($var);
        echo '</pre>';
        die();
    }
}

