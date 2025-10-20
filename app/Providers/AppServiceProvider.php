<?php

declare(strict_types=1);

namespace App\Providers;

use App\Services\ActorsService;
use App\Services\HttpClients\AI\AIClientInterface;
use App\Services\HttpClients\AI\OllamaClient;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app
            ->when(ActorsService::class)
            ->needs(AIClientInterface::class)
            ->give(OllamaClient::class);
    }

    public function boot(): void
    {
    }
}
