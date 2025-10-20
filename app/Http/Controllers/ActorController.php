<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\Actors\StoreRequest;
use App\Repositories\ActorRepository;
use App\Services\ActorsService;
use Illuminate\View\View;

class ActorController extends Controller
{
    public function index(ActorRepository $actorRepository): View
    {
        $actors = $actorRepository->paginateLatest();

        return view('actors.index', compact('actors'));
    }

    public function store(StoreRequest $request, ActorsService $actorsService)
    {
        try {
            $actorsService->createByDescription($request->getDto());
        } catch (\Exception $exception){
            return redirect()->back()->withErrors(['error' => $exception->getMessage()]);
        }

        return redirect()->route('actors.index');
    }
}
