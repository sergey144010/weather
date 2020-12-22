<?php

namespace App\Providers;

use App\Services\WeatherClient;
use Illuminate\Config\Repository;
use Illuminate\Support\ServiceProvider;
use Psr\Container\ContainerInterface;
use \Graze\GuzzleHttp\JsonRpc\Client;

class WeatherServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(WeatherClient::class, function (ContainerInterface $container) {
            /** @var Repository $config */
            $config = $container->get('config');
            return new WeatherClient(Client::factory($config->get('weather.endpoint')));
        });
    }
}
