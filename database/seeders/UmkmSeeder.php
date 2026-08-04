<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UmkmSeeder extends Seeder
{
    public function run()
    {
        // Cek apakah data sudah ada
        if (DB::table('umkm')->count() > 0) {
            $this->command->info('✅ Data UMKM sudah ada!');
            return;
        }

        // Baca file GeoJSON
        $path = public_path('geojson/merge_umkm_barurejo.geojson');
        if (!file_exists($path)) {
            $this->command->error('❌ File GeoJSON tidak ditemukan!');
            return;
        }

        $data = file_get_contents($path);
        $json = json_decode($data, true);

        $count = 0;
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
            $count++;
        }

        $this->command->info("✅ Berhasil import $count data UMKM!!!");
    }
}
