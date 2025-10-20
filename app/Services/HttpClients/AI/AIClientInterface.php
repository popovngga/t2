<?php

declare(strict_types=1);

namespace App\Services\HttpClients\AI;

use Illuminate\Http\Client\ConnectionException;

interface AIClientInterface
{
    /**
     * @throws ConnectionException
     */
    public function send(string $prompt): ?string;
}
