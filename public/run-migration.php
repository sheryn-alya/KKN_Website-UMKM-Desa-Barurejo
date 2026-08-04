<?php

// File ini hanya untuk menjalankan migration via browser (HANYA UNTUK DEVELOPMENT)
// JANGAN GUNAKAN DI PRODUCTION!

$app = require_once __DIR__.'/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$artisan = $app->make(Illuminate\Contracts\Console\Kernel::class);

try {
    // Cek apakah tabel sudah ada
    $schema = $app->make('db')->connection()->getSchemaBuilder();

    if (!$schema->hasTable('umkm')) {
        // Jalankan migration
        $artisan->call('migrate', ['--force' => true]);
        echo "✅ Migration berhasil dijalankan! Tabel 'umkm' telah dibuat.<br>";
    } else {
        echo "ℹ️ Tabel 'umkm' sudah ada.<br>";
    }

    echo "<br><a href='/'>Kembali ke Home</a>";

} catch (\Exception $e) {
    echo "❌ Error: " . $e->getMessage();
}
