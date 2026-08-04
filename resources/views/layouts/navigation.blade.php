<nav x-data="{ open: false }" class="navbar-umkm">
    <div class="container-nav">
        <!-- Logo -->
        <div class="navbar-logo">
            <a href="{{ route('home') }}">
                <img src="{{ asset('images/Logo-Banyuwangi.webp') }}" alt="Logo" class="logo-img">
                <div class="logo-text">
                    <span class="logo-title">UMKM Barurejo</span>
                    <span class="logo-subtitle">Desa Siliragung</span>
                </div>
            </a>
        </div>

        <!-- Navigation Links (Desktop) -->
        <ul class="navbar-menu" id="navbarMenu">
            <li class="nav-item">
                <a href="{{ route('home') }}" class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}">
                    <i class="fas fa-home"></i> Beranda
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('map') }}" class="nav-link {{ request()->routeIs('map') ? 'active' : '' }}">
                    <i class="fas fa-map-marked-alt"></i> Peta
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('table') }}" class="nav-link {{ request()->routeIs('table') ? 'active' : '' }}">
                    <i class="fas fa-table"></i> Tabel
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('umkm') }}" class="nav-link {{ request()->routeIs('umkm') ? 'active' : '' }}">
                    <i class="fas fa-store"></i> UMKM
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('berita') }}" class="nav-link {{ request()->routeIs('berita') ? 'active' : '' }}">
                    <i class="fas fa-newspaper"></i> Berita
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('kontak') }}" class="nav-link {{ request()->routeIs('kontak') ? 'active' : '' }}">
                    <i class="fas fa-phone"></i> Kontak
                </a>
            </li>
        </ul>

        <!-- Right Side -->
        <div class="navbar-right">
            @auth
                <div class="user-dropdown" x-data="{ dropdownOpen: false }">
                    <button @click="dropdownOpen = !dropdownOpen" class="user-btn">
                        <i class="fas fa-user-circle"></i>
                        <span>{{ Auth::user()->name }}</span>
                        <i class="fas fa-chevron-down" :class="{ 'rotate': dropdownOpen }"></i>
                    </button>
                    <div x-show="dropdownOpen" @click.away="dropdownOpen = false" class="dropdown-menu">
                        <a href="{{ route('profile.edit') }}" class="dropdown-item">
                            <i class="fas fa-user"></i> Profile
                        </a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="dropdown-item logout">
                                <i class="fas fa-sign-out-alt"></i> Log Out
                            </button>
                        </form>
                    </div>
                </div>
            @else
                <a href="{{ route('login') }}" class="btn-login">
                    <i class="fas fa-sign-in-alt"></i> Login
                </a>
            @endauth

            <!-- Hamburger (Mobile) -->
            <button @click="open = !open" class="hamburger" :class="{ 'active': open }">
                <span></span>
                <span></span>
                <span></span>
            </button>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div x-show="open" x-transition class="mobile-menu">
        <a href="{{ route('home') }}" class="mobile-link {{ request()->routeIs('home') ? 'active' : '' }}">
            <i class="fas fa-home"></i> Beranda
        </a>
        <a href="{{ route('map') }}" class="mobile-link {{ request()->routeIs('map') ? 'active' : '' }}">
            <i class="fas fa-map-marked-alt"></i> Peta
        </a>
        <a href="{{ route('table') }}" class="mobile-link {{ request()->routeIs('table') ? 'active' : '' }}">
            <i class="fas fa-table"></i> Tabel
        </a>
        <a href="{{ route('umkm') }}" class="mobile-link {{ request()->routeIs('umkm') ? 'active' : '' }}">
            <i class="fas fa-store"></i> UMKM
        </a>
        <a href="{{ route('berita') }}" class="mobile-link {{ request()->routeIs('berita') ? 'active' : '' }}">
            <i class="fas fa-newspaper"></i> Berita
        </a>
        <a href="{{ route('kontak') }}" class="mobile-link {{ request()->routeIs('kontak') ? 'active' : '' }}">
            <i class="fas fa-phone"></i> Kontak
        </a>

        @auth
            <div class="mobile-divider"></div>
            <a href="{{ route('profile.edit') }}" class="mobile-link">
                <i class="fas fa-user"></i> Profile
            </a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="mobile-link logout-btn">
                    <i class="fas fa-sign-out-alt"></i> Log Out
                </button>
            </form>
        @endauth
    </div>
</nav>

<!-- ============================================
     CSS NAVBAR
     ============================================ -->
