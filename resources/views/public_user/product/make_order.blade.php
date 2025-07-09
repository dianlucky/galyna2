@use('Carbon\Carbon')
@use('Illuminate\Support\Str')
@extends('layout.user_layout')

@section('meta')
    <meta name="description" content="Discover our latest products, features, and reviews.">
    <meta name="keywords" content="orders, history, products">
    <meta property="og:title" content="{{ $product->name }}">
    <meta property="og:description" content="{{ Str::limit(strip_tags($product->description), 100) }}">
    <meta property="og:image" content="{{ asset('images/' . $product->cover_image) }}">
    <meta property="og:url" content="{{ url('product/' . $product->code) }}">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $product->name }}">
    <meta name="twitter:description" content="{{ Str::limit(strip_tags($product->description), 100) }}">
    <meta name="twitter:image" content="{{ asset('images/' . $product->cover_image) }}">
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
                    <li class="breadcrumb-item active" aria-current="page">Make Order</li>
                </ol>
            </nav>

            {{-- Header Page --}}
            <div class="product-search" style="padding: 0;">
                <div class="title-section" style="flex-grow: 1; min-width: 70%; margin: 0;">
                    <h1 class="m-0 fw-bold">Create Order</h1>
                    <p>
                        Create your order here.
                    </p>
                </div>
            </div>
        </div>

        {{-- Main Content --}}
        <div class="container pb-5 mt-4">
            <div class="mt-5 row">
                {{-- Detail Product --}}
                <div class="col-lg-8">
                    <div class="row">

                        @if ($product)
                            {{-- Image Products --}}
                            <div class="col-md-4">
                                <div class="w-100 d-flex justify-content-center">
                                    <img src="{{ asset('images/' . $product->cover_image) }}" class="card-img-top"
                                        style="border-radius: 10px; margin-top: 18px" alt="{{ $product->name }}">
                                </div>
                            </div>

                            <div class="col-md-8">
                                {{-- Description Products --}}
                                <div class="mt-3 font-size-6">
                                    <h4 class="fw-bold">{{ $product->name }}</h4>
                                    <h5 class="fw-bold text-secondary">{{ optional($product->category)->name }}</h5>
                                    <p class="fw-bolder fs-1 text-primary">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
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
                            </div>
                        @else
                            <div class="py-5 text-center alert alert-warning" role="alert">
                                <h1 class="charmonman-regular">No collection found.</h1>
                            </div>
                        @endif
                    </div>
                </div>

                {{-- Order Form --}}
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('order.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="product_code" value="{{ $product->code }}">

                                {{-- Hidden div untuk menyimpan harga produk secara aman --}}
                                <div id="product_data" data-price="{{ (float)($product->price ?? 0) }}"></div>

                                {{-- Name Input --}}
                                <div class="mb-3">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" value="{{ old('name', $user->name) }}"
                                        class="form-control @error('name') is-invalid @enderror" id="name" name="name" required>
                                    @error('name')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                {{-- Email Input --}}
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email address</label>
                                    <input type="email" value="{{ old('email', $user->email) }}"
                                        class="form-control @error('email') is-invalid @enderror" id="email" name="email" required>
                                    @error('email')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                {{-- Phone Number Input --}}
                                <div class="mb-3">
                                    <label for="phone_number" class="form-label">Phone Number</label>
                                    <input type="text" value="{{ old('phone_number', $user->phone_number ?? '') }}" class="form-control @error('phone_number') is-invalid @enderror" id="phone_number"
                                        name="phone_number" required>
                                    @error('phone_number')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                {{-- Message Input --}}
                                <div class="mb-3">
                                    <label for="message" class="form-label">Message</label>
                                    <textarea class="form-control @error('message') is-invalid @enderror" id="message" name="message" rows="3">{{ old('message') }}</textarea>
                                    @error('message')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                {{-- Quantity Input --}}
                                <div class="mb-3">
                                    <label for="quantity" class="form-label">Quantity of Product</label>
                                    <input type="number" class="form-control @error('quantity') is-invalid @enderror" id="quantity" name="quantity"
                                        min="1" value="1" required>
                                    @error('quantity')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                {{-- Total Price --}}
                                <div>
                                    <div class="mb-3">
                                        <label for="total_price" class="form-label">Total Price</label>
                                        <input type="text" class="form-control" disabled id="total_price"
                                            name="total_price" readonly>
                                    </div>

                                    <script>
                                        // Variabel productPrice diambil dari atribut data-* pada elemen HTML
                                        const productPrice = parseFloat(document.getElementById('product_data').dataset.price);

                                        document.getElementById('quantity').addEventListener('input', function() {
                                            const quantity = parseInt(this.value) || 0;
                                            const totalPrice = quantity * productPrice;
                                            document.getElementById('total_price').value = 'Rp ' + totalPrice.toLocaleString('id-ID');
                                        });

                                        // Panggil saat halaman dimuat untuk inisialisasi awal total harga
                                        document.getElementById('quantity').dispatchEvent(new Event('input'));
                                    </script>
                                </div>

                                <button type="submit" class="mt-5 text-white btn btn-primary w-100">Create Order</button>
                                {{-- Cancel --}}
                                <a href="{{ url('product/' . $product->code) }}"
                                    class="mt-3 text-center d-block">Cancel</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('script')
    @include('components.notifications')
    {{-- Script oembed (jika masih diperlukan) --}}
    <script>
        document.querySelectorAll('oembed[url]').forEach(element => {
            const url = element.getAttribute('url');
            const iframe = document.createElement('iframe');

            iframe.setAttribute('width', '560');
            iframe.setAttribute('height', '315');
            iframe.setAttribute('src', url.replace('youtu.be', 'https://www.youtube.com/embed/').replace('?si=', '?'));
            iframe.setAttribute('frameborder', '0');
            iframe.setAttribute('allow',
                'accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share'
            );
            iframe.setAttribute('allowfullscreen', true);

            element.parentNode.replaceChild(iframe, element);
        });
    </script>
@endsection
