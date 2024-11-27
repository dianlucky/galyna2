<!DOCTYPE html>
<html lang="en">
{{-- User Layout --}}

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Galyna Heiwa</title>

    {{-- Poppins Font --}}
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">

    {{-- Charmonman Font --}}
    <link href="https://fonts.googleapis.com/css2?family=Charmonman:wght@400;700&display=swap" rel="stylesheet">

    {{-- StyleSheet --}}
    <link rel="stylesheet" href="{{ asset('assets/scss/custom.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/bootstrap-icons/bootstrap-icons.min.css') }}">
</head>

<body>
    {{-- Navbar --}}
    <nav class="navbar navbar-expand-lg navbar-transparent">
        <div class="container">
            <a class="navbar-brand fw-bold" href={{ url('/') }}>
                <img src={{ asset('assets/galyna/logo-v2-transparent.svg') }} alt="">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
                aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <i class="bi bi-text-right"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-link {{ Request::is('home*') ? 'active' : null }}" href="{{ url('home') }}">Home</a>
                    <a class="nav-link" href="#">Collection</a>
                    <a class="nav-link {{ Request::is('article*') ? 'active' : null }}"
                        href="{{ url('article') }}">Article</a>
                    <a class="nav-link" href="#">About</a>
                    <a class="nav-link" href="{{ url('/login') }}">Login</a>
                </div>
            </div>
        </div>
    </nav>

    {{-- Isi Content Web / User Content --}}
    <main>
        @yield('content')
    </main>

    <footer class="bg-primary pt-2 text-white">
        <div class="container">
            <div class="d-flex p-2 justify-content-center gap-2">
                <p>Galyna Heiwa &copy; 2024
                    Developed by <a class="text-white" style="text-decoration: none;" href="https://nusatalent.id"
                        target="_blank">NusaTalent</a></p>
            </div>
        </div>
    </footer>

    {{-- Javascript --}}
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <script>
        window.addEventListener('scroll', function() {
            const navbar = document.querySelector('.navbar');
            if (window.scrollY > 50) {
                navbar.classList.remove('navbar-transparent');
                navbar.classList.add('bg-primary');
            } else {
                navbar.classList.add('navbar-transparent');
                navbar.classList.remove('bg-primary');
            }
        });
    </script>
</body>

</html>
