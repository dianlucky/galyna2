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
                        <p class="text-muted"><small><i class="bi bi-eye"></i> {{ $product->views }} views</small></p>
                       
                            {{-- Order Form --}}
                        <div class="card mt-4">
                            <div class="card-body">
                                <h5 class="card-title">Create Order</h5>
                                @if (session('success'))
                                    <div class="alert alert-success">
                                        {{ session('success') }}
                                    </div>
                                @endif

                                @if (session('error'))
                                    <div class="alert alert-danger">
                                        {{ session('error') }}
                                    </div>
                                @endif

                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul class="mb-0">
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                <form action="{{ route('order.store') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="product_code" value="{{ $product->code }}">
                                    @foreach ([
                                        'name' => 'Name',
                                        'email' => 'Email address',
                                        'phone_number' => 'Phone Number',
                                    ] as $field => $label)
                                        <div class="mb-3">
                                            <label for="{{ $field }}"
                                                class="form-label">{{ $label }}</label>
                                            <input type="{{ $field === 'email' ? 'email' : 'text' }}"
                                                id="{{ $field }}" name="{{ $field }}"
                                                class="form-control @error($field) is-invalid @enderror"
                                                value="{{ old($field, $user->$field ?? '') }}" required>
                                            @error($field)
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    @endforeach

                                   

                                    <div class="mb-3">
                                        <label for="message" class="form-label">Message (Optional)</label>
                                        <textarea id="message" name="message" rows="3" class="form-control @error('message') is-invalid @enderror">{{ old('message') }}</textarea>
                                        @error('message')
                                            {{-- <div class="invalid-feedback">{{ $message }}</div> --}}
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="quantity" class="form-label">Quantity</label>
                                        <input type="number" id="quantity" name="quantity" min="1"
                                            value="{{ old('quantity', 1) }}"
                                            class="form-control @error('quantity') is-invalid @enderror" required>
                                        @error('quantity')
                                            {{-- <div class="invalid-feedback">{{ $message }}</div> --}}
                                        @enderror
                                    </div>
{{-- 
                                    <div class="mb-3">
                                        <label class="form-label">Total Price</label>
                                        <input type="text" id="total_price" class="form-control-plaintext ps-2"
                                            readonly>
                                    </div> --}}

                                    <button type="submit" class="btn btn-primary w-100 text-white">Create Order</button>
                                    <a href="{{ url('collection/' . $product->code) }}"
                                        class="d-block mt-3 text-center">Cancel</a>
                                </form>
                            </div>
                        </div>
                        <div>

                        </div>
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
