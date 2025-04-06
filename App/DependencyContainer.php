<?php

namespace App;

use GuzzleHttp\Psr7\ServerRequest;
use stdClass;


class DependencyContainer
{

    public ServerRequest $request;
    public stdClass $parameters;
    public function __construct()
    {
        try {
            $this->request = ServerRequest::fromGlobals();
            $this->parameters = new stdClass();
        } catch (\Exception $e) {
            die($e->getMessage());
        }
    }
}