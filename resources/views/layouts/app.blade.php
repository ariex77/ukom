<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DUK Dinkes Kampar</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body>
    
<!-- NAVBAR MENU ATAS -->
    <nav class="navbar navbar-expand bg-primary navbar-dark shadow-sm">
    <div class="container">
        <a class="navbar-brand fw-bold" href="{{ route('dashboard') }}">DUK Kampar</a>

        <!-- Menu Kiri -->
        <ul class="navbar-nav me-auto">
            <li class="nav-item">
                <a class="nav-link{{ request()->routeIs('dashboard') ? ' active' : '' }}" href="{{ route('dashboard') }}">
                    Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link{{ request()->routeIs('pegawais.index') ? ' active' : '' }}" href="{{ route('pegawais.index') }}">
                    Data Pegawai
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link{{ request()->routeIs('pegawais.create') ? ' active' : '' }}" href="{{ route('pegawais.create') }}">
                    Tambah Pegawai
                </a>
            </li>
            @if(Auth::check() && Auth::user()->role === 'admin')
            <li class="nav-item">
                <a class="nav-link{{ request()->routeIs('pegawais.exportPdf') ? ' active' : '' }}" href="{{ route('pegawais.exportPdf') }}">
                    Export PDF
                </a>
            </li>
            @endif
        </ul>

        <!-- Menu Kanan -->
        <ul class="navbar-nav ms-auto">
            @if (Auth::check())
                <li class="nav-item d-flex align-items-center me-2">
                    <span class="text-white small">
                        Login sebagai <strong>{{ Auth::user()->name }}</strong> ({{ Auth::user()->role }})
                    </span>
                </li>
                <li class="nav-item">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="btn btn-link nav-link px-2 text-white">Logout</button>
                    </form>
                </li>
            @endif
        </ul>
    </div>
</nav>

    <div class="container py-4">
        @yield('content')
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>