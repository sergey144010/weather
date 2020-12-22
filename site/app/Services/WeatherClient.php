<?php

namespace App\Services;

use Graze\GuzzleHttp\JsonRpc\Client;

class WeatherClient
{
    private Client $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function client(): Client
    {
        return $this->client;
    }
}
