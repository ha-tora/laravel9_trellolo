<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function __invoke()
    {
        return [
            '_token' => csrf_token(),
            'user' => Auth::user(),
        ];
    }
}
