<?php

namespace App;

use App\DependencyContainer;

class Bone
{
    protected DependencyContainer $dc;

    static DependencyContainer $globalDC;

    public function __construct()
    {
        $this->dc = self::$globalDC;
    }

    public static function setGlobalDC(DependencyContainer $dc)
    {
        self::$globalDC = $dc;
    }
}
