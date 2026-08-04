<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;

class PasswordResetLinkController
{
    public function create()
    {
        return response('Forgot password form', 200);
    }

    public function store(Request $request)
    {
        return response('Password reset link sent', 200);
    }
}
