@extends('layout.template')

@section('styles')
    <!-- ============================================ -->
    <!-- 1. LIBRARY EXTERNAL (CSS & JS)                -->
    <!-- ============================================ -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/1.0.4/leaflet.draw.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet-minimap/dist/Control.MiniMap.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">

    <style>
        /* ============================================
                   RESET - TANPA SCROLL
                   ============================================ */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html,
        body {
            overflow: hidden !important;
            height: 100% !important;
            width: 100% !important;
            margin: 0 !important;
            padding: 0 !important;
            font-family: 'Poppins', sans-serif;
        }

        /* ============================================
                   MAP - PALING BAWAH
                   ============================================ */
        #map {
            width: 100vw !important;
            height: 100vh !important;
            position: fixed !important;
            top: 0 !important;
            left: 0 !important;
            z-index: 1 !important;
        }

        /* ============================================
                   NAVBAR - DI ATAS MAP
                   ============================================ */
        .navbar-umkm,
        nav.navbar,
        .navbar,
        .navbar-custom {
            z-index: 1000 !important;
            position: relative !important;
        }

        /* ============================================
                   KONTROL PETA - DI ATAS NAVBAR
                   ============================================ */
        .leaflet-control-container,
        .leaflet-control-container *,
        .leaflet-top,
        .leaflet-top *,
        .leaflet-bottom,
        .leaflet-bottom *,
        .leaflet-control,
        .leaflet-control *,
        .leaflet-control-layers,
        .leaflet-control-layers *,
        .leaflet-control-draw,
        .leaflet-control-draw *,
        .leaflet-draw-toolbar,
        .leaflet-draw-toolbar *,
        .leaflet-draw-actions,
        .leaflet-draw-actions *,
        .leaflet-control-geocoder,
        .leaflet-control-geocoder *,
        .leaflet-control-minimap,
        .leaflet-control-minimap *,
        .leaflet-popup,
        .leaflet-popup * {
            z-index: 2000 !important;
        }

        /* ============================================
                   SIDEBAR - PALING ATAS
                   ============================================ */
        .sidebar-toggle {
            position: fixed !important;
            top: 100px !important;
            right: 25px !important;
            z-index: 9999 !important;
            background-color: #1E5E0C !important;
            color: white !important;
            padding: 10px 20px !important;
            border-radius: 50px !important;
            font-family: 'Poppins', sans-serif !important;
            font-size: 14px !important;
            font-weight: 600 !important;
            cursor: pointer !important;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.25) !important;
            border: none !important;
            display: flex !important;
            align-items: center !important;
            gap: 8px !important;
            transition: all 0.3s ease !important;
        }

        .sidebar-toggle:hover {
            background-color: #2d8a1a !important;
            transform: translateY(-3px) !important;
        }

        .map-sidebar {
            position: fixed !important;
            top: 150px !important;
            right: 25px !important;
            width: 290px !important;
            max-height: calc(100vh - 120px) !important;
            background: #ffffff !important;
            border: 2px solid #1E5E0C !important;
            border-radius: 14px !important;
            padding: 22px 20px !important;
            font-family: 'Poppins', sans-serif !important;
            font-size: 13px !important;
            line-height: 1.6 !important;
            box-shadow: 0 8px 35px rgba(0, 0, 0, 0.2) !important;
            transform: translateX(120%) !important;
            opacity: 0 !important;
            transition: transform 0.4s cubic-bezier(0.4, 0, 0.2, 1), opacity 0.4s ease !important;
            z-index: 9998 !important;
            overflow-y: auto !important;
        }

        .map-sidebar.active {
            transform: translateX(0%) !important;
            opacity: 1 !important;
        }


        /* Scrollbar Sidebar */
        .map-sidebar::-webkit-scrollbar {
            width: 4px;
        }

        .map-sidebar::-webkit-scrollbar-thumb {
            background: #CEE84B;
            border-radius: 10px;
        }

        .map-sidebar::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }

        /* ============================================
                   SIDEBAR CONTENT
                   ============================================ */
        .map-sidebar h4 {
            color: #1E5E0C;
            font-size: 0.95rem;
            font-weight: 600;
            margin-top: 12px;
            margin-bottom: 8px;
            display: flex;
            align-items: center;
        }

        .map-sidebar h4 i {
            color: #CEE84B;
            width: 24px;
        }

        .map-sidebar hr {
            border: none;
            border-top: 2px solid #f0f0f0;
            margin: 10px 0;
        }

        .legend-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .legend-list li {
            padding: 3px 0;
            font-size: 0.85rem;
            color: #333;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .legend-icon {
            display: inline-block;
            width: 22px;
            font-size: 1rem;
            text-align: center;
        }

        .info-text {
            color: #555;
            font-size: 0.9rem;
            margin: 2px 0 4px 0;
            padding-left: 4px;
        }

        .stats-mini {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 8px;
            margin-top: 6px;
        }

        .stat-item-mini {
            text-align: center;
            background: #f8f9fa;
            padding: 10px 6px;
            border-radius: 10px;
        }

        .stat-number-mini {
            display: block;
            font-size: 1.3rem;
            font-weight: 700;
            color: #1E5E0C;
        }

        .stat-label-mini {
            display: block;
            font-size: 0.6rem;
            color: #6c757d;
            margin-top: 2px;
        }

        .creator-name {
            color: #1a1a1a;
            font-size: 0.9rem;
            margin: 2px 0;
        }

        .creator-detail {
            color: #6c757d;
            font-size: 0.8rem;
            margin: 1px 0;
        }

        .sidebar-footer {
            display: flex;
            flex-direction: column;
            gap: 8px;
            margin-top: 4px;
        }

        .btn-sidebar-primary {
            background: #1E5E0C;
            color: white;
            padding: 10px 16px;
            border: none;
            border-radius: 10px;
            text-align: center;
            font-weight: 600;
            font-size: 0.85rem;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            width: 100%;
        }

        .btn-sidebar-primary:hover {
            background: #2d8a1a;
            transform: translateY(-2px);
        }

        .btn-sidebar-secondary {
            background: #f0f0f0;
            color: #333;
            padding: 10px 16px;
            border-radius: 10px;
            text-decoration: none;
            text-align: center;
            font-weight: 500;
            font-size: 0.85rem;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .btn-sidebar-secondary:hover {
            background: #e0e0e0;
        }

        /* ============================================
                   POPUP
                   ============================================ */
        .popup-image {
            width: 100%;
            max-height: 150px;
            object-fit: cover;
            border-radius: 6px;
            margin-top: 8px;
            border: 1px solid #CEE84B;
        }

        .popup-container {
            max-width: 270px;
            background-color: #f8fdf5;
            border: 1px solid #CEE84B;
            border-radius: 10px;
            padding: 12px;
            font-size: 13px;
            line-height: 1.4;
            color: #1a2a1a;
        }

        .popup-title {
            font-weight: 700;
            font-size: 15px;
            margin-bottom: 6px;
            color: #1E5E0C;
        }

        .popup-btn-google {
            display: block !important;
            background-color: #1a73e8 !important;
            color: #ffffff !important;
            padding: 8px 12px !important;
            border-radius: 6px !important;
            text-decoration: none !important;
            font-size: 13px !important;
            font-weight: 600 !important;
            text-align: center !important;
            margin-top: 10px !important;
        }

        .popup-btn-google:hover {
            background-color: #1557b0 !important;
        }

        .popup-btn-edit {
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 12px;
            padding: 6px;
            width: 100%;
            text-align: center;
            display: inline-block;
            text-decoration: none;
        }

        .popup-btn-edit:hover {
            background-color: #0056b3;
        }

        .popup-btn-delete {
            background-color: #dc3545;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 12px;
            padding: 6px;
            width: 100%;
            text-align: center;
        }

        .popup-btn-delete:hover {
            background-color: #c82333;
        }

        .popup-footer {
            font-size: 12px;
            margin-top: 8px;
            color: #1a2a1a;
        }

        /* ============================================
                   MINI MAP FIX
                   ============================================ */
        .leaflet-control-minimap-toggle-display {
            background-image: none !important;
            background-color: #ffffff !important;
            border: 1px solid #aaa !important;
            font-family: "Font Awesome 6 Free" !important;
            font-weight: 900 !important;
            font-size: 18px !important;
            color: #1E5E0C !important;
            width: 28px !important;
            height: 28px !important;
            display: flex !important;
            justify-content: center !important;
            align-items: center !important;
            border-radius: 4px !important;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.3) !important;
            cursor: pointer !important;
        }

        .leaflet-control-minimap-toggle-display::before {
            content: "\f279" !important;
        }

        .leaflet-control-minimap {
            background: transparent !important;
            border: none !important;
            box-shadow: none !important;
        }

        /* ============================================
                   RESPONSIVE
                   ============================================ */
        @media (max-width: 768px) {
            .sidebar-toggle {
                top: auto !important;
                bottom: 20px !important;
                right: 20px !important;
                padding: 10px 16px !important;
                font-size: 12px !important;
            }

            .map-sidebar {
                top: auto !important;
                bottom: 80px !important;
                right: 20px !important;
                left: 20px !important;
                width: auto !important;
                max-height: calc(100vh - 120px) !important;
                padding: 18px 16px !important;
                transform: translateY(120%) !important;
            }

            .map-sidebar.active {
                transform: translateY(0%) !important;
            }

            .stats-mini {
                grid-template-columns: repeat(3, 1fr);
                gap: 5px;
            }

            .stat-number-mini {
                font-size: 1.1rem;
            }
        }

        @media (max-width: 480px) {
            .map-sidebar {
                bottom: 70px !important;
                right: 10px !important;
                left: 10px !important;
                padding: 14px 12px !important;
                max-height: calc(100vh - 100px) !important;
                border-radius: 10px !important;
            }

            .sidebar-toggle {
                right: 10px !important;
                bottom: 15px !important;
                padding: 8px 14px !important;
                font-size: 11px !important;
            }
        }
    </style>
