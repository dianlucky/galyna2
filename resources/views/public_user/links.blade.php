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
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

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
            <p style="font-size: 10px; color:rgb(121, 121, 121);">Discover the latest trends in fashion with Galyna Heiwa.</p>
        </div>
        <div class="links-container">
            <a class="links-item" href="{{ url('home') }}">
                <img width="20px" src={{ asset('assets/images/social_media/world-wide-web.png') }} alt="">
                <span class="label">Galyna Heiwa Official Website</span>
            </a>
            <a class="links-item">
                <img width="20px" src={{ asset('assets/images/social_media/id-card.png') }} alt="">
                <span class="label">Galyna Heiwa Official Profile</span>
            </a>
            <a class="links-item">
                <img width="20px" src={{ asset('assets/images/social_media/instagram.png') }} alt="">
                <span class="label">Instagram</span>
            </a>
            <a class="links-item">
                <img width="20px" src={{ asset('assets/images/social_media/facebook.png') }} alt="">
                <span class="label">Facebook</span>
            </a>
            <a class="links-item">
                <img width="20px" src={{ asset('assets/images/social_media/tiktok.png') }} alt="">
                <span class="label">Tiktok</span>
            </a>
            <a class="links-item">
                <img width="20px" src={{ asset('assets/images/social_media/whatsapp.png') }} alt="">
                <span class="label">Whatsapp</span>
            </a>
        </div>
        <footer>
            <div class="container">
                <div class="d-flex p-2 justify-content-center gap-2">
                    <p>Galyna Heiwa &copy; 2024
                        Developed by <a href="https://nusatalent.id" target="_blank">NusaTalent Team</a></p>
                </div>
            </div>
        </footer>
    </div>

    {{-- Javascript --}}
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
</body>

</html>
