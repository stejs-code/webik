<?php

namespace App\Component;

use App\Bone;

class Component extends Bone
{
    public function __construct()
    {
        parent::__construct();

        $this->compute();
    }

    public function compute()
    {

    }

    public function render()
    {
        ?>

        <div class="bg-white border-b border-border tm-mavigation">
            Empty component <?= get_class($this) ?>
        </div>

        <?php
    }


    public function renderToString()
    {
        ob_start();
        $this->render();
        return ob_get_clean();
    }
}