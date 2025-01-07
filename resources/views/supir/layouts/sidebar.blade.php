<nav class="sidebar col-md-3 col-lg-2">
    <div class="position-sticky">
        <!-- Logo -->
        <div class="px-4 py-4">
            <h4 class="text-white mb-0">WeKirim</h4>
            <small class="text-muted">Panel Kurir</small>
        </div>

        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link {{ Request::routeIs('supir.dashboard') ? 'active' : '' }}"
                   href="{{ route('supir.dashboard') }}">
                    <i class="bi bi-speedometer2 me-2"></i>
                    Dashboard
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ Request::routeIs('supir.pengiriman.*') ? 'active' : '' }}"
                   href="{{ route('supir.pengiriman.index') }}">
                    <i class="bi bi-truck me-2"></i>
                    Tugas Pengiriman
                </a>
            </li>
        </ul>
    </div>
</nav>
