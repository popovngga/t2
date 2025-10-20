<?php

declare(strict_types=1);

namespace App\Repositories;

use App\DTO\CreateUserDto;
use App\Models\Actor;
use App\Models\User;

class UserRepository
{
    public function firstOrCreate(CreateUserDto $createUserDto): User
    {
        return User::query()->firstOrCreate($createUserDto->toArray());
    }

    public function addOrUpdateActor(User $user, array $data): Actor
    {
        /** @var Actor $actor */
        $actor = $user->actors()->updateOrCreate(
            ['email' => $data['email']],
            $data
        );

        return $actor;
    }
}
