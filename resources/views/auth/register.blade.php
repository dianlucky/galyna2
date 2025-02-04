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

<body class="bg-motif-1" style="min-height: 100vh;">
    {{-- Isi Content Web / User Content --}}
    <main class="m-auto" style="height: 80vh; width: 100%; display: flex">
        {{-- Logo --}}

        <div class="login-container">
            <section id="login-brand" class="mb-3 d-flex justify-content-center">
                <a href="{{ url('/') }}">
                    <img src="{{ url('/') }}/assets/galyna/logo-v2-transparent.svg" width="200"
                        alt="Galyna Logo" />
                </a>
            </section>

            {{-- Login Section --}}
            <section id="login-section">
                <h1 class="text-center charmonman-bold" style="font-size: 3.6rem">
                    Register
                </h1>
                <div class="mb-5 text-center">
                    <h2 class="text-primary" style="font-size: 1.8rem">Welcome Back!</h2>
                    <p style="font-size: 0.9rem">Please sign in to your account</p>
                </div>
                <form action={{ url('login') }} method="POST" class="pt-4" id="login-form">
                    @csrf

                    {{-- Email Address Input --}}
                    <div class="mb-3">
                        <label for="email" class="form-label">Email address</label>
                        <input autofocus tabindex="1" name="email" @error('email') error @enderror type="email"
                            class="form-control" id="email" placeholder="Enter your email"
                            value="{{ old('email') }}">
                        @error('email')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Password Input --}}
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input tabindex="2" name="password" @error('password') error @enderror type="password"
                            class="form-control" id="password" placeholder="*********">
                        @error('password')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Login Button --}}
                    <div class="gap-2 pt-3 d-grid">
                        <button tabindex="3" type="submit" class="text-white btn btn-primary">Login</button>
                    </div>

                    {{-- Don't have an account link --}}
                    <div class="mt-3 text-center">
                        <p>Don't have an account? <a href="" style="text-decoration: none">Register</a></p>
                    </div>
                </form>
            </section>
        </div>
    </main>

    <footer class="pt-2 text-white bg-primary" style="position: absolute; bottom: 0px; width: 100%">
        <div class="container">
            <div class="gap-2 p-2 d-flex justify-content-center">
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
</body>

</html>
