<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Http\Resources\User\UserResource;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function __invoke()
    {
        return [
            '_token' => csrf_token(),
            'user' => Auth::user() ? new UserResource(Auth::user()) : null,
        ];
    }
}
