<?php

namespace App\Http\Controllers;

use App\Models\PointsModel;
use App\Models\PolylinesModel;
use App\Models\PolygonsModel;
use App\Models\UmkmModel;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    protected $points;
    protected $polylines;
    protected $polygons;
    protected $umkm;

    public function __construct()
    {
        $this->points = new PointsModel();
        $this->polylines = new PolylinesModel();
        $this->polygons = new PolygonsModel();
        $this->umkm = new UmkmModel();
    }

    public function umkm()
    {
        try {
            $result = $this->umkm->geojson_umkm();
            if ($result === null || empty($result['features'])) {
                // Jika tidak ada data dari database, coba dari file GeoJSON
                $geojsonPath = public_path('geojson/merge_umkm_barurejo.geojson');
                if (file_exists($geojsonPath)) {
                    $content = file_get_contents($geojsonPath);
                    $result = json_decode($content, true);
                    if (json_last_error() === JSON_ERROR_NONE && isset($result['features'])) {
                        return response()->json($result, 200, [], JSON_NUMERIC_CHECK);
                    }
                }
                // Jika masih kosong, return empty GeoJSON
                $result = ['type' => 'FeatureCollection', 'features' => []];
            }
            return response()->json($result, 200, [], JSON_NUMERIC_CHECK);
        } catch (\Exception $e) {
            return response()->json(['type' => 'FeatureCollection', 'features' => []], 200);
        }
    }

    public function umkmDetail($id)
    {
        $result = $this->umkm->geojson_umkm($id);
        if ($result === null) {
            return response()->json(['message' => 'UMKM tidak ditemukan'], 404);
        }
        return response()->json($result, 200, [], JSON_NUMERIC_CHECK);
    }

    public function umkmByCategory($category)
    {
        $result = $this->umkm->geojson_umkm_by_category($category) ?? ['type' => 'FeatureCollection', 'features' => []];
        return response()->json($result, 200, [], JSON_NUMERIC_CHECK);
    }

    public function umkmStats()
    {
        return response()->json($this->umkm->getUmkmStats(), 200);
    }

    public function umkmSearch(Request $request)
    {
        $keyword = $request->query('q', '');
        if (empty($keyword)) {
            return $this->umkm();
        }
        $result = $this->umkm->geojson_umkm_search($keyword) ?? ['type' => 'FeatureCollection', 'features' => []];
        return response()->json($result, 200, [], JSON_NUMERIC_CHECK);
    }

    public function points()
    {
        $result = $this->points->geojson_points() ?? ['type' => 'FeatureCollection', 'features' => []];
        return response()->json($result, 200, [], JSON_NUMERIC_CHECK);
    }

    public function pointDetail($id)
    {
        $result = $this->points->geojson_point($id);
        if ($result === null) {
            return response()->json(['message' => 'Point tidak ditemukan'], 404);
        }
        return response()->json($result, 200, [], JSON_NUMERIC_CHECK);
    }

    public function polylines()
    {
        $result = $this->polylines->geojson_polylines() ?? ['type' => 'FeatureCollection', 'features' => []];
        return response()->json($result, 200, [], JSON_NUMERIC_CHECK);
    }

    public function polylineDetail($id)
    {
        $result = $this->polylines->geojson_polyline($id);
        if ($result === null) {
            return response()->json(['message' => 'Polyline tidak ditemukan'], 404);
        }
        return response()->json($result, 200, [], JSON_NUMERIC_CHECK);
    }

    public function polygons()
    {
        $result = $this->polygons->geojson_polygons() ?? ['type' => 'FeatureCollection', 'features' => []];
        return response()->json($result, 200, [], JSON_NUMERIC_CHECK);
    }

    public function polygonDetail($id)
    {
        $result = $this->polygons->geojson_polygon($id);
        if ($result === null) {
            return response()->json(['message' => 'Polygon tidak ditemukan'], 404);
        }
        return response()->json($result, 200, [], JSON_NUMERIC_CHECK);
    }
}
