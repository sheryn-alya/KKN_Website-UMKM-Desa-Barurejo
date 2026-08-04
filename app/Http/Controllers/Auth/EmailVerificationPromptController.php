<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;

class EmailVerificationPromptController
{
    public function __invoke(Request $request)
    {
        return response('Please verify your email.', 200);
    }
}
