<?php

namespace App;

class Template
{
    private string $tpl_path;
    private array $data = [];
    public TemplateContext $context;
    public function __construct(string $tpl_path, TemplateContext $context)
    {
        $this->tpl_path = $tpl_path;
        $this->context = $context;
    }


    public function assign(string $key, mixed $value): Template
    {
        $this->data[$key] = $value;
        return $this;
    }

    public function render(): string
    {
        ob_start();

        extract($this->data);
        $context = $this->context;

        require "../App/Template/$this->tpl_path.php";

        return ob_get_clean();
    }

    public function layout(string $tpl_path): Template
    {
        $this->layout_path = $tpl_path;
        return $this;
    }

}