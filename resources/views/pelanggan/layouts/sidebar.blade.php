<nav class="sidebar col-md-3 col-lg-2">
    <div class="position-sticky">
        <!-- Logo -->
        <div class="px-4 py-4">
            <h4 class="text-white mb-0">WeKirim</h4>
            <small class="text-muted">Panel Pelanggan</small>
        </div>

        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link {{ Request::routeIs('pelanggan.dashboard') ? 'active' : '' }}"
                   href="{{ route('pelanggan.dashboard') }}">
                    <i class="bi bi-speedometer2 me-2"></i>
                    Dashboard
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ Request::routeIs('pelanggan.pengiriman.*') ? 'active' : '' }}"
                   href="{{ route('pelanggan.pengiriman.index') }}">
                    <i class="bi bi-box-seam me-2"></i>
                    Pengiriman Saya
                </a>
            </li>

            {{-- <li class="nav-item">
                <a class="nav-link {{ Request::routeIs('pelanggan.tracking.*') ? 'active' : '' }}"
                   href="{{ route('pelanggan.tracking.index') }}">
                    <i class="bi bi-geo-alt me-2"></i>
                    Lacak Kiriman
                </a>
            </li> --}}

            {{-- <li class="nav-item">
                <a class="nav-link {{ Request::routeIs('pelanggan.profile') ? 'active' : '' }}"
                   href="{{ route('pelanggan.profile') }}">
                    <i class="bi bi-person me-2"></i>
                    Profil Saya
                </a>
            </li> --}}
        </ul>
    </div>
</nav>
