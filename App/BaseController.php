<?php

namespace App;

use Psr\Http\Message\ServerRequestInterface;
use App\Response\Response;

class BaseController
{
    private ServerRequestInterface $request;
    protected Response $response;
    public bool $layout = true;
    public array $menuItems = [];
    public TemplateContext $tpl_context;
    protected Template $tpl;

    public function __construct(public DependencyContainer $dc)
    {
        $this->response = new Response();
        $this->tpl_context = new TemplateContext($dc);
        $this->tpl_context->setTitleSuffix(" | Webík");
    }

    public function handle(ServerRequestInterface $request)
    {
        $this->request = $request;
        $this->task();


        $html = $this->render();

        $this->response->status(200)->html($html)->send();



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