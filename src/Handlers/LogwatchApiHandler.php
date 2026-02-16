<?php

namespace InspectorNetwork\Logwatch\Handlers;

use Monolog\LogRecord;
use Illuminate\Support\Facades\Http;
use Monolog\Handler\AbstractProcessingHandler;

class LogwatchApiHandler extends AbstractProcessingHandler
{
    protected array $config;

    public function __construct(array $config)
    {
        parent::__construct();
        $this->config = $config;
    }

    protected function write(LogRecord $record): void
    {
        $payload = [
            'level'     => strtolower($record->level->name),
            'message'   => $record->message,
            'context'   => $record->context,
            'hostname'  => gethostname(),
            'datetime'  => $record->datetime->format('Y-m-d H:i:s'),
            'environment' => app()->environment(),
        ];

        $request = Http::withHeaders([
            'X-Logwatch-Key' => $this->config['key'] ?? null,
            'Accept'         => 'application/json',
        ]);

        if (app()->runningInConsole()) {
            $request->post($this->config['endpoint'] ?? '', $payload);
        } else {
            $request->async()->post($this->config['endpoint'] ?? '', $payload);
        }
    }

    public function __destruct()
    {
        try {
            if (method_exists(Http::getFacadeRoot(), 'flush')) {
                Http::getFacadeRoot()->flush();
            }
        } catch (\Exception $e) {}
    }
}