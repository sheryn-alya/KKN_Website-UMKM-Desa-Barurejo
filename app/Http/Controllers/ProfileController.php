<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    /**
     * Halaman Profile / UMKM
     */
    public function index()
    {
        return view('profile');
    }

    /**
     * Edit Profile
     */
    public function edit()
    {
        return view('profile.edit');
    }

    /**
     * Update Profile
     */
    public function update(Request $request)
    {
        // Logika update profile
    }

    /**
     * Delete Profile
     */
    public function destroy()
    {
        // Logika delete profile
    }
}
