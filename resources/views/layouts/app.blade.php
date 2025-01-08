<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <!-- Bootstrap Icons -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

        <!-- Scripts -->
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
        </style>
    </head>
    <body>
        @php
            $role = auth()->user()->role->name;
            if ($role === 'admin') {
                return redirect()->route('admin.dashboard');
            } elseif ($role === 'supir') {
                return redirect()->route('supir.dashboard');
            } elseif ($role === 'pengguna') {
                return redirect()->route('pelanggan.dashboard');
            }
        @endphp
    </body>
</html>
