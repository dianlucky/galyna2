@use('Carbon\Carbon')
@use('Illuminate\Support\Str')
@extends('layout.user_layout')

@section('meta')
    <meta name="description" content="Discover our latest products, features, and reviews.">
    <meta name="keywords" content="products, features, reviews">
    <meta property="og:title" content="{{ $product->name }}">
    <meta property="og:description" content="{{ Str::limit(strip_tags($product->description), 100) }}">
    <meta property="og:image" content="{{ asset('images/' . $product->image) }}">
    <meta property="og:url" content="{{ url('product/' . $product->code) }}">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $product->name }}">
    <meta name="twitter:description" content="{{ Str::limit(strip_tags($product->description), 100) }}">
    <meta name="twitter:image" content="{{ asset('images/' . $product->image) }}">
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
                    <h1 class="m-0 fw-bold">Collection</h1>
                    <p>
                        Discover our latest products, features, and reviews.
                    </p>
                </div>

                {{-- Form input Search --}}
                <form action="" method="get" style="align-items: center;">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search Product" aria-label="Search Product"
                            aria-describedby="button-addon2">
                        <button class="text-white btn btn-primary" type="submit" id="button-addon2">
                            <i class="bi bi-search"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>

        {{-- Main Content --}}
        <div class="container pb-5 mt-4">

            {{-- Detail Product --}}
            <div class="mt-5 row">
                @if ($product)
                    {{-- Image Products --}}
                    <div class="col-md-6">
                        <div class="w-100 d-flex justify-content-center">
                            <img src="{{ asset('images/' . $product->cover_image) }}" class="card-img-top"
                                style="border-radius: 10px; margin-top: 18px" alt="{{ $product->name }}">
                        </div>
                    </div>

                    <div class="col-md-6">
                        {{-- Description Products --}}
                        <div class="mt-3 font-size-4">
                            <h1 class="fw-bold">{{ $product->name }}</h1>
                            <h4 class="fw-bold text-secondary">{{ $product->category->name }}</h4>
                            <p class="fw-bolder fs-1" style="color: rgb(8, 89, 139); margin-bottom: 0px">Rp
                                {{ number_format($product->price, 0, ',', '.') }}</p>
                            <p class="text-secondary">
                                <small>
                                    <i class="bi bi-calendar"></i>
                                    {{ Carbon::parse($product->created_at)->format('d F Y') }}
                                </small>
                            </p>
                            <div style="text-align: justify;">
                                {!! $product->description !!}
                            </div>
                            <p class="text-secondary">
                                <small>
                                    <i class="bi bi-eye"></i> {{ $product->views }} views
                                </small>
                            </p>
                            <p class="text-secondary">
                                <small>
                                    {{-- <i class="bi bi-chat-left-text"></i> {{ $product->comments->count() }} comments --}}
                                </small>
                            </p>
                        </div>

                        <div class="mt-3 row">
                            <div class="col-lg-4">
                                <form action="{{ url('collection/like/' . $product->code) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="mt-3 text-white btn w-100"
                                        style="background-color: rgb(255, 129, 181);">
                                        <i class="bi bi-heart me-2"></i> I Like This
                                    </button>
                                </form>
                            </div>
                            <div class="col-lg-4">
                                <button class="mt-3 text-white btn btn-secondary w-100">
                                    <i class="bi bi-chat-left-text me-2"></i> Message Galyna Heiwa
                                </button>
                            </div>
                            <div class="col-lg-4">
                                <a href="{{url('/make-order/'.$product->code)}}" class="mt-3 text-white btn btn-primary w-100">Create Order</a>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="py-5 text-center alert alert-warning" role="alert">
                        <h1 class="charmonman-regular">No collection found.</h1>
                    </div>
                @endif
            </div>

            {{-- Product List --}}
            <div class="mt-5">
                <h3 class="fw-bold">Related Products</h3>
                <p>
                    Here are some of the latest products for you to buy.
                </p>
                <hr>
                <div style="width: 100%; display: flex; justify-content: center;">
                    <div class="mt-3 row" style="min-width: 100%">
                        @foreach ($products_related as $item)
                            <div class="p-1 col-6 col-sm-6 col-md-3 col-lg-2">
                                <a href="{{ url('collection/' . $item->code) }}">
                                    <div class="card-product {{ $product->code == $item->code ? 'active' : null }}">
                                        <div class="card-img">
                                            <img src={{ asset('images/' . $item->cover_image) }}
                                                alt="{{ $item->name }}">
                                        </div>
                                        <div class="card-label">
                                            <div class="mb-1">
                                                <div class="badge" style="background-color: rgb(255, 129, 181);">
                                                    <i class="bi bi-heart"></i>
                                                    <span class="like-count">{{ $item->rating }}</span>
                                                </div>
                                                @if ($item->is_new)
                                                    <span class="badge bg-primary">
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

                        @if ($products_related->count() == 0)
                            <div class="py-5 text-center alert alert-primary" role="alert">
                                <h1 class="charmonman-regular">No product found.</h1>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
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
