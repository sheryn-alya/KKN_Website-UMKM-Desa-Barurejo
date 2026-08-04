<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;

class AuthenticatedSessionController
{
    public function create()
    {
        return response('Login form', 200);
    }

    public function store(Request $request)
    {
        return response('Authenticated', 200);
    }

    public function destroy(Request $request)
    {
        return response('Logged out', 200);
    }
}
