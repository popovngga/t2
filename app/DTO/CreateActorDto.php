<?php

declare(strict_types=1);

namespace App\DTO;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Facades\Hash;

final readonly class CreateActorDto implements Arrayable
{
    private array $data;

    public function __construct(
        private string $email,
        private string $description
    ) {
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setAdditionalData(array $data): void
    {
        $this->data = $data;
    }

    public function toArray(): array
    {
        return [
            'email' => $this->getEmail(),
            'description' => $this->getDescription(),
            ...($this->data ?? []),
        ];
    }
}
