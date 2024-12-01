@extends('layout.user_layout')
@section('content')
    <div>
        {{-- HERO SECTION --}}
        <section id="hero-section">
            <div class="container" style="padding-top: 70px;">
                {{-- Carousel --}}
                <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel" data-bs-delay="100">
                    <div class="carousel-inner">
                        @for ($i = 1; $i < 3; $i++)
                            <div class="carousel-item hero-carousel {{ $i == 1 ? 'active' : null }}">
                                <div class="card-carousel">
                                    <div class="img-carousel">
                                        <img src="{{ asset('assets/images/carousel/hero_' . $i . '.png') }}"
                                            class="d-block w-100" alt="Galyna Carousel">
                                    </div>
                                </div>
                            </div>
                        @endfor
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying"
                        data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying"
                        data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
        </section>

        {{-- PRODUCT SECTION --}}
        <section id="product-section" class="bg-motif-1" style="margin: 10px 0; padding: 40px 0;">
            <div class="container">
                {{-- Product Search --}}
                <div class="product-search">
                    <div class="title-section">
                        <h4 class="fw-bold m-0">Everyone's Favorites</h4>
                        <span>Find the favorites products for your</span>
                    </div>
                    <form action="" method="get">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="Search Product"
                                aria-label="Search Product" aria-describedby="button-addon2">
                            <button class="btn btn-primary text-white" type="submit" id="button-addon2">Search</button>
                        </div>
                    </form>
                </div>

                {{-- Product List --}}
                <div style="width: 100%; display: flex; justify-content: center">
                    <div class="row" style="min-width: 100%">
                        @foreach ($products as $item)
                            <div class="col-6 col-sm-6 col-md-3 col-lg-2 p-1">
                                <a href="{{ url('collection/' . $item->code) }}">
                                    <div class="card-product">
                                        <div class="card-img">
                                            <img src={{ asset('images/' . $item->cover_image) }} alt="{{ $item->name }}">
                                        </div>
                                        <div class="card-label">
                                            <div class="mb-1">
                                                <div class="badge" style="background-color: rgb(255, 129, 181);">
                                                    <i class="bi bi-heart"></i>
                                                    <span class="like-count">{{ $item->rating }}</span>
                                                </div>
                                                @if ($item->is_new)
                                                    <span class="badge bg-primary"
                                                        style="background-color: rgb(255, 129, 181);">
                                                        New
                                                    </span>
                                                @endif
                                            </div>
                                            <h6 class="m-0">{{ $item->name }}</h6>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>

        {{-- ABOUT US SECTION --}}
        <section id="about" style="margin: 20px 0;">
            <div class="container">
                <div class="title-section">
                    <h4 class="fw-bold m-0">About Us</h4>
                    <span>Get to know us more</span>
                </div>

                {{-- About Us Content --}}
                <div class="row">
                    <div class="col-12 col-md-6">
                        <div class="about-us">
                            <div class="about-us-img">
                                <img src={{ asset('assets/galyna/logo-v2.svg') }} alt="">
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="about-us">
                            <div class="about-us-content" style="text-align: justify; font-size: 1rem">
                                Galyna Heiwa, established in 2018, specializes in the fashion industry by producing unique,
                                handcrafted textiles and ready-to-wear clothing with a focus on traditional Sasirangan and
                                Ecoprint fabrics from South Kalimantan. The brand emphasizes natural dyes to create
                                eco-friendly, sustainable fashion items that include not only garments but also bags, hats,
                                and
                                a range of modest fashion attire. Galyna Heiwa celebrates the heritage and craftsmanship of
                                South Kalimantan, bringing the beauty of traditional Indonesian art to a modern audience
                                with
                                every piece they produce.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- CONTACT US SECTION --}}
        <section id="contact-us" class="bg-motif-2 p-3">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-md-6">
                        <div class="contact-us">
                            <div class="contact-us-content">
                                <div class="title-section">
                                    <h4 class="fw-bold m-0">Contact Us</h4>
                                    <span>Get to know us more</span>
                                </div>
                                <div class="contact-us-item">
                                    <i class="bi bi-geo-alt"></i>
                                    <span>Jl. Kamaratih RT. 006/002 Ds. Panggung Kec. Pelaihari Kab. Tanah Laut Prov. Kalimantan Selatan</span>
                                </div>
                                <div class="contact-us-item">
                                    <i class="bi bi-telephone"></i>
                                    <span>+62 821 5247 4602</span>
                                </div>
                                <div class="contact-us-item">
                                    <i class="bi bi-envelope"></i>
                                    <span>
                                        <a class="text-white" href="mailto:haniktimur79@gmail.com">
                                            haniktimur79@gmail.com
                                        </a>
                                    </span>
                                </div>
                                <div class="media-social">
                                    <a href="https://instagram.com/galynaheiwaofficial">
                                        <img src={{ asset('assets/images/social_media/instagram.png') }} alt="">
                                    </a>
                                    <a href="https://www.facebook.com/galynaheiwa?mibextid=ZbWKwL">
                                        <img src={{ asset('assets/images/social_media/facebook.png') }} alt="">
                                    </a>
                                    <a href="https://www.tiktok.com/@haniktimur59/video/7309773849191730438">
                                        <img src={{ asset('assets/images/social_media/tiktok.png') }} alt="">
                                    </a>
                                    <a href="https://wa.me/6282152474602">
                                        <img src={{ asset('assets/images/social_media/whatsapp.png') }} alt="">
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card-contact">
                            <form action="">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" class="form-control" id="name"
                                        aria-describedby="nameHelp">
                                    <div id="nameHelp" class="form-text">We'll never share your name with anyone else.
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email address</label>
                                    <input type="email" class="form-control" id="email"
                                        aria-describedby="emailHelp">
                                    <div id="emailHelp" class="form-text">We'll never share your email with anyone else.
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="message" class="form-label">Message</label>
                                    <textarea class="form-control" id="message" rows="3"></textarea>
                                </div>
                                <button type="submit">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
