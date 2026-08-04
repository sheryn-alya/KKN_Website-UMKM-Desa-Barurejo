<?php

namespace App\Http\Controllers;

use App\Models\Point;
use Illuminate\Http\Request;

class PointsController extends Controller
{
    public function index()
    {
        $points = Point::all();
        return view('map', [
            'points' => $points,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'coordinates' => 'required',
        ]);

        Point::create([
            'name' => $request->name,
            'geom' => $request->coordinates,
        ]);

        return response('Point stored', 201);
    }
}
