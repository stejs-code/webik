<?php

namespace App\Module;


use App\BaseController;
use App\DependencyContainer;
use App\Template;

class HomePage extends BaseController
{

    public function __construct(DependencyContainer $dc)
    {
        parent::__construct($dc);

        $this->tpl_context->setTitle("Úkoly");
        $this->tpl = new Template("homepage", $this->tpl_context);
    }

    protected function task()
    {
        $tasksComponent = new Task($this->dc);
        $tasksComponent->layout = false;
        $tasksComponent->tasksComponent();


        $this->tpl->assign("tasksComponent", $tasksComponent->render());
    }


}