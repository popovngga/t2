<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\Actors\StoreRequest;
use App\Repositories\ActorRepository;
use App\Services\ActorsService;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Cache;

class ActorController extends Controller
{
    public function index(ActorRepository $actorRepository): View
    {
        $actors = $actorRepository->paginateLatest();

        return view('actors.index', compact('actors'));
    }

    public function store(StoreRequest $request, ActorsService $actorsService): RedirectResponse
    {
        $dto = $request->getDto();

        $lock = Cache::lock("actor_create_{$dto->getEmail()}");
        if (!$lock->acquire()) {
            return redirect()->back()->withErrors(['error' => 'Another process is creating an actor with this email. Please try again later.']);
        }

        try {
            $actorsService->createByDescription($request->getDto());
        } catch (\Throwable) {
            return redirect()->back()->withErrors(['error' => 'Something went wrong while creating the actor. Please try again later.']);
        } finally {
            $lock->release();
        }

        return redirect()->route('actors.index');
    }
}
