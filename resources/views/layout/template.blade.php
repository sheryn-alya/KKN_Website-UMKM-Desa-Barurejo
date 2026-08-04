<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'WebGIS UMKM Desa Barurejo' }}</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- Font Awesome 6 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">

    <!-- Favicon -->
    <link rel="icon" type="image/webp" href="{{ asset('images/Logo-Banyuwangi.webp') }}">

    <!-- ============================================
    STYLE GLOBAL
    ============================================ -->
    <style>
        /* ============================================
           ROOT VARIABLES
           ============================================ */
        :root {
            --primary-green: #1E5E0C;
            --primary-green-dark: #1a472a;
            --primary-green-light: #2d6a4f;
            --accent-green: #CEE84B;
            --accent-green-hover: #b8d43a;
            --text-dark: #1e2a3a;
            --text-muted: #6c757d;
            --bg-light: #f8f9fa;
            --white: #ffffff;
            --shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            --shadow-hover: 0 8px 30px rgba(0, 0, 0, 0.15);
            --radius: 12px;
            --transition: all 0.3s ease;
        }

        /* ============================================
           RESET & BASE
           ============================================ */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--bg-light);
            color: var(--text-dark);
            padding-top: 0;
            overflow-x: hidden;
        }

        a {
            text-decoration: none;
            transition: var(--transition);
        }

        a:hover {
            color: var(--primary-green);
        }

        /* ============================================
           SCROLLBAR
           ============================================ */
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb {
            background: var(--primary-green);
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: var(--primary-green-dark);
        }

        /* ============================================
           UTILITY CLASSES
           ============================================ */
        .text-accent {
            color: var(--accent-green);
        }

        .bg-accent {
            background-color: var(--accent-green);
        }

        .text-primary-green {
            color: var(--primary-green);
        }

        .bg-primary-green {
            background-color: var(--primary-green);
        }

        .shadow-custom {
            box-shadow: var(--shadow);
        }

        .shadow-custom-hover {
            transition: var(--transition);
        }

        .shadow-custom-hover:hover {
            box-shadow: var(--shadow-hover);
            transform: translateY(-4px);
        }

        .section-title {
            font-size: 2.6rem;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 0.5rem;
        }

        .section-title span {
            color: var(--primary-green);
        }

        .section-subtitle {
            font-size: 1.1rem;
            color: var(--text-muted);
            max-width: 600px;
            margin: 0 auto 2.5rem auto;
            text-align: center;
        }

        .btn-green {
            background-color: var(--accent-green);
            color: var(--text-dark);
            font-weight: 600;
            border: none;
            border-radius: 50px;
            padding: 12px 32px;
            font-size: 1rem;
            transition: var(--transition);
            display: inline-flex;
            align-items: center;
            gap: 10px;
        }

        .btn-green:hover {
            background-color: var(--accent-green-hover);
            color: var(--white);
            transform: translateY(-3px);
            box-shadow: 0 6px 20px rgba(206, 232, 75, 0.4);
        }

        .btn-outline-green {
            background-color: transparent;
            color: var(--white);
            font-weight: 600;
            border: 2px solid var(--accent-green);
            border-radius: 50px;
            padding: 12px 32px;
            font-size: 1rem;
            transition: var(--transition);
            display: inline-flex;
            align-items: center;
            gap: 10px;
        }

        .btn-outline-green:hover {
            background-color: rgba(206, 232, 75, 0.15);
            color: var(--accent-green);
            transform: translateY(-3px);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
        }

        /* ============================================
           ALERT / TOAST CUSTOM
           ============================================ */
        .alert-custom {
            border-radius: var(--radius);
            border-left: 4px solid var(--primary-green);
            box-shadow: var(--shadow);
        }

        /* ============================================
           RESPONSIVE
           ============================================ */
        @media (max-width: 768px) {
            .section-title {
                font-size: 2rem;
            }

            .section-subtitle {
                font-size: 1rem;
                padding: 0 1rem;
            }

            .btn-green,
            .btn-outline-green {
                padding: 10px 24px;
                font-size: 0.9rem;
            }
        }

        @media (max-width: 576px) {
            .section-title {
                font-size: 1.8rem;
            }

            .btn-green,
            .btn-outline-green {
                padding: 8px 18px;
                font-size: 0.85rem;
                width: 100%;
                justify-content: center;
            }
        }
    </style>

    @yield('styles')
</head>

