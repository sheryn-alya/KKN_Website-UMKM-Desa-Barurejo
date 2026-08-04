<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\UmkmModel;

class ImportUmkmCsv extends Command
{
    protected $signature = 'import:umkm {path?}';
    protected $description = 'Import UMKM CSV file into umkm table';

    public function handle()
    {
        $path = $this->argument('path') ?? \storage_path('app/import/umkm_barurejo.csv');

        if (!file_exists($path)) {
            $this->error('File not found: ' . $path);
            return 1;
        }

        if (($handle = fopen($path, 'r')) === false) {
            $this->error('Unable to open file: ' . $path);
            return 1;
        }

        $header = fgetcsv($handle);
        if ($header === false) {
            $this->error('Empty CSV file');
            return 1;
        }

        $count = 0;
        while (($row = fgetcsv($handle)) !== false) {
            $data = array_combine($header, $row);
            if ($data === false) continue;

            UmkmModel::updateOrCreate(
                ['id' => $data['id'] ?? null],
                [
                    'nama' => $data['nama'] ?? null,
                    'kategori' => $data['kategori'] ?? null,
                    'deskripsi' => $data['deskripsi'] ?? null,
                    'alamat' => $data['alamat'] ?? null,
                    'kontak' => $data['kontak'] ?? null,
                    'jam_buka' => $data['jam_buka'] ?? null,
                    'produk' => isset($data['produk']) ? json_encode(explode('|', $data['produk'])) : null,
                    'foto' => $data['foto'] ?? null,
                    'latitude' => $data['latitude'] ?? null,
                    'longitude' => $data['longitude'] ?? null,
                    'google_maps_link' => $data['google_maps_link'] ?? null,
                ]
            );
            $count++;
        }

        fclose($handle);

        $this->info("Imported {$count} rows from {$path}");
        return 0;
    }
}
