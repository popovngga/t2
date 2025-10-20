<?php

declare(strict_types=1);

namespace App\Http\Requests\Actors;

use App\DTO\CreateActorDto;
use App\Repositories\ActorRepository;
use App\Rules\UniqueByEmailAndDescriptionRule;
use Illuminate\Foundation\Http\FormRequest;

final class StoreRequest extends FormRequest
{
    public function rules(): array
    {
        $isUniqueRule = new UniqueByEmailAndDescriptionRule(new ActorRepository());

        return [
            'email' => [
                'required',
                'string',
                'email:filter',
            ],
            'description' => [
                'required',
                'string',
                'max:1000',
                $isUniqueRule,
            ],
        ];
    }

    public function getDto(): CreateActorDto
    {
        return new CreateActorDto(...$this->validated());
    }
}
