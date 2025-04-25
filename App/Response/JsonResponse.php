<?php

namespace App\Response;



class JsonResponse extends Response
{
    public function __construct(array $data)
    {
        parent::__construct();
        $this->json($data);
    }
}
