<?php

declare(strict_types=1);

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\PromptValidationResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ActorController extends Controller
{
    public function promptValidation(): JsonResource
    {
        return new PromptValidationResource(
            config('services.ollama.prompts.actor_extraction')
        );
    }
}
