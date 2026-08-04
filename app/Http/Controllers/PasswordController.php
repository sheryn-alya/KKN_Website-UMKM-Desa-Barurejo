<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PasswordController
{
    public function update(Request $request)
    {
        return response('Password updated', 200);
    }
}
