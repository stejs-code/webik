<?php

namespace App\Response;



class Response
{
    private string $body;
    private int $status;
    private string $content_type;
    private array $headers = [];

    public function __construct()
    {
        $this->status = 200;
        $this->content_type = 'text/html';
        $this->body = '';
    }

    public function json(array $data): Response
    {
        $this->content_type = 'application/json';
        $this->body = json_encode($data);
        return $this;
    }

    public function status(int $status): Response
    {
        $this->status = $status;
        return $this;
    }

    public function html(string $html): Response
    {
        $this->content_type = 'text/html';
        $this->body = $html;
        return $this;
    }

    /**
     * @param string $key "Content-type"
     * @param string $value "application/json"
     * @return $this
     */
    public function header(string $key, string $value): Response
    {
        $this->headers[$key] = $value;
        return $this;
    }

    public function send(): void
    {
        http_response_code($this->status);

        header('Content-Type: ' . $this->content_type);
        foreach ($this->headers as $key => $value) {
            header($key . ': ' . $value);
        }

        echo $this->body;

        exit;
    }
}
