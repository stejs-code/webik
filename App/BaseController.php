<?php

namespace App;

use Psr\Http\Message\ServerRequestInterface;
use App\Response\Response;

class BaseController extends Bone
{
    private ServerRequestInterface $request;
    protected Response $response;
    public bool $layout = true;
    public array $menuItems = [];
    public TemplateContext $tpl_context;
    protected Template $tpl;

    public function __construct()
    {
        parent::__construct();
        $this->response = new Response();
        $this->tpl_context = new TemplateContext();
        $this->tpl_context->setTitleSuffix(" | Webík");
    }

    public function handle(ServerRequestInterface $request)
    {
        $this->request = $request;
        $this->compute();


        $html = $this->render();

        $this->response->status(200)->html($html)->send();



    }

    protected function compute()
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