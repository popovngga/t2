<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\DTO\CreateUserDto;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

final class LoginRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'email' => [
                'required',
                'string',
                'email:filter',
            ],
            'password' => [
                'required',
                'string',
                Password::min(8),
            ],
        ];
    }

    public function getDto(): CreateUserDto
    {
        return new CreateUserDto(...$this->validated());
    }
}
