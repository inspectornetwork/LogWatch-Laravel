<?php

namespace InspectorNetwork\Logwatch;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Log;
use InspectorNetwork\Logwatch\Handlers\LogwatchApiHandler;
use Monolog\Logger;

class LogwatchServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Log::extend('logwatch', function ($app, array $config) {
            $handler = new LogwatchApiHandler($config);
            
            return new Logger('logwatch', [$handler]);
        });
    }
}