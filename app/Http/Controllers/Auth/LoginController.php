<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function create()
    {
        return [
            '_token' => csrf_token(),
            'email' => 'email',
            'password' => 'password'
        ];
    }

    public function store(LoginRequest $request) 
    {
        $validated = $request->validated();

        if (!Auth::attempt($validated)) {
            return [
                'failed' => trans('failed')
            ];
        }

        $request->session()->regenerate();

        return redirect()->intended(RouteServiceProvider::HOME);
    }
}