<style>
    /* ============================================
       NAVBAR UMKM BARUREJO
       ============================================ */
    .navbar-umkm {
        background: linear-gradient(135deg, #1a472a 0%, #2d6a4f 50%, #1E5E0C 100%);
        padding: 0 20px;
        position: sticky;
        top: 0;
        z-index: 999;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.25);
        border-bottom: 3px solid #CEE84B;
    }

    .container-nav {
        max-width: 1300px;
        margin: 0 auto;
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 10px 0;
        height: 70px;
    }

    /* ============================================
       LOGO
       ============================================ */
    .navbar-logo a {
        display: flex;
        align-items: center;
        gap: 12px;
        text-decoration: none;
    }

    .logo-img {
        height: 40px;
        width: auto;
        object-fit: contain;
        filter: drop-shadow(0 2px 4px rgba(0, 0, 0, 0.2));
    }

    .logo-text {
        display: flex;
        flex-direction: column;
        line-height: 1.2;
    }

    .logo-title {
        font-weight: 700;
        font-size: 1.1rem;
        color: #ffffff;
        letter-spacing: 0.5px;
        text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
    }

    .logo-subtitle {
        font-weight: 300;
        font-size: 0.7rem;
        color: #CEE84B;
        letter-spacing: 0.5px;
    }

    /* ============================================
       NAVBAR MENU
       ============================================ */
    .navbar-menu {
        display: flex;
        list-style: none;
        margin: 0;
        padding: 0;
        gap: 5px;
    }

    .nav-item {
        position: relative;
    }

    .nav-link {
        display: flex;
        align-items: center;
        gap: 6px;
        padding: 8px 16px;
        color: rgba(255, 255, 255, 0.8);
        text-decoration: none;
        font-weight: 500;
        font-size: 0.9rem;
        border-radius: 30px;
        transition: all 0.3s ease;
        position: relative;
    }

    .nav-link i {
        font-size: 0.85rem;
        color: #CEE84B;
    }

    .nav-link:hover {
        color: #ffffff;
        background: rgba(206, 232, 75, 0.15);
        transform: translateY(-2px);
    }

    .nav-link.active {
        color: #ffffff;
        background: rgba(206, 232, 75, 0.25);
        box-shadow: 0 2px 10px rgba(206, 232, 75, 0.15);
    }

    .nav-link.active::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 50%;
        transform: translateX(-50%);
        width: 20px;
        height: 3px;
        background: #CEE84B;
        border-radius: 10px;
    }

    /* ============================================
       RIGHT SIDE - USER DROPDOWN
       ============================================ */
    .navbar-right {
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .user-btn {
        display: flex;
        align-items: center;
        gap: 8px;
        background: rgba(255, 255, 255, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.2);
        color: #ffffff;
        padding: 8px 16px;
        border-radius: 30px;
        cursor: pointer;
        font-size: 0.85rem;
        transition: all 0.3s ease;
        font-family: 'Poppins', sans-serif;
    }

    .user-btn:hover {
        background: rgba(255, 255, 255, 0.2);
    }

    .user-btn i {
        color: #CEE84B;
    }

    .user-btn .fa-chevron-down {
        transition: transform 0.3s ease;
        font-size: 0.7rem;
    }

    .user-btn .fa-chevron-down.rotate {
        transform: rotate(180deg);
    }

    .dropdown-menu {
        position: absolute;
        top: 100%;
        right: 0;
        margin-top: 8px;
        background: #ffffff;
        border-radius: 12px;
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.2);
        min-width: 180px;
        padding: 8px 0;
        z-index: 1000;
        border: 1px solid #e9ecef;
    }

    .dropdown-item {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 10px 20px;
        color: #333;
        text-decoration: none;
        font-size: 0.85rem;
        transition: all 0.2s ease;
        background: none;
        border: none;
        width: 100%;
        text-align: left;
        cursor: pointer;
        font-family: 'Poppins', sans-serif;
    }

    .dropdown-item:hover {
        background: #f0f4f0;
        color: #1E5E0C;
    }

    .dropdown-item i {
        width: 18px;
        color: #1E5E0C;
    }

    .dropdown-item.logout {
        color: #dc3545;
    }

    .dropdown-item.logout i {
        color: #dc3545;
    }

    .dropdown-item.logout:hover {
        background: #fde8ea;
    }

    .btn-login {
        display: flex;
        align-items: center;
        gap: 8px;
        color: #ffffff;
        text-decoration: none;
        padding: 8px 20px;
        border: 2px solid #CEE84B;
        border-radius: 30px;
        font-weight: 600;
        font-size: 0.85rem;
        transition: all 0.3s ease;
    }

    .btn-login:hover {
        background: #CEE84B;
        color: #1a1a1a;
    }

    /* ============================================
       HAMBURGER (MOBILE)
       ============================================ */
    .hamburger {
        display: none;
        flex-direction: column;
        gap: 5px;
        background: none;
        border: none;
        cursor: pointer;
        padding: 5px;
    }

    .hamburger span {
        display: block;
        width: 28px;
        height: 3px;
        background: #ffffff;
        border-radius: 5px;
        transition: all 0.3s ease;
    }

    .hamburger.active span:nth-child(1) {
        transform: rotate(45deg) translate(5px, 6px);
    }

    .hamburger.active span:nth-child(2) {
        opacity: 0;
    }

    .hamburger.active span:nth-child(3) {
        transform: rotate(-45deg) translate(5px, -6px);
    }

    .user-dropdown {
        position: relative;
    }

    /* ============================================
       MOBILE MENU
       ============================================ */
    .mobile-menu {
        display: none;
        flex-direction: column;
        background: linear-gradient(135deg, #1a472a 0%, #1E5E0C 100%);
        padding: 16px 20px;
        border-top: 2px solid #CEE84B;
        gap: 4px;
    }

    .mobile-menu.open {
        display: flex;
    }

    .mobile-link {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 12px 16px;
        color: rgba(255, 255, 255, 0.8);
        text-decoration: none;
        border-radius: 10px;
        font-weight: 500;
        font-size: 0.95rem;
        transition: all 0.3s ease;
        background: none;
        border: none;
        width: 100%;
        text-align: left;
        cursor: pointer;
        font-family: 'Poppins', sans-serif;
    }

    .mobile-link i {
        width: 20px;
        color: #CEE84B;
    }

    .mobile-link:hover {
        background: rgba(206, 232, 75, 0.15);
        color: #ffffff;
    }

    .mobile-link.active {
        background: rgba(206, 232, 75, 0.2);
        color: #ffffff;
        border-left: 4px solid #CEE84B;
    }

    .mobile-link.logout-btn {
        color: #ff6b6b;
    }

    .mobile-link.logout-btn i {
        color: #ff6b6b;
    }

    .mobile-divider {
        height: 1px;
        background: rgba(255, 255, 255, 0.1);
        margin: 8px 0;
    }

    /* ============================================
       RESPONSIVE
       ============================================ */
    @media (max-width: 992px) {
        .navbar-menu {
            display: none;
        }

        .user-btn span {
            display: none;
        }

        .hamburger {
            display: flex;
        }

        .mobile-menu {
            display: flex;
        }

        .logo-title {
            font-size: 0.95rem;
        }

        .logo-img {
            height: 35px;
        }

        .container-nav {
            height: 60px;
            padding: 8px 0;
        }
    }

    @media (max-width: 576px) {
        .navbar-umkm {
            padding: 0 12px;
        }

        .logo-title {
            font-size: 0.85rem;
        }

        .logo-subtitle {
            font-size: 0.6rem;
        }

        .logo-img {
            height: 30px;
        }

        .container-nav {
            height: 55px;
        }

        .user-btn {
            padding: 6px 12px;
            font-size: 0.75rem;
        }

        .mobile-link {
            font-size: 0.9rem;
            padding: 10px 14px;
        }
    }
</style>

<!-- ============================================
     SCRIPT UNTUK MOBILE MENU
     ============================================ -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Close mobile menu on link click
        const mobileLinks = document.querySelectorAll('.mobile-link');
        mobileLinks.forEach(link => {
            link.addEventListener('click', function() {
                const menu = document.querySelector('.mobile-menu');
                if (menu) {
                    menu.classList.remove('open');
                }
                // Update Alpine.js state
                const navbar = document.querySelector('[x-data]');
                if (navbar && navbar.__x) {
                    navbar.__x.$data.open = false;
                }
            });
        });

        // Close dropdown when clicking outside
        document.addEventListener('click', function(event) {
            const dropdown = document.querySelector('.user-dropdown');
            if (dropdown) {
                const btn = dropdown.querySelector('.user-btn');
                const menu = dropdown.querySelector('.dropdown-menu');
                if (!dropdown.contains(event.target)) {
                    if (dropdown.__x) {
                        dropdown.__x.$data.dropdownOpen = false;
                    }
                }
            }
        });
    });
</script>
