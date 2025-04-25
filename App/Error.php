<?php

namespace App;

class Error extends Bone
{
    public TemplateContext $tpl_context;
    public Template $tpl;

    public function __construct(public string $message, public int $code = 500) {}

    public function render()
    {
        $this->tpl_context = new TemplateContext();

        http_response_code($this->code);

        if ($this->code == 404) {
            $this->tpl = new Template("@404", $this->tpl_context);
        } else {
            $this->tpl = new Template("@500", $this->tpl_context);
        }

        $html = $this->tpl->render();

        echo (new Template("@layout", $this->tpl_context))
            ->assign("children", $html)
            ->assign("menuItems", [])
            ->render();
    }
}
