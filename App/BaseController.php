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


        // TODO: finish this
        if (isset($this->request->getQueryParams()["replace_route"])) {
            $this->layout = false;

            $response = $this->render();
            $this->tpl_context;
            $this->response->status(200)->html($response)->send();
        }

        $html = $this->render();

        $this->response->status(200)->html($html)->send();

    }

    protected function compute()
    {

    }

    protected function render(): string
    {
        $rendered = $this->tpl->render();
        $rendered = "<!--- ROUTE_REF_START --!>" . $rendered . "<!--- ROUTE_REF_END --!>";

        if ($this->layout) {
            return (new Template("@layout", $this->tpl_context))
                ->assign("config", $this->dc->config)
                ->assign("children", $rendered)
                ->render();
        }

        return $rendered;

    }
}