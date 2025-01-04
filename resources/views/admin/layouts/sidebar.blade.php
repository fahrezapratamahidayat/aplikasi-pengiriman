<nav class="col-md-3 col-lg-2 d-md-block bg-white sidebar collapse">
    <div class="position-sticky pt-3">
        <div class="px-3 mb-4">
            <h5>Admin Panel</h5>
        </div>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link {{ Request::routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                    <i class="bi bi-speedometer2 me-2"></i>
                    Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::routeIs('admin.pelanggan.*') ? 'active' : '' }}" href="{{ route('admin.pelanggan.index') }}">
                    <i class="bi bi-people me-2"></i>
                    Pelanggan
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::routeIs('admin.supir.*') ? 'active' : '' }}" href="{{ route('admin.supir.index') }}">
                    <i class="bi bi-person-badge me-2"></i>
                    Supir
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::routeIs('admin.mobil.*') ? 'active' : '' }}" href="{{ route('admin.mobil.index') }}">
                    <i class="bi bi-car-front me-2"></i>
                    Mobil
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
