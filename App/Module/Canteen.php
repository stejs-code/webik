<?php

namespace App\Module;

use App\BaseController;
use App\Template;

class Canteen extends BaseController
{

    public array $menu = [
        [
            "name" => "pizza",
            "label" => "Pizza",
            "price" => 120,
        ],
        [
            "name" => "hamburger",
            "label" => "Hamburger",
            "price" => 100,
        ],
        [
            "name" => "salat",
            "label" => "Salát",
            "price" => 80,
        ],
        [
            "name" => "soup",
            "label" => "Hamburger s hranolky",
            "price" => 100,
        ],
    ];

    public array $order = [];
    public int $total = 0;

    public function compute()
    {
        $this->tpl_context->setTitle("Jídelna", false);
        $this->tpl = new Template("canteen", $this->tpl_context);

        foreach ($_GET as $key => $value) {
            $menuItem = array_filter($this->menu, function ($item) use ($key) {
                return $item["name"] === $key;
            });

            $menuItem = array_shift($menuItem);
            $this->order[$menuItem["name"]] = $menuItem;
            $this->total += $menuItem["price"];
        }

        $this->tpl->assign("menu", $this->menu);
        $this->tpl->assign("order", $this->order);
        $this->tpl->assign("total", $this->total);
    }
}
