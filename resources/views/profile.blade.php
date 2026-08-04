@extends('layout.template')

@section('content')
<div class="container py-5">
    <div class="text-center mb-5">
        <h1 class="display-4 fw-bold" style="color: #1E5E0C;">Profil UMKM</h1>
        <p class="text-muted">Informasi dan daftar UMKM Desa Barurejo</p>
    </div>

    <div class="row g-4">
        <!-- Card Profil Desa -->
        <div class="col-lg-4">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body text-center p-4">
                    <div class="bg-success bg-opacity-10 p-3 rounded-circle d-inline-block mb-3">
                        <i class="fas fa-store text-success fa-3x"></i>
                    </div>
                    <h5 class="fw-bold">Total UMKM</h5>
                    <h2 class="text-success">15+</h2>
                    <p class="text-muted small">UMKM terdaftar di Desa Barurejo</p>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body text-center p-4">
                    <div class="bg-success bg-opacity-10 p-3 rounded-circle d-inline-block mb-3">
                        <i class="fas fa-tags text-success fa-3x"></i>
                    </div>
                    <h5 class="fw-bold">Kategori</h5>
                    <h2 class="text-success">5</h2>
                    <p class="text-muted small">Makanan, Fashion, Kerajinan, Jasa, Pertanian</p>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body text-center p-4">
                    <div class="bg-success bg-opacity-10 p-3 rounded-circle d-inline-block mb-3">
                        <i class="fas fa-users text-success fa-3x"></i>
                    </div>
                    <h5 class="fw-bold">Pelaku UMKM</h5>
                    <h2 class="text-success">25+</h2>
                    <p class="text-muted small">Pelaku usaha aktif di Desa Barurejo</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Daftar UMKM -->
    <div class="mt-5">
        <h3 class="fw-bold mb-4">Daftar UMKM</h3>
        <div class="row g-4">
            <div class="col-md-4">
                <div class="card shadow-sm border-0 h-100">
                    <img src="{{ asset('images/dok1.jpg') }}" class="card-img-top" alt="UMKM" style="height: 180px; object-fit: cover;">
                    <div class="card-body">
                        <span class="badge bg-success mb-2">Makanan</span>
                        <h5 class="card-title">Keripik Tempe Barurejo</h5>
                        <p class="card-text small text-muted">Keripik tempe renyah berbagai varian rasa.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card shadow-sm border-0 h-100">
                    <img src="{{ asset('images/dok2.jpg') }}" class="card-img-top" alt="UMKM" style="height: 180px; object-fit: cover;">
                    <div class="card-body">
                        <span class="badge bg-success mb-2">Fashion</span>
                        <h5 class="card-title">Batik Tulis Barurejo</h5>
                        <p class="card-text small text-muted">Batik tulis motif daun dan bunga lokal.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card shadow-sm border-0 h-100">
                    <img src="{{ asset('images/dok3.jpg') }}" class="card-img-top" alt="UMKM" style="height: 180px; object-fit: cover;">
                    <div class="card-body">
                        <span class="badge bg-success mb-2">Kerajinan</span>
                        <h5 class="card-title">Anyaman Bambu Barurejo</h5>
                        <p class="card-text small text-muted">Kerajinan anyaman bambu berkualitas.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
