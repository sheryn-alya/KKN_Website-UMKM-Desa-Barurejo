<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UmkmSeeder extends Seeder
{
    public function run()
    {
        if (DB::table('umkm')->count() > 0) {
            return;
        }

        $path = public_path('geojson/merge_umkm_barurejo.geojson');
        if (!file_exists($path)) {
            return;
        }

        $data = file_get_contents($path);
        $json = json_decode($data, true);

        foreach ($json['features'] as $feature) {
            $props = $feature['properties'];
            $coords = $feature['geometry']['coordinates'];

            DB::table('umkm')->insert([
                'nama' => $props['Name'] ?? 'UMKM',
                'kategori' => trim($props['Kategori'] ?? '-'),
                'deskripsi' => '',
                'alamat' => '',
                'kontak' => '',
                'jam_buka' => '',
                'produk' => json_encode([$props['Produk'] ?? '']),
                'foto' => $props['Foto'] ?? null,
                'latitude' => $coords[1],
                'longitude' => $coords[0],
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
}
