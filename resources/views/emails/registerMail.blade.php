<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Selamat Bergabung di Galyna</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background: #f5f5f5;
        }

        .email-container {
            max-width: 600px;
            margin: 40px auto;
            background: #ffffff;
            padding: 30px 40px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.05);
        }

        .logo {
            text-align: center;
            margin-bottom: 25px;
        }

        .logo img {
            width: 110px;
        }

        h1 {
            font-size: 22px;
            color: #333333;
            text-align: center;
            margin-bottom: 20px;
        }

        p {
            font-size: 15px;
            line-height: 1.7;
            color: #444444;
        }

        .btn {
            display: inline-block;
            margin: 25px 0;
            padding: 12px 25px;
            background-color: #1b5e20;
            color: white;
            text-decoration: none;
            border-radius: 6px;
            font-weight: bold;
        }

        .footer {
            text-align: center;
            font-size: 12px;
            color: #999999;
            margin-top: 30px;
        }
    </style>
</head>

<body>
    <div class="email-container">
        <div class="logo">
            <img src="{{ url('/') }}/assets/galyna/logo-v2-transparent.svg" width="200" alt="Galyna Logo" />
        </div>

        <h1>Selamat Datang di Galyna</h1>

        <p>Halo, {{ $name }}</p>

        <p>Terima kasih telah bergabung bersama <strong>Galyna</strong> — toko busana yang mengangkat keindahan
            <strong>motif Sasirangan</strong>, warisan budaya khas Kalimantan Selatan, dalam setiap koleksi kami.</p>

        <p>Dengan sentuhan tradisi dan desain yang elegan, kami berkomitmen menghadirkan pakaian yang tidak hanya nyaman
            dikenakan, tetapi juga penuh makna budaya. Bergabungnya Anda adalah kehormatan bagi kami.</p>

        <p>Silakan jelajahi koleksi terbaik kami dan temukan busana Sasirangan yang sesuai dengan gaya dan kepribadian
            Anda.</p>

        <div style="text-align: center;">
            <a href="https://galynaheiwa.com" class="btn">Kunjungi Toko Kami</a>
        </div>

        <p>Jika Anda memiliki pertanyaan atau membutuhkan bantuan, jangan ragu untuk menghubungi tim kami. Kami siap
            membantu Anda dengan sepenuh hati.</p>

        <p>Hormat kami,<br>
            <strong>Tim Galyna</strong>
        </p>

        <div class="footer">
            &copy; 2025 Galyna – Warisan Sasirangan, Gaya yang Menginspirasi
        </div>
    </div>
</body>

</html>
