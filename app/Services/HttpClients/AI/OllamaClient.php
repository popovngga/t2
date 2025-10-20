<?php

declare(strict_types=1);

namespace App\Services\HttpClients\AI;

use Illuminate\Http\Client\PendingRequest;

readonly class OllamaClient implements AIClientInterface
{

    public function __construct(private PendingRequest $client)
    {
    }

    public function send(string $prompt): ?string
    {
        $response = $this->client->post('generate', [
            'model' => config('services.ollama.model'),
            'stream' => false,
            'prompt' => $prompt,
        ]);

        return $response->json('response');
    }
}
