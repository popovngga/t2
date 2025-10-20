<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Actor;
use Illuminate\Pagination\LengthAwarePaginator;

class ActorRepository
{
    public function paginateLatest(int $limit = null): LengthAwarePaginator
    {
        return Actor::query()->latest()->paginate($limit);
    }

    public function uniqueByEmailAndDescription(string $email, string $description): bool
    {
        return Actor::query()
            ->where('email', $email)
            ->where('description', $description)
            ->doesntExist();
    }
}
