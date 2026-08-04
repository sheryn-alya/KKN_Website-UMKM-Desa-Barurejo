<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;

class NewPasswordController
{
    public function create($token)
    {
        return response('Reset password form for token: ' . $token, 200);
    }

    public function store(Request $request)
    {
        return response('Password has been reset', 200);
    }
}
