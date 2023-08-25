<?php

interface HttpService
{
    public function request(string $url, string $method, array $options);
}

class XMLHttpService implements HttpService
{
    public function request(string $url, string $method, array $options)
    {
        echo 'send request'.PHP_EOL;
    }
}

class Http
{
    private $service;

    public function __construct(HttpService $httpService)
    {
        $this->service = $httpService;
    }

    public function get(string $url, array $options)
    {
        $this->service->request($url, 'GET', $options);
    }

    public function post(string $url)
    {
        $this->service->request($url, 'POST', []);
    }
}

$XMLHttpService = new Http(new XMLHttpService());

$XMLHttpService->get('123', []);
$XMLHttpService->post('456');