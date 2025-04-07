<?php

namespace App;

use GuzzleHttp\Psr7\ServerRequest;
use stdClass;


class DependencyContainer
{

    public ServerRequest $request;
    public stdClass $parameters;
    public Config $config;
    public function __construct()
    {
        try {
            $this->request = ServerRequest::fromGlobals();
            $this->parameters = new stdClass();
            $this->config = new Config();
        } catch (\Exception $e) {
            die($e->getMessage());
        }
    }
}