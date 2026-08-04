<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;

class EmailVerificationNotificationController
{
    public function store(Request $request)
    {
        return response('Verification email sent', 200);
    }
}
