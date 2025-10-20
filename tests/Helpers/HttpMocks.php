<?php

use App\Services\HttpClients\AI\AIClientInterface;

function mockAiClient(array|string $response, bool $isError = false): AIClientInterface
{
    $mock = Mockery::mock(AIClientInterface::class);

    if ($isError) {
        $mock->shouldReceive('send')->andReturn(json_encode(['status' => 400, ...$response]));
    } else {
        $mock->shouldReceive('send')->andReturn(json_encode($response));
    }

    app()->instance(AIClientInterface::class, $mock);

    return $mock;
}
