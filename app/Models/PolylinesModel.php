<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class PolylinesModel extends Model
{
    protected $table = 'polylines';
    protected $primaryKey = 'id';
    public $timestamps = true;

    // Mendapatkan semua polylines dalam format GeoJSON
    public function geojson_polylines()
    {
        try {
            $query = $this
                ->select([
                'polylines.id',
                'polylines.name',
                'polylines.description',
                'polylines.image',
                'polylines.coordinates',
                'polylines.created_at',
                'polylines.updated_at',
                'polylines.user_id'
            ])
            ;

            if (Schema::hasTable('users')) {
                $query = $query->leftJoin('users', 'polylines.user_id', '=', 'users.id');
            }

            $polylines = $query->get();

        $geojson = [
            'type' => 'FeatureCollection',
            'features' => [],
        ];

            foreach ($polylines as $polyline) {
            $coords = null;
            if (!empty($polyline->coordinates)) {
                $coords = json_decode($polyline->coordinates, true);
            }

            $geometry = [
                'type' => 'LineString',
                'coordinates' => $coords ?: [],
            ];

            $feature = [
                'type' => 'Feature',
                'geometry' => $geometry,
                'properties' => [
                    'id' => $polyline->id,
                    'name' => $polyline->name,
                    'description' => $polyline->description,
                    'image' => $polyline->image,
                    'user_id' => $polyline->user_id,
                    'user_created' => isset($polyline->user_created) ? $polyline->user_created : null,
                    'created_at' => $polyline->created_at,
                    'updated_at' => $polyline->updated_at,
                ]
            ];

            array_push($geojson['features'], $feature);
            }

            return $geojson;
        } catch (\Exception $e) {
            Log::error('geojson_polylines error: ' . $e->getMessage());
            return ['type' => 'FeatureCollection', 'features' => []];
        }
    }

    // Mendapatkan satu polyline berdasarkan ID dalam format GeoJSON
    public function geojson_polyline($id)
    {
        $polyline = DB::table($this->table)
            ->select('id', 'name', 'description', 'image', 'coordinates', 'created_at', 'updated_at')
            ->where('id', $id)
            ->first();

        if (!$polyline) {
            return null;
        }

        $geojson = [
            'type' => 'FeatureCollection',
            'features' => [],
        ];

        $coords = !empty($polyline->coordinates) ? json_decode($polyline->coordinates, true) : [];

        $feature = [
            'type' => 'Feature',
            'geometry' => [
                'type' => 'LineString',
                'coordinates' => $coords,
            ],
            'properties' => [
                'id' => $polyline->id,
                'name' => $polyline->name,
                'description' => $polyline->description,
                'image' => $polyline->image,
                'length_km' => null,
                'created_at' => $polyline->created_at,
                'updated_at' => $polyline->updated_at,
            ]
        ];

        array_push($geojson['features'], $feature);

        return $geojson;
    }




    // public function geojson_polyline($id)
    // {
    //     $polyline = DB::table($this->table)
    //         ->selectRaw("id,
    //             ST_AsGeoJSON(geom) AS geom,
    //             name,
    //             description, image,
    //             ST_Length(geom, true) AS length_m,
    //             CAST(ST_Length(geom, true) / 1000 AS DOUBLE PRECISION) AS length_km,
    //             created_at,
    //             updated_at
    //         ")
    //         ->where('id', $id)
    //         ->first();  // Menggunakan first() untuk mendapatkan satu record

    //     $geojson = [
    //         'type' => 'FeatureCollection',
    //         'features' => [],
    //     ];

    //     foreach ($polyline as $polyline) {
    //         $feature = [
    //             'type' => 'Feature',
    //             'geometry' => json_decode($polyline->geom),
    //             'properties' => [
    //                 'id' => $polyline->id,
    //                 'name' => $polyline->name,
    //                 'description' => $polyline->description,
    //                 'image' => $polyline->image,
    //                 'length_km' => round((float) $polyline->length_km, 2), // Menampilkan panjang dalam km dengan pembulatan
    //                 'created_at' => $polyline->created_at,
    //                 'updated_at' => $polyline->updated_at,
    //             ]
    //         ];

    //         array_push($geojson['features'], $feature);
    //     }

    //     return $geojson;
    // }

    protected $fillable = [
        'geom',
        'name',
        'description',
        'image',
        'user_id',
        'user_created',
    ];
}
