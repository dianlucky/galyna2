<!DOCTYPE html>
<html lang="en">
{{-- User Layout --}}

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Galyna Heiwa | International Local Fashion</title>
    <meta name="description"
        content="Galyna Heiwa, established in 2018, specializes in the fashion industry by producing unique, handcrafted textiles and ready-to-wear clothing with a focus on traditional Sasirangan and Ecoprint fabrics from South Kalimantan. The brand emphasizes natural dyes to create eco-friendly, sustainable fashion items that include not only garments but also bags, hats, and a range of modest fashion attire. Galyna Heiwa celebrates the heritage and craftsmanship of South Kalimantan, bringing the beauty of traditional Indonesian art to a modern audience with every piece they produce.">
    <meta name="keywords"
        content="Galyna Heiwa, fashion, international fashion, local fashion, stylish designs, fashion articles, Kalimantan Selatan, Sasirangan">
    <meta name="author" content="Galyna Heiwa">
    <meta property="og:title" content="Galyna Heiwa | International Local Fashion">
    <meta property="og:description"
        content="Galyna Heiwa offers international local fashion with unique and stylish designs. Discover our latest collections and articles.">
    <meta property="og:image" content="{{ asset('assets/galyna/logo-v2-transparent.svg') }}">
    <meta property="og:url" content="{{ url('/') }}">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Galyna Heiwa | International Local Fashion">
    <meta name="twitter:description"
        content="Galyna Heiwa offers international local fashion with unique and stylish designs. Discover our latest collections and articles.">
    <meta name="twitter:image" content="{{ asset('assets/galyna/logo-v2-transparent.svg') }}">
    <meta name="twitter:site" content="@GalynaHeiwa">
    <meta name="twitter:creator" content="@GalynaHeiwa">
    <meta name="description" content="Fashion lokal asal Kalimantan Selatan, Indonesia dengan motif Sasirangan.">

    @yield('meta')


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
                    <a class="nav-link" href="#product-section">Products</a>
                    <a class="nav-link {{ Request::is('article*') ? 'active' : null }}"
                        href="{{ url('article') }}">Article</a>
                    <a class="nav-link" href="#about">About</a>
                    @if (Auth::check())
                        <a class="nav-link" href="{{ url('/admin/dashboard') }}">Dashboard</a>
                    @else
                        <a class="nav-link" href="{{ url('/login') }}">Login</a>
                    @endif

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
                        target="_blank">Galyna Heiwa IT Team</a></p>
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

    @yield('script')
</body>

</html>
