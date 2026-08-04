<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UmkmSeeder extends Seeder
{
    public function run()
    {
        $data = file_get_contents(public_path('geojson/merge_umkm_barurejo.geojson'));
        $json = json_decode($data, true);

        $count = 0;
        foreach ($json['features'] as $feature) {
            $props = $feature['properties'];
            $coords = $feature['geometry']['coordinates'];

            $kategori = trim($props['Kategori'] ?? '-');

            DB::table('umkm')->insert([
                'nama' => $props['Name'] ?? 'UMKM',
                'kategori' => $kategori,
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
            $count++;
        }

        $this->command->info("✅ Berhasil import $count data UMKM!");
    }
}
