@extends('layout.user_layout') {{-- Sesuaikan dengan layout Anda --}}

@section('content')
    <section class="bg-motif-1" style="padding-top: 10vh; min-height: 92.7vh">
        <div class="container pt-3 pb-5">
            <nav style="font-size: 12px; color: #999; margin-bottom: -5px;">
                <ol class="breadcrumb" style="background-color: transparent; padding: 0;">
                    <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ url('/') }}">Home</a></li>
                    <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('my.orders') }}">My Orders</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Checkout</li>
                </ol>
            </nav>

            <div class="title-section" style="flex-grow: 1; min-width: 70%; margin: 0;">
                <h1 class="m-0 fw-bold">Checkout Order #{{ $order->id }}</h1>
                <p>
                    Please review your order details and proceed with payment.
                </p>
            </div>

            <div class="mt-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Order Summary</h5>
                        <p><strong>Product:</strong> {{ optional($order->product)->name ?? 'N/A' }}</p>
                        <p><strong>Quantity:</strong> {{ $order->quantity }}</p>
                        <p><strong>Total Price:</strong> Rp {{ number_format($order->total_price, 0, ',', '.') }}</p>
                        <hr>
                        <h5 class="card-title">Customer Information</h5>
                        <p><strong>Name:</strong> {{ $order->customer_name }}</p>
                        <p><strong>Email:</strong> {{ $order->customer_email }}</p>
                        <p><strong>Phone:</strong> {{ $order->customer_phone }}</p>
                        <p><strong>Address:</strong> {{ $order->customer_address }}</p>
                        <p><strong>Message:</strong> {{ $order->message ?? '-' }}</p>

                        <hr>
                        {{-- Di sini Anda akan menambahkan formulir pembayaran atau instruksi pembayaran --}}
                        <h5 class="card-title">Payment Method</h5>
                        <p>
                            Silakan pilih metode pembayaran Anda (misal: Transfer Bank, Kartu Kredit, dll.).
                            Implementasi pembayaran akan ditambahkan di sini.
                        </p>

                        <form action="{{ route('checkout.process', $order->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-primary w-100 mt-3">Confirm Payment</button>
                        </form>
                        <a href="{{ route('my.orders') }}" class="btn btn-secondary w-100 mt-2">Cancel Checkout</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('script')
    @include('components.notifications')
@endsection
