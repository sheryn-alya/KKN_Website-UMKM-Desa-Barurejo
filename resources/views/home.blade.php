@extends('layout.template')

@section('content')
    <style>
        /* ============================================
           HERO SECTION - BACKGROUND BERGERAK (ZOOM)
           ============================================ */
        .hero-background {
            background-image: url('{{ asset('images/GUIDELINE.png') }}');
            background-size: cover;
            background-position: center;
            height: 100vh;
            position: relative;
            overflow: hidden;
        }

        @keyframes zoomBackground {
            0% {
                transform: scale(1);
            }
            100% {
                transform: scale(1.15);
            }
        }

        .hero-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            /* REDUCED OPACITY - TIDAK TERLALU BLUR */
            background: rgba(0, 0, 0, 0.35);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 2rem;
            text-align: center;
            color: #ffffff;
            z-index: 2;
        }

        .hero-overlay .desa-name {
            font-size: 1.2rem;
            font-weight: 300;
            letter-spacing: 4px;
            text-transform: uppercase;
            color: #CEE84B;
            margin-bottom: 0.5rem;
            text-shadow: 0 2px 10px rgba(0, 0, 0, 0.5);
        }

        .hero-overlay .desa-location {
            font-size: 0.85rem;
            font-weight: 300;
            letter-spacing: 2px;
            color: rgba(255, 255, 255, 0.8);
            margin-bottom: 1.5rem;
            text-shadow: 0 2px 8px rgba(0, 0, 0, 0.5);
        }

        .hero-overlay h1 {
            font-size: 3.5rem;
            font-weight: 700;
            font-family: 'Sagita', 'Poppins', sans-serif;
            text-shadow: 2px 2px 12px rgba(0, 0, 0, 0.7);
            letter-spacing: 2px;
            margin-bottom: 0.5rem;
        }

        .hero-overlay .sub-title {
            font-size: 1.3rem;
            font-weight: 300;
            color: rgba(255, 255, 255, 0.95);
            max-width: 600px;
            margin: 0 auto 1.8rem auto;
            line-height: 1.6;
            text-shadow: 1px 1px 8px rgba(0, 0, 0, 0.5);
        }

        .hero-buttons {
            display: flex;
            gap: 16px;
            flex-wrap: wrap;
            justify-content: center;
            margin-bottom: 2rem;
        }

        .btn-primary-custom {
            background-color: #CEE84B;
            color: #1a1a1a;
            font-weight: 600;
            border: none;
            border-radius: 50px;
            padding: 12px 32px;
            font-size: 1rem;
            box-shadow: 0 4px 14px rgba(0, 0, 0, 0.25);
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 10px;
        }

        .btn-primary-custom:hover {
            background-color: #b8d43a;
            color: #ffffff;
            transform: translateY(-3px);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.35);
        }

        .btn-secondary-custom {
            background-color: transparent;
            color: #ffffff;
            font-weight: 600;
            border: 2px solid #CEE84B;
            border-radius: 50px;
            padding: 12px 32px;
            font-size: 1rem;
            box-shadow: 0 4px 14px rgba(0, 0, 0, 0.25);
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 10px;
        }

        .btn-secondary-custom:hover {
            background-color: rgba(206, 232, 75, 0.15);
            color: #CEE84B;
            transform: translateY(-3px);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.35);
        }

        .scroll-indicator {
            position: absolute;
            bottom: 30px;
            left: 50%;
            transform: translateX(-50%);
            color: rgba(255, 255, 255, 0.6);
            font-size: 0.85rem;
            letter-spacing: 2px;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 8px;
            animation: bounceDown 2s infinite;
            z-index: 3;
            cursor: pointer;
        }

        .scroll-indicator i {
            font-size: 1.5rem;
            color: #CEE84B;
        }

        @keyframes bounceDown {
            0%, 20%, 50%, 80%, 100% {
                transform: translateX(-50%) translateY(0);
            }
            40% {
                transform: translateX(-50%) translateY(-10px);
            }
            60% {
                transform: translateX(-50%) translateY(-5px);
            }
        }

        /* ============================================
           LOGO HEADER DI TENGAH ATAS
           ============================================ */
        .logo-header-center {
            position: absolute;
            top: 20px;
            left: 50%;
            transform: translateX(-50%);
            z-index: 10;
            display: flex;
            align-items: center;
            gap: 20px;
            background: rgba(0, 0, 0, 0.30);
            padding: 10px 24px;
            border-radius: 50px;
            backdrop-filter: blur(3px);
            border: 1px solid rgba(206, 232, 75, 0.2);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
        }

        .logo-header-center img {
            height: 45px;
            width: auto;
            filter: drop-shadow(0 2px 6px rgba(0, 0, 0, 0.3));
        }

        .logo-header-center .logo-divider {
            width: 2px;
            height: 40px;
            background: rgba(255, 255, 255, 0.2);
        }

        .logo-header-center .text {
            color: #ffffff;
            font-weight: 700;
            line-height: 1.2;
            font-size: 1.1rem;
            text-shadow: 1px 1px 6px rgba(0, 0, 0, 0.8);
            letter-spacing: 0.5px;
            text-align: center;
        }

        .logo-header-center .text small {
            display: block;
            font-weight: 300;
            font-size: 0.7rem;
            color: #CEE84B;
            letter-spacing: 1px;
        }

        @media (max-width: 768px) {
            .logo-header-center {
                top: 15px;
                padding: 8px 16px;
                gap: 12px;
                border-radius: 30px;
            }

            .logo-header-center img {
                height: 35px;
            }

            .logo-header-center .logo-divider {
                height: 30px;
            }

            .logo-header-center .text {
                font-size: 0.85rem;
            }

            .logo-header-center .text small {
                font-size: 0.6rem;
            }

            .hero-overlay .desa-name {
                font-size: 1rem;
            }

            .hero-overlay h1 {
                font-size: 2.2rem;
            }

            .hero-overlay .sub-title {
                font-size: 1rem;
                padding: 0 1rem;
            }

            .hero-buttons {
                flex-direction: column;
                align-items: center;
                gap: 12px;
            }

            .btn-primary-custom,
            .btn-secondary-custom {
                padding: 10px 24px;
                font-size: 0.9rem;
                width: 100%;
                max-width: 280px;
                justify-content: center;
            }
        }

        @media (max-width: 576px) {
            .logo-header-center {
                top: 10px;
                padding: 6px 12px;
                gap: 8px;
                border-radius: 20px;
            }

            .logo-header-center img {
                height: 28px;
            }

            .logo-header-center .logo-divider {
                height: 24px;
            }

            .logo-header-center .text {
                font-size: 0.7rem;
            }

            .logo-header-center .text small {
                font-size: 0.5rem;
            }

            .hero-overlay .desa-name {
                font-size: 0.85rem;
                letter-spacing: 2px;
            }

            .hero-overlay .desa-location {
                font-size: 0.7rem;
            }

            .hero-overlay h1 {
                font-size: 1.8rem;
            }

            .hero-overlay .sub-title {
                font-size: 0.9rem;
            }

            .btn-primary-custom,
            .btn-secondary-custom {
                padding: 8px 18px;
                font-size: 0.8rem;
                max-width: 220px;
            }

            .scroll-indicator {
                font-size: 0.7rem;
            }

            .scroll-indicator i {
                font-size: 1.2rem;
            }
        }

        /* ============================================
           SECTION BERITA / INFORMASI TERKINI
           ============================================ */
        .berita-container {
            padding: 4rem 2rem;
            background-color: #f8f9fa;
        }

        .berita-heading {
            text-align: center;
            font-size: 2.6rem;
            font-weight: 700;
            color: #1e2a3a;
            margin-bottom: 0.25rem;
        }

        .berita-heading span {
            color: #1E5E0C;
        }

        .berita-subtitle {
            text-align: center;
            font-size: 1.1rem;
            color: #6c757d;
            margin-bottom: 2.5rem;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
        }

        .berita-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 1.75rem;
        }

        .berita-card {
            background-color: #ffffff;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.07);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .berita-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 8px 28px rgba(0, 0, 0, 0.12);
        }

        .berita-card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .berita-tanggal {
            background-color: #1E5E0C;
            color: #ffffff;
            font-size: 0.85rem;
            padding: 0.5rem 1rem;
            text-align: center;
            font-weight: 500;
            letter-spacing: 0.5px;
        }

        .berita-judul {
            padding: 1.25rem 1rem;
            font-weight: 600;
            text-align: center;
            font-size: 1rem;
            min-height: 80px;
            color: #1e2a3a;
            line-height: 1.5;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* ============================================
           GALERI DOKUMENTASI
           ============================================ */
        .gallery-container {
            background-color: #ffffff;
            padding: 4rem 2rem;
            text-align: center;
        }

        .gallery-container h2 {
            font-size: 2.4rem;
            font-weight: 700;
            color: #1e2a3a;
            margin-bottom: 0.5rem;
        }

        .gallery-container h2 span {
            color: #1E5E0C;
        }

        .gallery-subtitle {
            color: #6c757d;
            font-size: 1.05rem;
            margin-bottom: 2.5rem;
        }

        .gallery-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 1.5rem;
            max-width: 1200px;
            margin: 0 auto;
        }

        .gallery-card {
            background-color: #ffffff;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 14px rgba(0, 0, 0, 0.06);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .gallery-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.10);
        }

        .gallery-card img {
            width: 100%;
            height: 250px;
            object-fit: cover;
            display: block;
            transition: transform 0.4s ease;
        }

        .gallery-card:hover img {
            transform: scale(1.03);
        }

        /* ============================================
           RESPONSIVE - TABLET & HP
           ============================================ */
        @media (max-width: 576px) {
            .berita-container {
                padding: 2.5rem 1rem;
            }

            .berita-heading {
                font-size: 2rem;
            }

            .gallery-container {
                padding: 2.5rem 1rem;
            }

            .gallery-container h2 {
                font-size: 1.8rem;
            }

            .gallery-card img {
                height: 200px;
            }
        }
    </style>

    <!-- ============================================
         HERO / BANNER UTAMA - BACKGROUND BERGERAK
         ============================================ -->
    <div class="hero-background">
        <!-- LOGO DI TENGAH ATAS -->
        <div class="logo-header-center">
            <img src="{{ asset('images/Logo-Banyuwangi.webp') }}" alt="Logo Banyuwangi">
            <div class="logo-divider"></div>
            <img src="{{ asset('images/KKN.png') }}" alt="Logo KKN">
            <div class="logo-divider"></div>
            <div class="text">
                DESA BARUREJO
                <small>Kecamatan Siliragung</small>
            </div>
        </div>

        <div class="hero-overlay">
            <div class="desa-name">Desa Barurejo</div>
            <div class="desa-location">KECAMATAN SILIRAGUNG • KABUPATEN BANYUWANGI</div>

            <h1>Selamat Datang</h1>
            <p class="sub-title">
                Kenali desa kami lebih dekat. Jelajahi produk UMKM warga,
                agenda dan kabar desa, serta peta digital interaktif Desa Barurejo.
            </p>

            <div class="hero-buttons">
                <a href="{{ route('map') }}" class="btn-secondary-custom">
                    <i class="fas fa-map-marked-alt me-2"></i> Jelajahi Peta
                </a>
            </div>
        </div>

        <!-- SCROLL INDICATOR -->
        <div class="scroll-indicator" onclick="scrollToBerita()">
            <span>Gulir untuk mengenal desa</span>
            <i class="fas fa-chevron-down"></i>
        </div>
    </div>

    <!-- ============================================
         SECTION INFORMASI TERKINI / BERITA
         ============================================ -->
    <div class="berita-container" id="beritaSection">
        <h2 class="berita-heading">Informasi <span>UMKM</span></h2>
        <p class="berita-subtitle">
            Program kerja terkait pengembangan dan potensi UMKM di Desa Barurejo.
        </p>

        <div class="berita-grid">
            <!-- Kartu Berita 1 -->
            <div class="berita-card">
                <img src="{{ asset('images/dini.jpg') }}" alt="Pelatihan UMKM">
                <div class="berita-tanggal">📅 21 Juli 2026</div>
                <div class="berita-judul">
                    Konsultasi UMKM untuk Mencapai UMKM Naik Kelas
                </div>
            </div>

            <!-- Kartu Berita 2 -->
            <div class="berita-card">
                <img src="{{ asset('images/naila.jpg') }}" alt="Bazar UMKM">
                <div class="berita-tanggal">📅 25 Juli 2026</div>
                <div class="berita-judul">
                    Geotagging Barurejo: Layanan Pendaftaran Google Maps untuk UMKM
                </div>
            </div>

            <!-- Kartu Berita 3 -->
            <div class="berita-card">
                <img src="{{ asset('images/tiara.jpg') }}" alt="Pendampingan UMKM">
                <div class="berita-tanggal">📅 26 Juli 2026</div>
                <div class="berita-judul">
                    Registrasi QRIS untuk Meningkatkan Digitalisasi Transaksi UMKM
                </div>
            </div>
        </div>
    </div>

    <!-- ============================================
         GALERI DOKUMENTASI
         ============================================ -->
    <div class="gallery-container">
        <h2>Galeri <span>Dokumentasi</span></h2>
        <p class="gallery-subtitle">
            Dokumentasi kegiatan pemberdayaan dan promosi UMKM Desa Barurejo.
        </p>

        <div class="gallery-grid">
            <div class="gallery-card">
                <img src="{{ asset('images/dok1.jpg') }}" alt="Dokumentasi Kegiatan UMKM 1">
            </div>
            <div class="gallery-card">
                <img src="{{ asset('images/dok2.jpg') }}" alt="Dokumentasi Kegiatan UMKM 2">
            </div>
            <!-- <div class="gallery-card">
                <img src="{{ asset('images/Warung tepi ladang (parno) 2.jpg') }}" alt="Dokumentasi Kegiatan UMKM 3">
            </div> -->
            <div class="gallery-card">
                <img src="{{ asset('images/Ud.Mela 2.jpg') }}" alt="Dokumentasi Kegiatan UMKM 4">
            </div>
            <!-- <div class="gallery-card">
                <img src="{{ asset('images/dok5.jpg') }}" alt="Dokumentasi Kegiatan UMKM 5">
            </div> -->
            <div class="gallery-card">
                <img src="{{ asset('images/dok6.jpg') }}" alt="Dokumentasi Kegiatan UMKM 6">
            </div>
        </div>
    </div>

    <!-- ============================================
         SCRIPT
         ============================================ -->
    <script>
        // ============================================
        // SCROLL KE BAGIAN BERITA
        // ============================================
        function scrollToBerita() {
            const beritaSection = document.getElementById('beritaSection');
            if (beritaSection) {
                beritaSection.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        }

        // ============================================
        // SMOOTH SCROLL UNTUK NAVIGASI INTERNAL
        // ============================================
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener("click", function(e) {
                const targetId = this.getAttribute("href");
                if (targetId !== "#") {
                    e.preventDefault();
                    const target = document.querySelector(targetId);
                    if (target) {
                        target.scrollIntoView({
                            behavior: "smooth",
                            block: "start"
                        });
                    }
                }
            });
        });
    </script>
@endsection
