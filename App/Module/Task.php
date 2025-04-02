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
            "description" => "Základní základ všech základů",
            "status" => "done",
        ],
        [
            "id" => 2,
            "name" => "Úkol 2",
            "url" => "ukol-2",
            "description" => "Počasí? Červenec? Horko? Hrozné horko? A spoustu čísel?",
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
            "description" => "Nastavení barvy pozadí, protože proč&nbsp;ne.",
            "status" => "done",
        ],
        [
            "id" => 5,
            "name" => "Kruh a čtverec",
            "url" => "kruh-a-ctverec",
            "description" => "Kruh a čtverec, vykreslit? Stáhout?",
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

    public function render(): string
    {
        if (isset($this->task["id"], $_GET["file"]) && $this->task["id"] == 5 && $_GET["file"] == "true") {
            $this->response->header("Content-Type", "image/svg+xml");
            $this->response->header("Content-Disposition", "attachment; filename=\"shape.svg\"");
            return self::renderSvg();
        }

        return parent::render();
    }

    public function tasksComponent()
    {
        $this->tpl = (new Template("task", $this->tpl_context));
        $this->tpl->assign("tasks", $this->tasks);
    }


    /**
     * Vykreslí SVG obrázek kruhu nebo čtverce
     * 
     * @param string|null $tvar Typ tvaru ('kruh' pro kruh, cokoliv jiného pro čtverec)
     * @param int|null $velikost Velikost (poloměr pro kruh, polovina úhlopříčky pro čtverec)
     * @param string|null $barva Barva tvaru
     * @param string|null $vlastni_barva Vlastní barva (přepíše $barva, pokud je zadána)
     * @return string SVG obsah jako řetězec
     */
    static function renderSvg(
        ?string $tvar = null,
        ?int $velikost = null,
        ?string $barva = null,
        ?string $vlastni_barva = null
    ) {
        $tvar = $tvar ?? $_GET["tvar"] ?? "kruh";
        $velikost = $velikost ?? $_GET["velikost"] ?? 100;
        $barva = $barva ?? $_GET["barva"] ?? "#000000";

        if (!empty($vlastni_barva ?? $_GET["vlastni_barva"] ?? "")) {
            $barva = $vlastni_barva ?? $_GET["vlastni_barva"];
        }

        $svg_content = '<?xml version="1.0" encoding="UTF-8" standalone="no"?>';
        $svg_content .= '<svg width="400" height="400" xmlns="http://www.w3.org/2000/svg">';

        if ($tvar == "kruh") {
            $svg_content .= sprintf(
                '<circle cx="%d" cy="%d" r="%d" fill="%s" />',
                200,
                200,
                $velikost,
                $barva
            );
        } elseif ($tvar == "ctverec") {
            $strana = round($velikost * sqrt(2));
            $x = 200 - $strana / 2;
            $y = 200 - $strana / 2;
            $svg_content .= sprintf(
                '<rect x="%d" y="%d" width="%d" height="%d" fill="%s" />',
                $x,
                $y,
                $strana,
                $strana,
                $barva
            );
        }

        $svg_content .= '</svg>';

        return $svg_content;
    }
}