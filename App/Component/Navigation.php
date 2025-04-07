<?php

namespace App\Component;

class Navigation extends Component
{
    public array $menuItems = [];

    public function compute()
    {
        $this->menuItems = [
            [
                "name" => "Úkoly",
                "url" => "/task",
                "active" => str_starts_with($this->dc->request->getUri()->getPath(), "/task"),
            ],
        ];
    }

    public function render()
    {
        ?>

        <div class="bg-white border-b border-border tm-mavigation">
            <nav class="flex justify-between items-center mx-auto max-w-screen-lg px-4 py-2">
                <a href="/" class="font-bold text-lg">
                    Webík
                </a>

                <ul class="flex gap-4">
                    <? foreach ($this->menuItems as $item) { ?>
                        <? $this->renderItem($item); ?>
                    <? } ?>
                </ul>
            </nav>
        </div>

        <?php
    }

    public function renderItem(array $item)
    {
        ?>

        <li>
            <a href="<?= $item['url'] ?>" <?= $item['active'] ? 'data-active' : '' ?>
                class="relative block py-2 before:content-[''] before:absolute before:bottom-1 before:left-0 before:transition-all before:right-[100%] hover:before:right-0 data-active:before:right-0 before:h-[2px] before:bg-primary">
                <?= $item['name'] ?>
            </a>
        </li>

        <?php
    }
}
