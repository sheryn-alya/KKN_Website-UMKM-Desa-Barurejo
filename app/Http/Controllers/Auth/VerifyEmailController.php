<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;

class VerifyEmailController
{
    public function __invoke(Request $request, $id, $hash)
    {
        return response('Email verification endpoint.', 200);
    }
}
