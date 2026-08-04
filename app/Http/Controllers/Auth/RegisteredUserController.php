<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;

class RegisteredUserController
{
    public function create()
    {
        return response('Register form', 200);
    }

    public function store(Request $request)
    {
        return response('User registered', 201);
    }
}
