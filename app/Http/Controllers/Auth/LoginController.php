<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use App\Services\Auth\LoginService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class LoginController extends Controller
{
    public function index(): View
    {
        return view('auth.login');
    }

    /**
     * @throws ValidationException
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $data = $request->validated();

        $loginService = new LoginService(
            $data['email'],
            $data['password'],
            $data['remember'] ?? false,
            $request->ip()
        );

        $loginService->login();

        return redirect()->intended(RouteServiceProvider::HOME);
    }
}
