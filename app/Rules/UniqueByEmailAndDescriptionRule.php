<?php

namespace App\Rules;

use App\Models\Actor;
use App\Repositories\ActorRepository;
use Closure;
use Illuminate\Contracts\Validation\DataAwareRule;
use Illuminate\Contracts\Validation\ValidationRule;

class UniqueByEmailAndDescriptionRule implements DataAwareRule, ValidationRule
{
    private array $data = [];

    public function __construct(private readonly ActorRepository $actorRepository)
    {
    }

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $email = $this->data['email'] ?? null;

        if (!$email) {
            $fail('Invalid data.');

            return;
        }

        $isUnique = $this->actorRepository->uniqueByEmailAndDescription($email, (string) $value);

        if (!$isUnique) {
            $fail('Invalid data.');
        }
    }

    public function setData(array $data): self
    {
        $this->data = $data;

        return $this;
    }
}
