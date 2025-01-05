<nav class="col-md-3 col-lg-2 d-md-block bg-white sidebar collapse">
    <div class="position-sticky pt-3">
        <div class="px-3 mb-4">
            <h5>Panel Pelanggan</h5>
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
            <li class="nav-item mt-3">
                <form method="POST" action="{{ route('logout') }}" class="px-3">
                    @csrf
                    <button type="submit" class="btn btn-danger btn-sm w-100">
                        <i class="bi bi-box-arrow-right me-2"></i>
                        Logout
                    </button>
                </form>
            </li>
        </ul>
    </div>
</nav>
