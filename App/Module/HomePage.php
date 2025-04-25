<?php

namespace App\Module;


use App\BaseController;
use App\Template;

class HomePage extends BaseController
{

    public function compute()
    {
        $this->tpl_context->setTitle("Webík", false);

        $this->tpl = new Template("homepage", $this->tpl_context);
    }
}
