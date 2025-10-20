<?php

declare(strict_types=1);

namespace App\DTO;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Facades\Hash;

final readonly class CreateUserDto implements Arrayable
{
    private string $password;

    public function __construct(
        private string $email,
        string $password
    ) {
        $this->password = Hash::make($password);
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function toArray(): array
    {
        return [
            'email' => $this->getEmail(),
            'password' => $this->getPassword(),
        ];
    }
}
