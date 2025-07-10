@extends('layout.user_layout')

@section('meta')
    <meta name="description" content="Discover our latest products, features, and reviews.">
    <meta name="keywords" content="products, features, reviews">
    <meta property="og:title" content="{{ $product->name ?? 'Product Detail' }}">
    <meta property="og:description"
        content="{{ \Illuminate\Support\Str::limit(strip_tags($product->description ?? ''), 100) }}">
    <meta property="og:image" content="{{ asset('images/' . ($product->cover_image ?? 'default.jpg')) }}">
    <meta property="og:url" content="{{ url('product/' . ($product->code ?? '')) }}">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $product->name ?? 'Product Detail' }}">
    <meta name="twitter:description"
        content="{{ \Illuminate\Support\Str::limit(strip_tags($product->description ?? ''), 100) }}">
    <meta name="twitter:image" content="{{ asset('images/' . ($product->cover_image ?? 'default.jpg')) }}">
    <meta name="twitter:site" content="@GalynaHeiwa">
@endsection

@section('content')
    <section class="bg-motif-1 pt-5" style="min-height: 92.7vh">
        <div class="container pb-5">
            {{-- Breadcrumb --}}
            <nav class="breadcrumb small text-muted bg-transparent px-0 mb-2">
                <a class="breadcrumb-item text-decoration-none" href="{{ url('/') }}">Home</a>
                <span class="breadcrumb-item active">Product</span>
            </nav>

            {{-- Page Header --}}
            <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between mb-4">
                <div>
                    <h1 class="fw-bold mb-1">Collection</h1>
                    <p class="text-muted mb-2">Discover our latest products, features, and reviews.</p>
                </div>
                <form action="" method="get" class="d-flex">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control" placeholder="Search Product"
                            value="{{ request('search') }}">
                        <button type="submit" class="btn btn-primary text-white">
                            <i class="bi bi-search"></i>
                        </button>
                    </div>
                </form>
            </div>

            @if ($product)
                <div class="row g-4">
                    {{-- Product Image --}}
                    <div class="col-md-6 text-center">
                        <img src="{{ asset('images/' . $product->cover_image) }}" class="img-fluid rounded"
                            alt="{{ $product->name }}">
                    </div>

                    {{-- Product Info --}}
                    <div class="col-md-6">
                        <h2 class="fw-bold">{{ $product->name }}</h2>
                        <h6 class="text-secondary">{{ optional($product->category)->name }}</h6>
                        <p class="fw-bold fs-4 text-primary">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                        <p class="text-muted"><small><i class="bi bi-calendar"></i>
                                {{ $product->created_at->format('d F Y') }}</small></p>
                        <div class="mb-3">{!! $product->description !!}</div>
                        {{-- <p class="text-muted"><small><i class="bi bi-eye"></i> {{ $product->views }} views</small></p> --}}
                        <div style="margin-top: 20px">
                            <button class="btn btn-outline-danger btn-lg me-1" style="color: red" data-bs-toggle="modal"
                                data-bs-target="#addCart">Masukkan keranjang</button>
                            {{-- <a href={{url('/')}} class="btn btn-primary btn-lg me-1" style="color: white" >Beli
                                sekarang</a> --}}
                        </div>

                        {{-- MODAL TAMBAH KERANJANG --}}
                        <div class="modal fade" id="addCart" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <form action={{ url('/shopping-cart/add') }} method="POST">
                                    @csrf
                                    <input type="hidden" name="id_product" value="{{ $product->id_product }}">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Masukkan keranjang</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">

                                            <div class="mb-3">
                                                <label for="product_name" class="form-label">Nama produk</label>
                                                <input type="text" class="form-control" id="product_name"
                                                    name="product_name" value="{{ $product->name }}" readonly>
                                            </div>
                                            <div class="mb-3">
                                                <label for="product_price" class="form-label">Harga produk</label>
                                                <input type="text" class="form-control" id="product_price"
                                                    name="product_price"
                                                    value="Rp {{ number_format($product->price, 0, ',', '.') }}" readonly>
                                            </div>
                                            <div class="mb-3">
                                                <label for="quantity" class="form-label">Jumlah yang dibeli</label>
                                                <input type="number" class="form-control" id="quantity" min="1"
                                                    name="quantity" value="" required>
                                            </div>

                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary text-white"
                                                data-bs-dismiss="modal">Batal</button>
                                            <button type="submit" class="btn btn-primary text-white">Simpan</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        {{-- END FOR MODAL TAMBAH KERANJANG --}}

                        {{-- MODAL ORDER LANGSUNG --}}

                        {{-- END FOR MODAL ORDER LANGSUNG --}}
                    </div>
                </div>

                {{-- JS for Total Price calculation --}}
                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        // Perbaikan: Menambahkan operator null coalescing (?? 0) untuk memastikan nilai numerik jika $product->price null
                        const price = json($product - > price ?? 0);
                        const quantityInput = document.getElementById('quantity');
                        const totalPriceInput = document.getElementById('total_price');

                        function updateTotal() {
                            const qty = parseInt(quantityInput.value) || 0;
                            if (!isNaN(qty) && qty >= 1 && !isNaN(price)) {
                                const total = qty * price;
                                totalPriceInput.value = 'Rp ' + total.toLocaleString('id-ID');
                            } else {
                                totalPriceInput.value = 'Rp 0';
                            }
                        }

                        quantityInput.addEventListener('input', updateTotal);
                        updateTotal(); // Panggil saat halaman pertama kali dimuat
                    });
                </script>
            @else
                <div class="alert alert-warning text-center mt-5">
                    <h2>No collection found.</h2>
                </div>
            @endif
        </div>
    </section>
@endsection

@section('script')
    @include('components.notifications')
@endsection
