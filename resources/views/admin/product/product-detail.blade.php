@extends('layouts.app') {{-- atau ganti sesuai layout kamu --}}

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-6">
            {{-- Gambar Produk --}}
            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="img-fluid">
        </div>
        <div class="col-md-6">
            {{-- Detail Produk --}}
            <h2>{{ $product->name }}</h2>
            <p>{{ $product->description }}</p>
            <h4>Rp{{ number_format($product->price, 0, ',', '.') }}</h4>

            {{-- Form Tambah ke Keranjang --}}
            <form action="{{ route('cart.store') }}" method="POST" class="mt-4">
                @csrf
               <input type="hidden" name="product_id" value="{{ $product->id }}">
                <div class="form-group mb-3">
                    <label for="quantity">Jumlah:</label>
                    <input type="number" name="quantity" id="quantity" value="1" min="1" class="form-control w-25">
                </div>
                <button type="submit" class="btn btn-primary">Tambah ke Keranjang</button>
            </form>
        </div>
    </div>
</div>
@endsection
