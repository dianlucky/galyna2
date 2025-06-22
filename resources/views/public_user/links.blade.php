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

    {{-- Poppins Font --}}
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">

    {{-- StyleSheet --}}
    <link rel="stylesheet" href="{{ asset('assets/scss/custom.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/bootstrap-icons/bootstrap-icons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style-links.css') }}">
</head>

<body>
    <div class="links-page">
        <div style="text-align: center; margin-top: -30px; margin-bottom: 10px">
            <h1 class="fw-bold m-0">Galyna Heiwa</h1>
            <p style="font-size: 10px; color:rgb(121, 121, 121);">Discover the latest trends in fashion with Galyna
                Heiwa.</p>
        </div>
        <div class="links-container">
            <a class="links-item" href="{{ url('home') }}">
                <img width="20px" src={{ asset('assets/images/social_media/world-wide-web.png') }} alt="">
                <span class="label">Galyna Heiwa Official Website</span>
            </a>
            <a href="https://heyzine.com/flip-book/4d2233be89.html" class="links-item">
                <img width="20px" src={{ asset('assets/images/social_media/book.png') }} alt="">
                <span class="label">Catalogue</span>
            </a>
            <a href="https://www.instagram.com/galynaheiwaofficial" class="links-item">
                <img width="20px" src={{ asset('assets/images/social_media/instagram.png') }} alt="">
                <span class="label">Instagram</span>
            </a>
            <a href="https://www.facebook.com/galynaheiwa?mibextid=ZbWKwL" class="links-item">
                <img width="20px" src={{ asset('assets/images/social_media/facebook.png') }} alt="">
                <span class="label">Facebook</span>
            </a>
            <a  href="https://www.tiktok.com/@haniktimur59/video/7309773849191730438" class="links-item">
                <img width="20px" src={{ asset('assets/images/social_media/tiktok.png') }} alt="">
                <span class="label">Tiktok</span>
            </a>
            <a href="https://wa.me/6282152474602" class="links-item">
                <img width="20px" src={{ asset('assets/images/social_media/whatsapp.png') }} alt="">
                <span class="label">Whatsapp</span>
            </a>
            <a href="mailto:haniktimur79@gmail.com" class="links-item">
                <img width="20px" src={{ asset('assets/images/social_media/gmail.png') }} alt="">
                <span class="label">E-mail</span>
            </a>
            <a href="https://tokopedia.link/kdCGP2fhkLb" class="links-item">
                <img width="20px" src={{ asset('assets/images/social_media/tokopedia.png') }} alt="">
                <span class="label">Tokopedia</span>
            </a>
        </div>
        <!-- <footer>
            <div class="container">
                <div class="d-flex p-2 justify-content-center gap-2">
                    <p>Galyna Heiwa &copy; 2024
                        Developed by <a href="https://nusatalent.id" target="_blank">NusaTalent</a></p>
                </div>
            </div>
        </footer> -->
    </div>

    {{-- Javascript --}}
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
</body>

</html>
