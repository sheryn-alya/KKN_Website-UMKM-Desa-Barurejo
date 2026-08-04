<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class PointsModel extends Model
{
    protected $table = 'points';
    public $timestamps = false;

    public function geojson_points()
{
        try {

            $query = $this
                ->select([
            'points.id',
            'points.name',
            'points.description',
            'points.image',
            'points.latitude',
            'points.longitude',
            'points.created_at',
            'points.updated_at',
            'points.user_id'
        ])
            ;

            if (Schema::hasTable('users')) {
                $query = $query->leftJoin('users', 'points.user_id', '=', 'users.id');
            }

            $points = $query->get();

    $geojson = [
        'type' => 'FeatureCollection',
        'features' => [],
    ];

            foreach ($points as $point) {
        $geometry = [
            'type' => 'Point',
            'coordinates' => [
                isset($point->longitude) ? (float) $point->longitude : null,
                isset($point->latitude) ? (float) $point->latitude : null,
            ],
        ];

        $feature = [
            'type' => 'Feature',
            'geometry' => $geometry,
            'properties' => [
                'id' => $point->id,
                'name' => $point->name,
                'description' => $point->description,
                'created_at' => $point->created_at,
                'updated_at' => $point->updated_at,
                'image' => $point->image,
                'user_id' => $point->user_id,
                'user_created' => isset($point->user_created) ? $point->user_created : null,
            ],
        ];

        array_push($geojson['features'], $feature);
            }
            return $geojson;
        } catch (\Exception $e) {
        Log::error('geojson_points error: ' . $e->getMessage());
        return ['type' => 'FeatureCollection', 'features' => []];
    }
}

    public function geojson_point($id)
    {
        $points = $this
            ->select(['id', 'name', 'description', 'image', 'latitude', 'longitude', 'created_at', 'updated_at'])
            ->where('id', $id)
            ->get();

        $geojson = [
            'type' => 'FeatureCollection',
            'features' => [],
        ];

        foreach ($points as $point) {
            $geometry = [
                'type' => 'Point',
                'coordinates' => [
                    isset($point->longitude) ? (float) $point->longitude : null,
                    isset($point->latitude) ? (float) $point->latitude : null,
                ],
            ];

            $feature = [
                'type' => 'Feature',
                'geometry' => $geometry,
                'properties' => [
                    'id' => $point->id,
                    'name' => $point->name,
                    'description' => $point->description,
                    'created_at' => $point->created_at,
                    'updated_at' => $point->updated_at,
                    'image' => $point->image,
                ],
            ];

            array_push($geojson['features'], $feature);
        }
        return $geojson;
    }

    protected $fillable = [
        'geom',
        'name',
        'description',
        'image',
        'user_id',
        'user_created',
    ];
}
