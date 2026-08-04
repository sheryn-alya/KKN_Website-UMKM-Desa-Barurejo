<style>
    /* ============================================
       NAVBAR UMKM BARUREJO - TEMA HIJAU
       ============================================ */
    .navbar-umkm {
        background: linear-gradient(135deg, #1a472a 0%, #2d6a4f 50%, #1E5E0C 100%) !important;
        font-family: 'Poppins', sans-serif;
        font-weight: 500;
        padding: 0 20px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.25);
        border-bottom: 3px solid #CEE84B;
        position: sticky;
        top: 0;
        z-index: 100;
    }

    .navbar-umkm .navbar-brand {
        display: flex;
        align-items: center;
        gap: 10px;
        color: #ffffff !important;
        font-weight: 700;
        font-size: 1.1rem;
        letter-spacing: 0.5px;
        padding: 8px 0;
        text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
    }

    .navbar-umkm .navbar-brand i {
        color: #CEE84B;
        font-size: 1.3rem;
    }

    .navbar-umkm .navbar-brand .brand-sub {
        font-weight: 300;
        font-size: 0.65rem;
        color: #CEE84B;
        letter-spacing: 0.5px;
        display: block;
        line-height: 1.2;
    }

    .navbar-umkm .nav-link {
        color: rgba(255, 255, 255, 0.85) !important;
        letter-spacing: 0.5px;
        transition: all 0.3s ease;
        padding: 8px 16px;
        border-radius: 30px;
        font-weight: 500;
        font-size: 0.9rem;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .navbar-umkm .nav-link i {
        color: #CEE84B;
        font-size: 0.85rem;
    }

    .navbar-umkm .nav-link:hover,
    .navbar-umkm .nav-link.active {
        color: #ffffff !important;
        background: rgba(206, 232, 75, 0.15);
        transform: translateY(-2px);
    }

    .navbar-umkm .nav-link.active {
        background: rgba(206, 232, 75, 0.25);
        box-shadow: 0 2px 10px rgba(206, 232, 75, 0.15);
        position: relative;
    }

    .navbar-umkm .nav-link.active::after {
        content: '';
        position: absolute;
        bottom: 2px;
        left: 50%;
        transform: translateX(-50%);
        width: 20px;
        height: 3px;
        background: #CEE84B;
        border-radius: 10px;
    }

    /* ============================================
       DROPDOWN
       ============================================ */
    .navbar-umkm .dropdown-menu {
        background: #ffffff;
        border: none;
        border-radius: 12px;
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.2);
        padding: 8px 0;
        margin-top: 8px;
        font-family: 'Poppins', sans-serif;
        min-width: 200px;
    }

    .navbar-umkm .dropdown-item {
        color: #333;
        font-weight: 500;
        padding: 10px 20px;
        font-size: 0.85rem;
        transition: all 0.2s ease;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .navbar-umkm .dropdown-item i {
        color: #1E5E0C;
        width: 18px;
    }

    .navbar-umkm .dropdown-item:hover {
        background: #f0f4f0;
        color: #1E5E0C;
    }

    .navbar-umkm .dropdown-item.logout {
        color: #dc3545;
    }

    .navbar-umkm .dropdown-item.logout i {
        color: #dc3545;
    }

    .navbar-umkm .dropdown-item.logout:hover {
        background: #fde8ea;
    }

    .navbar-umkm .dropdown-toggle::after {
        border-top-color: rgba(255, 255, 255, 0.6);
    }

    .navbar-umkm .dropdown-toggle:hover::after {
        border-top-color: #CEE84B;
    }

    /* ============================================
       USER DROPDOWN
       ============================================ */
    .navbar-umkm .user-dropdown .dropdown-toggle {
        display: flex;
        align-items: center;
        gap: 8px;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 30px;
        padding: 6px 16px 6px 12px;
        border: 1px solid rgba(255, 255, 255, 0.15);
    }

    .navbar-umkm .user-dropdown .dropdown-toggle i {
        color: #CEE84B;
    }

    .navbar-umkm .user-dropdown .dropdown-toggle:hover {
        background: rgba(255, 255, 255, 0.2);
    }

    /* ============================================
       TOGGLER (HAMBURGER)
       ============================================ */
    .navbar-umkm .navbar-toggler {
        border: 2px solid rgba(255, 255, 255, 0.3);
        padding: 8px 10px;
    }

    .navbar-umkm .navbar-toggler:hover {
        border-color: #CEE84B;
        background: rgba(206, 232, 75, 0.1);
    }

    .navbar-umkm .navbar-toggler-icon {
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba(255,255,255,0.9)' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
    }

    /* ============================================
       RESPONSIVE
       ============================================ */
    @media (max-width: 992px) {
        .navbar-umkm {
            padding: 0 12px;
        }

        .navbar-umkm .navbar-nav {
            padding: 10px 0;
            gap: 4px;
        }

        .navbar-umkm .nav-link {
            padding: 10px 16px;
            border-radius: 10px;
        }

        .navbar-umkm .nav-link.active::after {
            display: none;
        }

        .navbar-umkm .nav-link.active {
            border-left: 4px solid #CEE84B;
        }

        .navbar-umkm .dropdown-menu {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            box-shadow: none;
            padding: 4px 0;
        }

        .navbar-umkm .dropdown-item {
            color: rgba(255, 255, 255, 0.8);
            padding: 8px 20px 8px 40px;
        }

        .navbar-umkm .dropdown-item:hover {
            background: rgba(206, 232, 75, 0.15);
            color: #CEE84B;
        }

        .navbar-umkm .dropdown-item i {
            color: #CEE84B;
        }

        .navbar-umkm .user-dropdown .dropdown-toggle {
            background: transparent;
            border: none;
            padding: 8px 16px;
        }

        .navbar-umkm .user-dropdown .dropdown-toggle:hover {
            background: rgba(206, 232, 75, 0.1);
        }
    }

    @media (max-width: 576px) {
        .navbar-umkm .navbar-brand {
            font-size: 0.9rem;
        }

        .navbar-umkm .navbar-brand .brand-sub {
            font-size: 0.55rem;
        }

        .navbar-umkm .nav-link {
            font-size: 0.85rem;
            padding: 8px 14px;
        }
    }
</style>

<!-- ============================================
     NAVBAR UMKM BARUREJO
     ============================================ -->
<nav class="navbar navbar-expand-lg navbar-umkm">
    <div class="container-fluid">
        <!-- Brand / Logo -->
        <a class="navbar-brand" href="{{ route('home') }}">
            <i class="fa-solid fa-store-alt"></i>
            <span>
                UMKM Barurejo
                <span class="brand-sub">Desa Siliragung</span>
            </span>
        </a>

        <!-- Toggler -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarUmkm" aria-controls="navbarUmkm"
            aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navbar Content -->
        <div class="collapse navbar-collapse" id="navbarUmkm">
            <!-- Left Menu - TABEL DIHAPUS -->
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}"
                        aria-current="page" href="{{ route('home') }}">
                        <i class="fa-solid fa-house"></i> Beranda
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('map') ? 'active' : '' }}"
                        href="{{ route('map') }}">
                        <i class="fa-solid fa-map"></i> Peta
                    </a>
                </li>
                <!-- MENU TABEL DIHAPUS -->
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('umkm') ? 'active' : '' }}"
                        href="{{ route('umkm') }}">
                        <i class="fa-solid fa-store"></i> UMKM
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('berita') ? 'active' : '' }}"
                        href="{{ route('berita') }}">
                        <i class="fa-solid fa-newspaper"></i> Berita
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('kontak') ? 'active' : '' }}"
                        href="{{ route('kontak') }}">
                        <i class="fa-solid fa-phone"></i> Kontak
                    </a>
                </li>
            </ul>

            <!-- Right Menu - LOGIN & REGISTER DIHAPUS -->
            <ul class="navbar-nav mb-2 mb-lg-0">
                @auth
                    <li class="nav-item dropdown user-dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa-solid fa-user-circle"></i> {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <a class="dropdown-item" href="{{ route('profile.edit') }}">
                                    <i class="fa-solid fa-user"></i> Profile
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ url('/dashboard') }}">
                                    <i class="fa-solid fa-gauge-high"></i> Dashboard
                                </a>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <a class="dropdown-item logout" href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="fa-solid fa-right-from-bracket"></i> Logout
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </li>
                @endauth
                <!-- LOGIN DAN REGISTER DIHAPUS -->
            </ul>
        </div>
    </div>
</nav>
