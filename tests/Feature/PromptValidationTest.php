<?php

use App\Models\User;
use Illuminate\Support\Facades\Config;
use Symfony\Component\HttpFoundation\Response;
use function Pest\Laravel\getJson;
use function Pest\Laravel\actingAs;

it('returns prompt validation message for authenticated user', function () {
    $user = User::factory()->create();
    actingAs($user);

    $prompt = 'Test AI extraction prompt';
    Config::set('services.ollama.prompts.actor_extraction', $prompt);

    $response = actingAsUser()->getJson('/api/actors/prompt-validation');

    $response->assertOk()
        ->assertJson([
            'message' => $prompt,
        ]);
});

it('denies access for unauthenticated user', function () {
    $response = getJson('/api/actors/prompt-validation');

    $response->assertStatus(Response::HTTP_UNAUTHORIZED);
});
