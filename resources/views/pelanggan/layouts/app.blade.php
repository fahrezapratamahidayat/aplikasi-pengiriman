<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WeKirim - Panel Pelanggan</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        .sidebar {
            min-height: 100vh;
            background: #1e1e2d;
        }
        .nav-link {
            color: #9899ac;
            padding: 0.75rem 1.5rem;
            margin-bottom: 0.25rem;
            border-radius: 0.475rem;
            transition: color 0.2s ease;
        }
        .nav-link:hover {
            color: #fff;
            background: rgba(255,255,255,0.1);
        }
        .nav-link.active {
            color: #fff;
            background: #2A2A3C;
        }
        .nav-link i {
            color: #494B74;
        }
        .nav-link:hover i,
        .nav-link.active i {
            color: #6571FF;
        }
        .content-wrapper {
            background: #f5f8fa;
        }
        .card {
            border: none;
            box-shadow: 0 0 20px 0 rgba(76,87,125,.02);
        }
        .btn-primary {
            background: #6571FF;
            border-color: #6571FF;
        }
        .btn-primary:hover {
            background: #5563ee;
            border-color: #5563ee;
        }
    </style>
</head>
<body>
    <div class="d-flex">
        <!-- Sidebar -->
        @include('pelanggan.layouts.sidebar')

        <!-- Main Content -->
        <div class="content-wrapper flex-grow-1">
            <!-- Top Navbar -->
            <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
                <div class="container-fluid">
                    <span class="navbar-brand mb-0 h1">WeKirim</span>
                    <div class="d-flex align-items-center">
                        <div class="dropdown">
                            <button class="btn btn-link text-dark dropdown-toggle text-decoration-none" type="button" data-bs-toggle="dropdown">
                                <i class="bi bi-person-circle me-2"></i>
                                {{ Auth::user()->name }}
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="dropdown-item">
                                            <i class="bi bi-box-arrow-right me-2"></i>Logout
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </nav>

            <!-- Page Content -->
            <main class="p-4">
                @yield('content')
            </main>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>
