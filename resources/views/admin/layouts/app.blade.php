<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Admin Gampong Udeung</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="/admin/dashboard">Panel Admin</a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="/admin/articles">Berita & Pengumuman</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/admin/guides">Panduan Administrasi</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/admin/events">Kalender Kegiatan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/admin/galleries">Galeri</a>
                    </li>
                </ul>
                <form action="/admin/logout" method="POST" class="d-flex">
                    @csrf <button class="btn btn-outline-danger" type="submit">Logout</button>
                </form>
            </div>
        </div>
    </nav>

    <main class="container mt-4">
        @yield('content')
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>