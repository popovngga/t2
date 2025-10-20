<?php

declare(strict_types=1);

namespace App\Services;

use App\DTO\CreateActorDto;
use App\Enums\GenderEnum;
use App\Models\Actor;
use App\Repositories\UserRepository;
use App\Services\HttpClients\AI\AIClientInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

readonly class ActorsService
{
    public function __construct(
        private AIClientInterface $client,
        private UserRepository $userRepository,
    ) {
    }

    public function createByDescription(CreateActorDto $dto): Actor
    {
        $prompt = sprintf('%s. Description: %s', config('services.ollama.prompts.actor_extraction'), $dto->getDescription());

        $response = json_decode($this->client->send($prompt), true) ?? [];

        $data = Validator::make(
            $response,
            [
                'first_name' => ['required', 'string'],
                'last_name' => ['required', 'string'],
                'address' => ['required', 'string'],
                'height' => ['nullable', 'string'],
                'weight' => ['nullable', 'string'],
                'gender' => ['nullable', Rule::enum(GenderEnum::class)],
                'age' => ['nullable', 'integer'],
            ],
        )->stopOnFirstFailure()->validate();

        $dto->setAdditionalData($data);

        return $this->userRepository->addOrUpdateActor(Auth::user(), $dto->toArray());
    }
}
