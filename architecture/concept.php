<?php

interface SecretKeyStorage
{
    public function getSecretKey(): string;
}

class FileSecretKeyStorage implements SecretKeyStorage
{
    public function getSecretKey(): string
    {
        // Логика получения секретного ключа из файла
    }
}

class DatabaseSecretKeyStorage implements SecretKeyStorage
{
    public function getSecretKey(): string
    {
        // Логика получения секретного ключа из базы данных
    }
}

class RedisSecretKeyStorage implements SecretKeyStorage
{
    public function getSecretKey(): string
    {
        // Логика получения секретного ключа из Redis
    }
}

class CloudSecretKeyStorage implements SecretKeyStorage
{
    public function getSecretKey(): string
    {
        // Логика получения секретного ключа из облачного хранилища
    }
}

class API
{
    private $client;
    private $secretKeyStorage;

    public function __construct(SecretKeyStorage $secretKeyStorage)
    {
        $this->client = new \GuzzleHttp\Client();
        $this->secretKeyStorage = $secretKeyStorage;
    }

    public function getUserData()
    {
        $params = [
            'auth' => ['user', 'pass'],
            'token' => $this->secretKeyStorage->getSecretKey()
        ];

        $request = new \Request('GET', 'https://api.method', $params);
        $promise = $this->client->sendAsync($request)->then(function ($response) {
            $result = $response->getBody();
        });

        $promise->wait();
    }
}