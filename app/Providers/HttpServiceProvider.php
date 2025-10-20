<?php

declare(strict_types=1);

namespace App\Providers;

use App\Services\HttpClients\AI\OllamaClient;
use GuzzleHttp\RequestOptions;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\ServiceProvider;

class HttpServiceProvider extends ServiceProvider
{
    private const array DEFAULT_OPTIONS = [
        RequestOptions::HTTP_ERRORS => false,
    ];

    public function register(): void
    {
        $this->app->singleton(OllamaClient::class, function () {
            return new OllamaClient(
                Http::baseUrl(config('services.ollama.url'))
                    ->timeout(config('services.ollama.timeout'))
                    ->acceptJson()
                    ->withOptions(self::DEFAULT_OPTIONS)
            );
        });
    }

    public function boot(): void
    {
    }
}