@endsection

@section('content')
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show m-3" role="alert"
            style="z-index:99999;position:fixed;top:10px;left:50%;transform:translateX(-50%);">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show m-3" role="alert"
            style="z-index:99999;position:fixed;top:10px;left:50%;transform:translateX(-50%);">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- MAP -->
    <div id="map"></div>

    <!-- SIDEBAR TOGGLE -->
    <div class="sidebar-toggle" onclick="toggleSidebar()" style="top: 100px !important; right: 25px !important;">
        <i class="fas fa-info-circle me-1"></i> Info Peta
    </div>

    <!-- SIDEBAR -->
    <div id="sidebar" class="map-sidebar">
        <h4><i class="fas fa-layer-group me-2"></i>Keterangan Peta</h4>
        <ul class="legend-list">
            <li><span class="legend-icon" style="color:#ff4500;">⬤</span> Lokasi UMKM</li>
            <li><span class="legend-icon" style="color:#2ecc71;">⬤</span> UMKM Makanan & Minuman</li>
            <li><span class="legend-icon" style="color:#f39c12;">⬤</span> UMKM Kerajinan Tangan</li>
            <li><span class="legend-icon" style="color:#9b59b6;">⬤</span> UMKM Fashion & Aksesoris</li>
            <li><span class="legend-icon" style="color:#3498db;">⬤</span> UMKM Jasa & Layanan</li>
            <li><span class="legend-icon" style="color:#1abc9c;">⬤</span> UMKM Perikanan</li>
            <li><span class="legend-icon" style="color:#6c757d;">⬤</span> UMKM Kelontong</li>
        </ul>
        <hr>
        <h4><i class="fas fa-globe me-2"></i>Proyeksi</h4>
        <p class="info-text">EPSG:4326 - WGS 84</p>
        <hr>
        <h4><i class="fas fa-chart-bar me-2"></i>Statistik UMKM</h4>
        <div class="stats-mini">
            <div class="stat-item-mini">
                <span class="stat-number-mini" id="sidebarTotalUmkm">0</span>
                <span class="stat-label-mini">Total UMKM</span>
            </div>
            <div class="stat-item-mini">
                <span class="stat-number-mini" id="sidebarTotalKategori">0</span>
                <span class="stat-label-mini">Kategori</span>
            </div>
            <div class="stat-item-mini">
                <span class="stat-number-mini" id="sidebarTotalDusun">0</span>
                <span class="stat-label-mini">Dusun</span>
            </div>
        </div>
        <hr>
        <h4><i class="fas fa-users me-2"></i>Tim Pengembang</h4>
        <div class="creator-info">
            <p class="creator-name"><strong>Kelompok KKN UMKM Barurejo</strong></p>
            <p class="creator-detail">Program KKN-PPM 2026</p>
            <p class="creator-detail">Desa Barurejo, Kecamatan Siliragung</p>
        </div>
        <hr>
        <h4><i class="fas fa-university me-2"></i>Instansi</h4>
        <p class="info-text">Universitas Gadjah Mada</p>
        <p class="info-text" style="font-size:0.75rem;color:#999;">Fakultas Vokasi - Sistem Informasi Geografis</p>
        <hr>
        <div class="sidebar-footer">
            <button class="btn-sidebar-primary" onclick="centerMapToUmkm()">
                <i class="fas fa-map-marked-alt me-2"></i> Pusatkan Peta
            </button>
            <a href="{{ route('home') }}" class="btn-sidebar-secondary">
                <i class="fas fa-home me-2"></i> Kembali ke Beranda
            </a>
        </div>
    </div>

    <!-- MODAL CREATE POINT -->
    <div class="modal fade" id="createpointModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Create Point</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form method="POST" action="{{ route('points.store') }}" enctype="multipart/form-data">
                    <div class="modal-body">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Name</label>
                            <input type="text" class="form-control" name="name" placeholder="Fill point name">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Description</label>
                            <textarea class="form-control" name="description" rows="3"></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Geometry</label>
                            <textarea class="form-control" id="geom_point" name="coordinates" rows="3"></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Photo</label>
                            <input type="file" class="form-control" name="image">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- MODAL CREATE POLYLINE -->
    <div class="modal fade" id="createpolylineModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Create Polyline</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form method="POST" action="{{ route('polylines.store') }}" enctype="multipart/form-data">
                    <div class="modal-body">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Name</label>
                            <input type="text" class="form-control" name="name" placeholder="Fill name">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Description</label>
                            <textarea class="form-control" name="description" rows="3"></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Geometry</label>
                            <textarea class="form-control" id="geom_polyline" name="geom_polyline" rows="3"></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Photo</label>
                            <input type="file" class="form-control" name="image">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- MODAL CREATE POLYGON -->
    <div class="modal fade" id="createpolygonModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Create Polygon</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form method="POST" action="{{ route('polygons.store') }}" enctype="multipart/form-data">
                    <div class="modal-body">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Name</label>
                            <input type="text" class="form-control" name="name" placeholder="Fill name">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Description</label>
                            <textarea class="form-control" name="description" rows="3"></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Geometry</label>
                            <textarea class="form-control" id="geom_polygon" name="geom_polygon" rows="3"></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Photo</label>
                            <input type="file" class="form-control" name="image">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/1.0.4/leaflet.draw.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://unpkg.com/@terraformer/wkt"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/proj4js/2.8.0/proj4.js"></script>
    <script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>
    <script src="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.min.js"></script>
    <script src="https://unpkg.com/leaflet.heat/dist/leaflet-heat.js"></script>
    <script src="https://unpkg.com/leaflet-minimap/dist/Control.MiniMap.min.js"></script>

    <script>
        // =============================================
        // KONFIGURASI AWAL
        // =============================================
        const initialCenter = [-8.4662599, 114.0999699];
        const initialZoom = 14;

        // Hapus zoomControl: true, nanti kita tambahkan manual
        var map = L.map('map', {
            zoomControl: false, // MATIKAN zoom control bawaan
            scrollWheelZoom: false,
            doubleClickZoom: true,
            boxZoom: true,
            keyboard: true,
            touchZoom: true
        }).setView(initialCenter, initialZoom);

        // Tambahkan zoom control dengan posisi di bawah
        L.control.zoom({
            position: 'topleft'
        }).addTo(map);

        // Atur posisi zoom control dengan CSS
        setTimeout(function() {
            var zoomControl = document.querySelector('.leaflet-control-zoom');
            if (zoomControl) {
                zoomControl.style.marginTop = '70px';
            }
        }, 100);

        // Hilangkan scroll di map
        map.scrollWheelZoom.disable();

        const PUBLIC_IMAGES_BASE = "{{ asset('images') }}";

        function getImageUrl(imageName) {
            if (!imageName || imageName === '' || imageName === 'null') return '';
            // Hapus karakter aneh jika ada
            imageName = imageName.trim();
            return `${PUBLIC_IMAGES_BASE}/${encodeURIComponent(imageName)}`;
        }

        // =============================================
        // BASEMAP
        // =============================================
        var baseMaps = {
            "OpenStreetMap": L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; OpenStreetMap contributors'
            }),
            "Google Satellite": L.tileLayer('https://{s}.google.com/vt/lyrs=s&x={x}&y={y}&z={z}', {
                maxZoom: 20,
                subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
            }),
            "Google Terrain": L.tileLayer('https://{s}.google.com/vt/lyrs=p&x={x}&y={y}&z={z}', {
                maxZoom: 20,
                subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
            }),
            "Google Hybrid": L.tileLayer('https://{s}.google.com/vt/lyrs=s,h&x={x}&y={y}&z={z}', {
                maxZoom: 20,
                subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
            })
        };

        // Default basemap
        var currentBasemap = baseMaps["OpenStreetMap"].addTo(map);

        // =============================================
        // LAYER CONTROL - TAMBAHKAN TOMBOL BASEMAP & UMKM
        // =============================================
        var layerControl = L.control.layers(baseMaps, null, {
            collapsed: false,
            position: 'bottomright'
        }).addTo(map);

        // =============================================
        // TOMBOL HOME
        // =============================================
        const homeButton = L.control({
            position: 'topleft'
        });
        homeButton.onAdd = function() {
            const btn = L.DomUtil.create('button', 'leaflet-bar leaflet-control leaflet-control-custom');
            btn.innerHTML = '<i class="fa fa-home"></i>';
            btn.style.backgroundColor = 'white';
            btn.style.width = '34px';
            btn.style.height = '34px';
            btn.style.cursor = 'pointer';
            btn.style.fontSize = '18px';
            btn.title = 'Kembali ke posisi awal';
            btn.onclick = function() {
                map.setView(initialCenter, initialZoom);
            };
            return btn;
        };
        homeButton.addTo(map);

        // =============================================
        // MINI MAP
        // =============================================
        var miniMapLayer = L.tileLayer('http://{s}.google.com/vt/lyrs=s&x={x}&y={y}&z={z}', {
            maxZoom: 13,
            subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
        });

        var miniMap = new L.Control.MiniMap(miniMapLayer, {
            toggleDisplay: true,
            minimized: false,
            position: 'bottomleft',
            width: 180,
            height: 180,
            zoomLevelOffset: -4,
            aimingRectOptions: {
                color: "red",
                weight: 1,
                clickable: false
            },
        }).addTo(map);

        // =============================================
        // SEARCH BAR
        // =============================================
        L.Control.geocoder({
            defaultMarkGeocode: false
        }).on('markgeocode', function(e) {
            var bbox = e.geocode.bbox;
            var bounds = L.latLngBounds(bbox.getSouthEast(), bbox.getNorthWest());
            map.fitBounds(bounds);
            L.marker(e.geocode.center).addTo(map).bindPopup(e.geocode.name).openPopup();
        }).addTo(map);

        // =============================================
        // LOAD GEOJSON BATAS DUSUN
        // =============================================
        fetch('{{ asset('geojson/batas_dusun_barurejo2.geojson') }}')
            .then(response => response.json())
            .then(data => {
                console.log('Loaded batas_dusun_barurejo2.geojson', data);

                var defaultBoundaryStyle = {
                    color: "yellow",
                    weight: 2,
                    fillOpacity: 0.2
                };
                var highlightBoundaryStyle = {
                    color: "orange",
                    weight: 3,
                    fillOpacity: 0.3
                };

                var boundaryLayer = L.geoJSON(data, {
                    style: defaultBoundaryStyle,
                    onEachFeature: function(feature, layer) {
                        var label = feature.properties.Dusun || feature.properties.NAMOBJ || 'Dusun';
                        layer.bindTooltip(label, {
                            permanent: false,
                            direction: 'center'
                        });
                        layer.on('mouseover', function() {
                            layer.setStyle(highlightBoundaryStyle);
                        });
                        layer.on('mouseout', function() {
                            layer.setStyle(defaultBoundaryStyle);
                        });
                    }
                }).addTo(map);

                try {
                    map.fitBounds(boundaryLayer.getBounds(), {
                        padding: [20, 20],
                        maxZoom: 16
                    });
                } catch (e) {}
            })
            .catch(err => console.error('Error loading batas dusun:', err));

        // =============================================
        // DRAW CONTROL
        // =============================================
        var drawnItems = new L.FeatureGroup();
        map.addLayer(drawnItems);

        var drawControl = new L.Control.Draw({
            draw: {
                position: 'topleft',
                polyline: true,
                polygon: false,
                rectangle: false,
                circle: false,
                marker: true,
                circlemarker: false
            },
            edit: false
        });
        map.addControl(drawControl);

        map.on('draw:created', function(e) {
            var type = e.layerType,
                layer = e.layer;
            var drawnJSONObject = layer.toGeoJSON();
            var objectGeometry = Terraformer.geojsonToWKT(drawnJSONObject.geometry);

            if (type === 'polyline') {
                $('#geom_polyline').val(objectGeometry);
                $('#createpolylineModal').modal('show');
            } else if (type === 'polygon' || type === 'rectangle') {
                $('#geom_polygon').val(objectGeometry);
                $('#createpolygonModal').modal('show');
            } else if (type === 'marker') {
                $('#geom_point').val(objectGeometry);
                $('#createpointModal').modal('show');
            }
            drawnItems.addLayer(layer);
        });

        // =============================================
        // LOAD DATA POINT
        // =============================================
        var point = L.geoJson(null, {
            onEachFeature: function(feature, layer) {
                var routedelete = "{{ route('points.destroy', ':id') }}".replace(':id', feature.properties.id);
                var routeedit = "{{ route('points.edit', ':id') }}".replace(':id', feature.properties.id);
                var coords = layer.getLatLng();
                var googleMapsUrl = `https://www.google.com/maps?q=${coords.lat},${coords.lng}`;
                var imageHtml = feature.properties.image ?
                    `<img src="${getImageUrl(feature.properties.image)}" onerror="this.style.display='none'" class="popup-image" />` :
                    '';

                var popupContent = `
                    <div class="popup-container">
                        <div class="popup-title">${feature.properties.name || 'Tidak Bernama'}</div>
                        <div><strong>Deskripsi:</strong> ${feature.properties.description || '-'}</div>
                        ${imageHtml}
                        <a href="${googleMapsUrl}" target="_blank" class="popup-btn-google">
                            <i class="fa-solid fa-map-location-dot"></i> Buka di Google Maps
                        </a>
                        <div style="display:flex;gap:6px;margin-top:10px;">
                            <a href="${routeedit}" class="popup-btn-edit" style="flex:1;text-align:center;">
                                <i class="fa-solid fa-pen-to-square"></i> Edit
                            </a>
                            <form method="POST" action="${routedelete}" style="flex:1;" onsubmit="return confirm('Yakin akan dihapus?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="popup-btn-delete" style="width:100%;">
                                    <i class="fa-solid fa-trash-can"></i> Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                `;
                layer.bindPopup(popupContent).bindTooltip(feature.properties.name);
            }
        });

        $.getJSON("{{ route('api.points') }}", function(data) {
            point.addData(data);
            map.addLayer(point);
        });

        // =============================================
        // LOAD DATA POLYLINE
        // =============================================
        var polyline = L.geoJson(null, {
            onEachFeature: function(feature, layer) {
                var routedelete = "{{ route('polylines.destroy', ':id') }}".replace(':id', feature.properties
                    .id);
                var routeedit = "{{ route('polylines.edit', ':id') }}".replace(':id', feature.properties.id);
                var center = layer.getBounds().getCenter();
                var googleMapsUrl = `https://www.google.com/maps?q=${center.lat},${center.lng}`;
                var imageHtml = feature.properties.image ?
                    `<img src="${getImageUrl(feature.properties.image)}" onerror="this.style.display='none'" class="popup-image" />` :
                    '';

                var popupContent = `
                    <div class="popup-container">
                        <div class="popup-title">${feature.properties.name || 'Tidak Bernama'}</div>
                        <div><strong>Deskripsi:</strong> ${feature.properties.description || '-'}</div>
                        <div><strong>Panjang:</strong> ${(feature.properties.length_km || 0).toFixed(2)} km</div>
                        ${imageHtml}
                        <a href="${googleMapsUrl}" target="_blank" class="popup-btn-google">
                            <i class="fa-solid fa-map-location-dot"></i> Buka di Google Maps
                        </a>
                        <div style="display:flex;gap:6px;margin-top:10px;">
                            <a href="${routeedit}" class="popup-btn-edit" style="flex:1;text-align:center;">
                                <i class="fa-solid fa-pen-to-square"></i> Edit
                            </a>
                            <form method="POST" action="${routedelete}" style="flex:1;" onsubmit="return confirm('Yakin akan dihapus?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="popup-btn-delete" style="width:100%;">
                                    <i class="fa-solid fa-trash-can"></i> Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                `;
                layer.bindPopup(popupContent).bindTooltip(feature.properties.name);
            }
        });

        $.getJSON("{{ route('api.polylines') }}", function(data) {
            polyline.addData(data);
            map.addLayer(polyline);
        });

        // =============================================
        // LOAD DATA POLYGON
        // =============================================
        var polygon = L.geoJson(null, {
            onEachFeature: function(feature, layer) {
                var routedelete = "{{ route('polygons.destroy', ':id') }}".replace(':id', feature.properties
                    .id);
                var routeedit = "{{ route('polygons.edit', ':id') }}".replace(':id', feature.properties.id);
                var center = layer.getBounds().getCenter();
                var googleMapsUrl = `https://www.google.com/maps?q=${center.lat},${center.lng}`;
                var imageHtml = feature.properties.image ?
                    `<img src="${getImageUrl(feature.properties.image)}" onerror="this.style.display='none'" class="popup-image" />` :
                    '';

                var popupContent = `
                    <div class="popup-container">
                        <div class="popup-title">${feature.properties.name || 'Tidak Bernama'}</div>
                        <div><strong>Deskripsi:</strong> ${feature.properties.description || '-'}</div>
                        <div><strong>Luas:</strong> ${(feature.properties.area_ha || 0).toFixed(2)} ha</div>
                        ${imageHtml}
                        <a href="${googleMapsUrl}" target="_blank" class="popup-btn-google">
                            <i class="fa-solid fa-map-location-dot"></i> Buka di Google Maps
                        </a>
                        <div style="display:flex;gap:6px;margin-top:10px;">
                            <a href="${routeedit}" class="popup-btn-edit" style="flex:1;text-align:center;">
                                <i class="fa-solid fa-pen-to-square"></i> Edit
                            </a>
                            <form method="POST" action="${routedelete}" style="flex:1;" onsubmit="return confirm('Yakin akan dihapus?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="popup-btn-delete" style="width:100%;">
                                    <i class="fa-solid fa-trash-can"></i> Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                `;
                layer.bindPopup(popupContent).bindTooltip(feature.properties.name);
            }
        });

        $.getJSON("{{ route('api.polygons') }}", function(data) {
            polygon.addData(data);
            map.addLayer(polygon);
        });

        // =============================================
        // LOAD DATA UMKM - DIPERBAIKI
        // =============================================
        var umkmLayer = L.geoJson(null, {
            pointToLayer: function(feature, latlng) {
                var colors = {
                    'Perikanan': '#1abc9c',
                    'Kerajinan': '#f39c12',
                    'Minuman': '#00b4d8',
                    'Kelontong': '#6c757d',
                    'Makanan dan minuman': '#f4a460',
                    'Pertanian': '#2ecc71',
                    'makanan': '#2ecc71',
                    'kerajinan': '#f39c12',
                    'fashion': '#9b59b6',
                    'jasa': '#3498db'
                };
                var kategori = feature.properties.Kategori || feature.properties.kategori || '';
                var color = colors[kategori] || '#ff4500';
                return L.circleMarker(latlng, {
                    radius: 8,
                    fillColor: color,
                    color: '#ffffff',
                    weight: 2,
                    opacity: 1,
                    fillOpacity: 0.9
                });
            },
            onEachFeature: function(feature, layer) {
                if (feature && feature.properties) {
                    // Ambil dari properti yang benar (kapitalisasi)
                    var label = feature.properties.Name || feature.properties.nama || 'UMKM';
                    var alamat = feature.properties.alamat || feature.properties.Alamat || '-';
                    var kategori = feature.properties.Kategori || feature.properties.kategori || '-';
                    var produk = feature.properties.Produk || feature.properties.produk || '-';
                    var dusun = feature.properties.Dusun || feature.properties.dusun || '-';
                    var foto = feature.properties.Foto || feature.properties.foto || feature.properties.image;

                    var coords = layer.getLatLng();
                    var googleMapsUrl = `https://www.google.com/maps?q=${coords.lat},${coords.lng}`;

                    // Buat HTML foto jika ada dan bukan null
                    var imageHtml = '';
                    if (foto && foto !== '' && foto !== 'null') {
                        var imageUrl = getImageUrl(foto);
                        imageHtml =
                            `<img src="${imageUrl}" onerror="this.style.display='none'" class="popup-image" alt="Foto UMKM" />`;
                    }

                    var popupHtml = `
                        <div class="popup-container">
                            <div class="popup-title">${label}</div>
                            <div><strong>Alamat:</strong> ${alamat}</div>
                            <div><strong>Kategori:</strong> ${kategori}</div>
                            <div><strong>Produk:</strong> ${produk}</div>
                            <div><strong>Dusun:</strong> ${dusun}</div>
                            ${imageHtml}
                            <a href="${googleMapsUrl}" target="_blank" class="popup-btn-google">
                                <i class="fa-solid fa-map-location-dot"></i> Buka di Google Maps
                            </a>
                        </div>
                    `;
                    layer.bindPopup(popupHtml);
                    layer.bindTooltip(label);
                }
            }
        });

        function loadLocalUmkmFile() {
            fetch('{{ asset('geojson/merge_umkm_barurejo.geojson') }}')
                .then(r => {
                    if (!r.ok) throw new Error('File tidak ditemukan');
                    return r.json();
                })
                .then(localData => {
                    console.log('Loaded UMKM from file:', localData.features ? localData.features.length : 0);
                    if (localData && localData.features && localData.features.length > 0) {
                        umkmLayer.addData(localData);
                        layerControl.addOverlay(umkmLayer, '📍 UMKM Barurejo');
                        umkmLayer.addTo(map);
                        updateSidebarStats(localData);
                    } else {
                        console.warn('File UMKM kosong, coba dari API');
                        loadUmkmFromApi();
                    }
                })
                .catch(err => {
                    console.error('Gagal memuat file UMKM:', err);
                    loadUmkmFromApi();
                });
        }

        function loadUmkmFromApi() {
            $.getJSON('/api/umkm')
                .done(function(data) {
                    console.log('Loaded UMKM from API:', data.features ? data.features.length : 0);
                    if (data && data.features && data.features.length > 0) {
                        umkmLayer.addData(data);
                        layerControl.addOverlay(umkmLayer, '📍 UMKM Barurejo');
                        umkmLayer.addTo(map);
                        updateSidebarStats(data);
                    } else {
                        console.warn('API UMKM kosong');
                    }
                })
                .fail(function() {
                    console.error('API UMKM gagal dimuat');
                });
        }

        // Coba muat dari file GeoJSON dulu, jika gagal dari API
        loadLocalUmkmFile();

        // =============================================
        // FUNGSI SIDEBAR
        // =============================================
        function toggleSidebar() {
            document.querySelector('.map-sidebar').classList.toggle('active');
        }

        document.addEventListener('click', function(event) {
            var sidebar = document.querySelector('.map-sidebar');
            var toggleBtn = document.querySelector('.sidebar-toggle');
            if (sidebar && sidebar.classList.contains('active')) {
                if (!sidebar.contains(event.target) && !toggleBtn.contains(event.target)) {
                    sidebar.classList.remove('active');
                }
            }
        });

        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                var sidebar = document.querySelector('.map-sidebar');
                if (sidebar) sidebar.classList.remove('active');
            }
        });

        function centerMapToUmkm() {
            map.setView(initialCenter, 15);
            document.querySelector('.map-sidebar').classList.remove('active');
        }

        function updateSidebarStats(data) {
            if (!data || !data.features) return;

            var total = data.features.length;
            document.getElementById('sidebarTotalUmkm').textContent = total;

            var categories = new Set();
            var dusun = new Set();

            data.features.forEach(function(f) {
                var kategori = f.properties.Kategori || f.properties.kategori;
                var dusunVal = f.properties.Dusun || f.properties.dusun;
                if (kategori) categories.add(kategori);
                if (dusunVal) dusun.add(dusunVal);
            });

            document.getElementById('sidebarTotalKategori').textContent = categories.size || 0;
            document.getElementById('sidebarTotalDusun').textContent = dusun.size || 0;
        }
    </script>
@endsection
