<?php

namespace App;

use Elastic\Elasticsearch\ClientBuilder;
use Elastic\Elasticsearch\Client;
use GuzzleHttp\Psr7\ServerRequest;
use stdClass;


class DependencyContainer
{
    public Client $es;
    public ServerRequest $request;
    public stdClass $parameters;
    public function __construct()
    {
        try {
            $this->request = ServerRequest::fromGlobals();
            $this->es = ClientBuilder::create()->build();
            $this->parameters = new stdClass();
        } catch (\Exception $e) {
            die($e->getMessage());
        }
    }
}