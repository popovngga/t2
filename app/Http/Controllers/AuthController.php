<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Repositories\UserRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthController extends Controller
{
    public function showLoginForm(): View
    {
        return view('auth.login');
    }

    public function login(LoginRequest $request, UserRepository $userRepository): RedirectResponse
    {
        $user = $userRepository->firstOrCreate($request->getDto());

        Auth::login($user);

        return redirect()->route('home');
    }
}
