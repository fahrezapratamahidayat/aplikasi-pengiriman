<nav class="sidebar col-md-3 col-lg-2">
    <div class="position-sticky">
        <!-- Logo -->
        <div class="px-4 py-4">
            <h4 class="text-white mb-0">WeKirim</h4>
            <small class="text-muted">Admin Panel</small>
        </div>

        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link {{ Request::routeIs('admin.dashboard') ? 'active' : '' }}"
                   href="{{ route('admin.dashboard') }}">
                    <i class="bi bi-speedometer2 me-2"></i>
                    Dashboard
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ Request::routeIs('admin.pengiriman.*') ? 'active' : '' }}"
                   href="{{ route('admin.pengiriman.index') }}">
                    <i class="bi bi-box-seam me-2"></i>
                    Pengiriman
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ Request::routeIs('admin.pelanggan.*') ? 'active' : '' }}"
                   href="{{ route('admin.pelanggan.index') }}">
                    <i class="bi bi-people me-2"></i>
                    Pelanggan
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ Request::routeIs('admin.supir.*') ? 'active' : '' }}"
                   href="{{ route('admin.supir.index') }}">
                    <i class="bi bi-person-badge me-2"></i>
                    Kurir
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ Request::routeIs('admin.mobil.*') ? 'active' : '' }}"
                   href="{{ route('admin.mobil.index') }}">
                    <i class="bi bi-truck me-2"></i>
                    Kendaraan
                </a>
            </li>

            {{-- <li class="nav-item">
                <a class="nav-link {{ Request::routeIs('admin.laporan.*') ? 'active' : '' }}"
                   href="{{ route('admin.laporan.index') }}">
                    <i class="bi bi-file-earmark-text me-2"></i>
                    Laporan
                </a>
            </li> --}}

            {{-- <li class="nav-item">
                <a class="nav-link {{ Request::routeIs('admin.settings.*') ? 'active' : '' }}"
                   href="{{ route('admin.settings.index') }}">
                    <i class="bi bi-gear me-2"></i>
                    Pengaturan
                </a>
            </li> --}}
        </ul>
    </div>
</nav>
