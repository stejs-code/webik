<?php

namespace App\Module;


use App\BaseController;
use App\DependencyContainer;
use App\Template;
use function App\dumpe;

class Task extends BaseController
{



    public array $tasks = [
        [
            "id" => 1,
            "name" => "Úkol 1",
            "url" => "ukol-1",
            "description" => "Popis úkolu 1",
            "status" => "done",
        ],
        [
            "id" => 2,
            "name" => "Úkol 2",
            "url" => "ukol-2",
            "description" => "Popis úkolu 2",
            "status" => "done",
        ],
        [
            "id" => 3,
            "name" => "Skvělý formulář",
            "url" => "skvely-formular",
            "description" => "Výpočet obsahu a obvodu kruhu a změna barvy pozadí?",
            "status" => "done",
        ],
        [
            "id" => 4,
            "name" => "Barva pozadí",
            "url" => "barva-pozadi",
            "description" => "Barva pozadí",
            "status" => "done",
        ],
        [
            "id" => 5,
            "name" => "Kruh a čtverec",
            "url" => "kruh-a-ctverec",
            "description" => "Kruh a čtverec",
            "status" => "done",
        ],
    ];

    public array $task = [];

    public function __construct(DependencyContainer $dc)
    {
        parent::__construct($dc);

        if (isset($dc->parameters->urlPath) && $dc->parameters->urlPath) {
            $this->task = array_filter($this->tasks, function ($task) use ($dc) {
                return $task['url'] == $dc->parameters->urlPath;
            });

            if (count($this->task) == 0) {
                $this->tpl = (new Template("task/404", $this->tpl_context));
                $this->task = [];
            } else {
                $this->task = reset($this->task);

                $this->tpl = (new Template("task/" . ($this->task["id"]), $this->tpl_context));

            }


        } else {
            $this->tpl = (new Template("task", $this->tpl_context));
        }

        if (isset($this->task["name"]) && $this->task) {
            $this->tpl_context->setTitle($this->task["name"]);
        } else {
            $this->tpl_context->setTitle("Úkoly");
        }

        $this->tpl->assign("tasks", $this->tasks);
        $this->tpl->assign("task", $this->task);

    }
}