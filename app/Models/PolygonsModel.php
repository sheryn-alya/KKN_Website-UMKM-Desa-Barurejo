<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class PolygonsModel extends Model
{
    protected $table = 'polygons';
    protected $guarded = ['id'];

    public function geojson_polygons()
    {
        try {
            $query = $this
                ->select([
                    'polygons.id',
                    'polygons.name',
                    'polygons.description',
                    'polygons.image',
                    'polygons.coordinates',
                    'polygons.created_at',
                    'polygons.updated_at',
                    'polygons.user_id'
                ]);

            if (Schema::hasTable('users')) {
                $query = $query->leftJoin('users', 'polygons.user_id', '=', 'users.id');
            }

            $polygons = $query->get();

            $geojson = [
                'type' => 'FeatureCollection',
                'features' => [],
            ];

            foreach ($polygons as $polygon) {
                $coords = null;
                if (!empty($polygon->coordinates)) {
                    $coords = json_decode($polygon->coordinates, true);
                }

                $geometry = [
                    'type' => 'Polygon',
                    'coordinates' => $coords ?: [],
                ];

                $feature = [
                    'type' => 'Feature',
                    'geometry' => $geometry,
                    'properties' => [
                        'id' => $polygon->id,
                        'name' => $polygon->name,
                        'description' => $polygon->description,
                        'image' => $polygon->image,
                        'user_id' => $polygon->user_id,
                        'user_created' => isset($polygon->user_created) ? $polygon->user_created : null,
                        'created_at' => $polygon->created_at,
                        'updated_at' => $polygon->updated_at,
                    ],
                ];

                $geojson['features'][] = $feature;
            }

            return $geojson;
        } catch (\Exception $e) {
            Log::error('geojson_polygons error: ' . $e->getMessage());
            return ['type' => 'FeatureCollection', 'features' => []];
        }
    }

    public function geojson_polygon($id)
    {
        try {
            $polygon = DB::table($this->table)
                ->select('id', 'name', 'description', 'image', 'coordinates', 'created_at', 'updated_at')
                ->where('id', $id)
                ->first();

            if (!$polygon) {
                return null;
            }

            $coords = !empty($polygon->coordinates) ? json_decode($polygon->coordinates, true) : [];

            $feature = [
                'type' => 'Feature',
                'geometry' => [
                    'type' => 'Polygon',
                    'coordinates' => $coords,
                ],
                'properties' => [
                    'id' => $polygon->id,
                    'name' => $polygon->name,
                    'description' => $polygon->description,
                    'image' => $polygon->image,
                    'luas' => null,
                    'created_at' => $polygon->created_at,
                    'updated_at' => $polygon->updated_at,
                ],
            ];

            return [
                'type' => 'FeatureCollection',
                'features' => [$feature],
            ];
        } catch (\Exception $e) {
            Log::error('geojson_polygon error: ' . $e->getMessage());
            return null;
        }
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