<body>
    <!-- ============================================
         NAVBAR
         ============================================ -->
    @include('components.navbar')

    <!-- ============================================
         MAIN CONTENT
         ============================================ -->
    <main>
        @yield('content')
    </main>

    <!-- ============================================
         FOOTER
         ============================================ -->
    <footer class="footer-umkm">
        <div class="container">
            <div class="footer-content">
                <div class="footer-brand">
                    <i class="fas fa-store-alt footer-logo-icon"></i>
                    <div>
                        <h5 class="footer-title">WebGIS UMKM</h5>
                        <p class="footer-subtitle">Desa Barurejo, Kecamatan Siliragung</p>
                    </div>
                </div>
                <div class="footer-links">
                    <a href="{{ route('home') }}">Beranda</a>
                    <a href="{{ route('map') }}">Peta</a>
                    <a href="{{ route('umkm') }}">UMKM</a>
                    <a href="{{ route('berita') }}">Berita</a>
                    <a href="{{ route('kontak') }}">Kontak</a>
                </div>
                <div class="footer-social">
                    <a href="https://www.instagram.com/pemdes_barurejo?utm_source=ig_web_button_share_sheet&igsh=ZDNlZDc0MzIxNw==" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                    <a href="www.youtube.com/@desabarurejobwi" aria-label="YouTube"><i class="fab fa-youtube"></i></a>
                    <a href="facebook.com/desabarurejo" aria-label="Facebook"><i class="fab fa-facebook"></i></a>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; {{ date('Y') }} WebGIS UMKM Desa Barurejo | Program KKN-PPM 2026</p>            </div>
        </div>
    </footer>

    <!-- ============================================
         TOAST / NOTIFICATION
         ============================================ -->
    @include('components.toast')

    <!-- ============================================
         SCRIPTS
         ============================================ -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    @yield('scripts')

    <!-- ============================================
     SCRIPT GLOBAL
     ============================================ -->
    <script>
        // ============================================
        // AUTO CLOSE ALERT
        // ============================================
        document.addEventListener('DOMContentLoaded', function() {
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(alert => {
                setTimeout(() => {
                    alert.classList.remove('show');
                    setTimeout(() => alert.remove(), 300);
                }, 5000);
            });
        });

        // ============================================
        // SMOOTH SCROLL
        // ============================================
        document.querySelectorAll('a[href^="#"]:not([href="#"])').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                const targetId = this.getAttribute('href');
                if (targetId && targetId !== '#') {
                    e.preventDefault();
                    const target = document.querySelector(targetId);
                    if (target) {
                        target.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                    }
                }
            });
        });
    </script>
</body>

</html>

<!-- ============================================
     CSS FOOTER
     ============================================ -->
<style>
    /* ============================================
       FOOTER UMKM BARUREJO
       ============================================ */
    .footer-umkm {
        background: linear-gradient(135deg, #1a472a 0%, #1E5E0C 100%);
        color: rgba(255, 255, 255, 0.8);
        padding: 40px 0 20px 0;
        border-top: 3px solid #CEE84B;
        margin-top: 0;
    }

    .footer-content {
        display: grid;
        grid-template-columns: 1fr auto 1fr;
        align-items: center;
        gap: 30px;
        padding-bottom: 20px;
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    }

    .footer-brand {
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .footer-logo-icon {
        font-size: 2rem;
        color: #CEE84B;
        background: rgba(255, 255, 255, 0.1);
        padding: 12px;
        border-radius: 50%;
        width: 55px;
        height: 55px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .footer-title {
        font-weight: 700;
        font-size: 1.1rem;
        color: #ffffff;
        margin: 0;
    }

    .footer-subtitle {
        font-size: 0.75rem;
        color: #CEE84B;
        margin: 0;
        opacity: 0.8;
    }

    .footer-links {
        display: flex;
        gap: 20px;
        flex-wrap: wrap;
        justify-content: center;
    }

    .footer-links a {
        color: rgba(255, 255, 255, 0.7);
        text-decoration: none;
        font-size: 0.85rem;
        font-weight: 500;
        transition: all 0.3s ease;
        padding: 5px 10px;
        border-radius: 5px;
    }

    .footer-links a:hover {
        color: #CEE84B;
        background: rgba(206, 232, 75, 0.1);
        transform: translateY(-2px);
    }

    .footer-social {
        display: flex;
        gap: 12px;
        justify-content: flex-end;
    }

    .footer-social a {
        color: rgba(255, 255, 255, 0.6);
        font-size: 1.2rem;
        transition: all 0.3s ease;
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.05);
        border: 1px solid rgba(255, 255, 255, 0.1);
    }

    .footer-social a:hover {
        color: #CEE84B;
        background: rgba(206, 232, 75, 0.15);
        border-color: #CEE84B;
        transform: translateY(-3px);
    }

    .footer-bottom {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding-top: 20px;
        font-size: 0.8rem;
        color: rgba(255, 255, 255, 0.5);
        flex-wrap: wrap;
        gap: 10px;
    }

    .footer-powered {
        font-size: 0.75rem;
        color: rgba(255, 255, 255, 0.4);
    }

    .footer-powered i {
        color: #ff6b6b;
        animation: heartbeat 1.5s ease-in-out infinite;
    }

    @keyframes heartbeat {
        0%,
        100% {
            transform: scale(1);
        }
        50% {
            transform: scale(1.2);
        }
    }

    /* ============================================
       FOOTER RESPONSIVE
       ============================================ */
    @media (max-width: 992px) {
        .footer-content {
            grid-template-columns: 1fr;
            text-align: center;
            gap: 20px;
        }

        .footer-brand {
            justify-content: center;
        }

        .footer-social {
            justify-content: center;
        }

        .footer-links {
            justify-content: center;
        }
    }

    @media (max-width: 576px) {
        .footer-umkm {
            padding: 30px 15px 15px 15px;
        }

        .footer-links {
            gap: 10px;
        }

        .footer-links a {
            font-size: 0.75rem;
            padding: 4px 8px;
        }

        .footer-bottom {
            flex-direction: column;
            text-align: center;
            font-size: 0.7rem;
        }

        .footer-logo-icon {
            font-size: 1.5rem;
            width: 45px;
            height: 45px;
            padding: 10px;
        }

        .footer-title {
            font-size: 0.95rem;
        }

        .footer-subtitle {
            font-size: 0.65rem;
        }
    }
</style>
