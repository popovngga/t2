<?php

use App\DTO\CreateActorDto;
use App\Models\User;
use App\Repositories\UserRepository;
use App\Services\ActorsService;
use Illuminate\Validation\ValidationException;

use function Pest\Laravel\actingAs;

beforeEach(function () {
    $this->user = User::factory()->create();

    actingAs($this->user);

    $this->dto = new CreateActorDto('test@mail.com', 'Brad Pitt is an American actor, born in 1963, lives in Los Angeles, height 180 cm, weight 78 kg, male');
});

it('creates actor with all fields correctly', function () {
    $aiResponse = [
        'first_name' => 'Brad',
        'last_name' => 'Pitt',
        'address' => 'Los Angeles',
        'height' => '180cm',
        'weight' => '78kg',
        'gender' => 'M',
        'age' => 61,
    ];

    $service = new ActorsService(mockAiClient($aiResponse), new UserRepository());

    $actor = $service->createByDescription($this->dto);

    $this->assertDatabaseHas('actors', [
        'email' => $actor->email,
        'user_id' => $this->user->id,
        ...$aiResponse,
    ]);
});

it('handles missing optional fields', function () {
    $aiResponse = [
        'first_name' => 'Alice',
        'last_name' => 'Smith',
        'address' => '123 Main St',
        'height' => null,
        'weight' => null,
        'gender' => null,
        'age' => null,
    ];

    $service = new ActorsService(mockAiClient($aiResponse), new UserRepository());

    $actor = $service->createByDescription($this->dto);

    $this->assertDatabaseHas('actors', [
        'email' => $actor->email,
        'user_id' => $this->user->id,
        ...$aiResponse,
    ]);
});

it('throws validation exception if required fields are missing', function () {
    $aiResponse = [
        'first_name' => null,
        'last_name' => null,
        'address' => '123 Main St',
    ];

    $service = new ActorsService(mockAiClient($aiResponse), new UserRepository());

    $service->createByDescription($this->dto);

    $this->assertDatabaseMissing('actors', [
        'email' => $this->dto->getEmail(),
    ]);
})->throws(ValidationException::class);

it('handles invalid JSON returned by AI', function () {
    $service = new ActorsService(mockAiClient([], true), new UserRepository());

    $service->createByDescription($this->dto);

    $this->service->createByDescription($this->dto);
})->throws(ValidationException::class);

