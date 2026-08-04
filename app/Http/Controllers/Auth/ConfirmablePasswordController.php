<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;

class ConfirmablePasswordController
{
    public function show()
    {
        return response('Confirm password form', 200);
    }

    public function store(Request $request)
    {
        return response('Password confirmed', 200);
    }
}
