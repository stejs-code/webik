<?php

namespace App;

use Psr\Http\Message\ServerRequestInterface;

class BaseController
{
    private ServerRequestInterface $request;
    public bool $layout = true;
    public array $menuItems = [];
    public TemplateContext $tpl_context;
    protected Template $tpl;

    public function __construct(public DependencyContainer $dc)
    {
        $this->tpl_context = new TemplateContext($dc);
        $this->tpl_context->setTitleSuffix(" | Webík");
    }

    public function handle(ServerRequestInterface $request)
    {
        $this->request = $request;
        $this->task();

        echo $this->render();

    }

    protected function task()
    {

    }

    protected function render(): string
    {
        $rendered = $this->tpl->render();

        if ($this->layout) {
            return (new Template("@layout", $this->tpl_context))
                ->assign("children", $rendered)

                ->render();
        }

        return $rendered;

    }
}