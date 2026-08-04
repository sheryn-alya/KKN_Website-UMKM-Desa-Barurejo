<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class UmkmModel extends Model
{
    protected $table = 'umkm';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'nama',
        'kategori',
        'deskripsi',
        'alamat',
        'kontak',
        'jam_buka',
        'produk',
        'foto',
        'latitude',
        'longitude',
        'google_maps_link'
    ];

    protected $casts = [
        'produk' => 'array',
    ];

    /**
     * Get all UMKM in GeoJSON format
     */
    public function geojson_umkm($id = null)
    {
        $query = DB::table($this->table)
            ->select([
                'id',
                'nama',
                'kategori',
                'deskripsi',
                'alamat',
                'kontak',
                'jam_buka',
                'produk',
                'foto',
                'latitude',
                'longitude',
                'google_maps_link'
            ]);

        if ($id) {
            $query->where('id', $id);
        }

        $data = $query->get();

        if ($data->isEmpty()) {
            return null;
        }

        $geojson = [
            'type' => 'FeatureCollection',
            'features' => []
        ];

        foreach ($data as $item) {
            $feature = [
                'type' => 'Feature',
                'geometry' => [
                    'type' => 'Point',
                    'coordinates' => [
                        (float) $item->longitude,
                        (float) $item->latitude
                    ]
                ],
                'properties' => [
                    'id' => $item->id,
                    'nama' => $item->nama,
                    'kategori' => $item->kategori,
                    'deskripsi' => $item->deskripsi,
                    'alamat' => $item->alamat,
                    'kontak' => $item->kontak,
                    'jam_buka' => $item->jam_buka,
                    'produk' => json_decode($item->produk, true) ?: [],
                    'foto' => $item->foto,
                    'google_maps_link' => $item->google_maps_link
                ]
            ];
            $geojson['features'][] = $feature;
        }

        return $geojson;
    }

    /**
     * Get UMKM by category
     */
    public function geojson_umkm_by_category($category)
    {
        $data = DB::table($this->table)
            ->where('kategori', $category)
            ->get();

        if ($data->isEmpty()) {
            return null;
        }

        return $this->formatToGeojson($data);
    }

    /**
     * Get UMKM statistics
     */
    public function getUmkmStats()
    {
        $total = DB::table($this->table)->count();

        $categories = DB::table($this->table)
            ->select('kategori', DB::raw('count(*) as total'))
            ->groupBy('kategori')
            ->get();

        $totalProduk = DB::table($this->table)
            ->select('produk')
            ->get()
            ->reduce(function ($carry, $item) {
                $produk = json_decode($item->produk, true);
                return $carry + (is_array($produk) ? count($produk) : 0);
            }, 0);

        return [
            'total_umkm' => $total,
            'total_kategori' => $categories->count(),
            'total_produk' => $totalProduk,
            'kategori' => $categories
        ];
    }

    /**
     * Format data to GeoJSON
     */
    private function formatToGeojson($data)
    {
        $geojson = [
            'type' => 'FeatureCollection',
            'features' => []
        ];

        foreach ($data as $item) {
            $feature = [
                'type' => 'Feature',
                'geometry' => [
                    'type' => 'Point',
                    'coordinates' => [
                        (float) $item->longitude,
                        (float) $item->latitude
                    ]
                ],
                'properties' => [
                    'id' => $item->id,
                    'nama' => $item->nama,
                    'kategori' => $item->kategori,
                    'deskripsi' => $item->deskripsi,
                    'alamat' => $item->alamat,
                    'kontak' => $item->kontak,
                    'jam_buka' => $item->jam_buka,
                    'produk' => json_decode($item->produk, true) ?: [],
                    'foto' => $item->foto,
                    'google_maps_link' => $item->google_maps_link
                ]
            ];
            $geojson['features'][] = $feature;
        }

        return $geojson;
    }

    /**
     * Search UMKM by keyword (name or product)
     */
    public function geojson_umkm_search($keyword)
    {
        $data = DB::table($this->table)
            ->where('nama', 'LIKE', "%{$keyword}%")
            ->orWhere('produk', 'LIKE', "%{$keyword}%")
            ->orWhere('deskripsi', 'LIKE', "%{$keyword}%")
            ->get();

        if ($data->isEmpty()) {
            return null;
        }

        return $this->formatToGeojson($data);
    }
}
