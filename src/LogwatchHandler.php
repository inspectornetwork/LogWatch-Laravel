<?php

namespace App\Logging;

use Monolog\Logger;
use App\Logging\Handlers\LogwatchApiHandler;

class LogwatchHandler
{
    public function __invoke(array $config)
    {
        return new Logger('logwatch', [
            new LogwatchApiHandler($config)
        ]);
    }
}