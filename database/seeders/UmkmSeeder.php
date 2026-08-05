<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UmkmSeeder extends Seeder
{
    public function run()
    {
        // Data UMKM (14 titik)
        $data = [
            ['nama' => 'Kolam Pancing Banyumili', 'kategori' => 'Perikanan', 'latitude' => -8.474798687, 'longitude' => 114.113310520],
            ['nama' => 'Tiga bersaudara material', 'kategori' => 'Kerajinan', 'latitude' => -8.472011279, 'longitude' => 114.117579604],
            ['nama' => 'Ud.Mela', 'kategori' => 'Kerajinan', 'latitude' => -8.476189710, 'longitude' => 114.119032740],
            ['nama' => 'Warung tepi ladang (parno)', 'kategori' => 'Minuman', 'latitude' => -8.481255365, 'longitude' => 114.105565498],
            ['nama' => 'Zha Craft Florist Hand Made', 'kategori' => 'Kerajinan', 'latitude' => -8.470250768, 'longitude' => 114.114569841],
            ['nama' => 'Toko Bu Rohima', 'kategori' => 'Kelontong', 'latitude' => -8.449062000, 'longitude' => 114.085828000],
            ['nama' => 'Toko Bu Sumarti', 'kategori' => 'Kelontong', 'latitude' => -8.449273791, 'longitude' => 114.088237460],
            ['nama' => 'Toko Cahaya Tani Barurejo', 'kategori' => 'Pertanian', 'latitude' => -8.453642778, 'longitude' => 114.090258828],
            ['nama' => 'Toko Dwi Jaya', 'kategori' => 'Kelontong', 'latitude' => -8.443856228, 'longitude' => 114.088659866],
            ['nama' => 'Toko Kelontong Mba Maryam', 'kategori' => 'Kelontong', 'latitude' => -8.453531558, 'longitude' => 114.089954119],
            ['nama' => 'Toko Madura Ayang Cindi', 'kategori' => 'Kelontong', 'latitude' => -8.451765030, 'longitude' => 114.084753790],
            ['nama' => 'Toko Pojok Pak Paidi', 'kategori' => 'Makanan dan minuman', 'latitude' => -8.453933480, 'longitude' => 114.084032770],
            ['nama' => 'Warung bu Sri Yati', 'kategori' => 'Kelontong', 'latitude' => -8.450408227, 'longitude' => 114.085864233],
            ['nama' => 'Warung kitiran', 'kategori' => 'Makanan dan minuman', 'latitude' => -8.460110160, 'longitude' => 114.075158010],
        ];

        foreach ($data as $item) {
            DB::table('umkm')->insert([
                'nama' => $item['nama'],
                'kategori' => $item['kategori'],
                'latitude' => $item['latitude'],
                'longitude' => $item['longitude'],
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }

        echo "✅ Berhasil import " . count($data) . " data UMKM!\n";
    }
}
