@use('Carbon\Carbon')
@use('Illuminate\Support\Str')
@extends('layout.user_layout')

@section('meta')
    <meta name="description" content="Discover our collection of Sasirangan products from Kalimantan Selatan.">
    <meta name="keywords" content="Sasirangan, Kalimantan Selatan, products, features, reviews">
    <meta property="og:title" content="Sasirangan Collection">
    <meta property="og:description" content="Explore our unique Sasirangan products from Kalimantan Selatan.">
    <meta property="og:image" content="{{ asset('images/sasirangan-collection.jpg') }}">
    <meta property="og:url" content="{{ url('collection') }}">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Sasirangan Collection">
    <meta name="twitter:description" content="Explore our unique Sasirangan products from Kalimantan Selatan.">
    <meta name="twitter:image" content="{{ asset('images/sasirangan-collection.jpg') }}">
    <meta name="twitter:site" content="@GalynaHeiwa">
@endsection

@section('content')
    <section class="bg-motif-1" style="padding-top: 10vh; min-height: 92.7vh">

        {{-- Header Page --}}
        <div class="container pt-3">
            {{-- Navigation Breadcrumb --}}
            <nav style="font-size: 12px; color: #999; margin-bottom: -5px;">
                <ol class="breadcrumb" style="background-color: transparent; padding: 0;">
                    <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ url('/') }}">Home</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Product</li>
                </ol>
            </nav>

            {{-- Header Page --}}
            <div class="product-search" style="padding: 0;">
                <div class="title-section" style="flex-grow: 1; min-width: 70%; margin: 0;">
                    <h1 class="fw-bold m-0">Collection</h1>
                    <p>
                        Discover our latest products, features, and reviews.
                    </p>
                </div>

                {{-- Form input Search --}}
                <form action="" method="get" style="align-items: center;">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search Product" aria-label="Search Product"
                            aria-describedby="button-addon2">
                        <button class="btn btn-primary text-white" type="submit" id="button-addon2">
                            <i class="bi bi-search"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>

        {{-- Main Content --}}
        <div class="container mt-4 pb-5">
            {{-- Category Bagde --}}
            <div class="d-flex flex-wrap mb-3">
                <a href="{{ url('collection') }}"
                    class="badge {{ request()->get('category') == null ? 'bg-primary' : 'bg-secondary' }} text-decoration-none m-1 font-size-4">
                    All Product
                </a>
                @foreach ($categories as $category)
                    <a href="{{ url('collection?category=' . $category->name) }}"
                        class="badge {{ request()->get('category') == $category->name ? 'bg-primary' : 'bg-secondary' }} text-decoration-none m-1 font-size-4">
                        {{ $category->name }}
                    </a>
                @endforeach
            </div>
            {{-- Product List --}}
            <div style="width: 100%; display: flex; justify-content: center;">
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

                    @if ($products->count() == 0)
                        <div class="alert alert-primary text-center py-5" role="alert">
                            <h1 class="charmonman-regular">No product found.</h1>
                        </div>
                    @endif
                </div>
            </div>
        </div>
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
                                    <span>Jl. Kamaratih RT. 006/002 Ds. Panggung Kec. Pelaihari Kab. Tanah Laut Prov.
                                        Kalimantan Selatan</span>
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
    </section>
@endsection

@section('script')
    <script>
        document.querySelectorAll('oembed[url]').forEach(element => {
            const url = element.getAttribute('url');
            const iframe = document.createElement('iframe');

            iframe.setAttribute('width', '560');
            iframe.setAttribute('height', '315');
            iframe.setAttribute('src', url.replace('youtu.be', 'www.youtube.com/embed').replace('?si=', '?'));
            iframe.setAttribute('frameborder', '0');
            iframe.setAttribute('allow',
                'accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share'
            );
            iframe.setAttribute('allowfullscreen', true);

            element.parentNode.replaceChild(iframe, element);
        });
    </script>
@endsection
