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
        <div class="container pt-3">
            <nav style="font-size: 12px; color: #999; margin-bottom: -5px;">
                <ol class="breadcrumb" style="background-color: transparent; padding: 0;">
                    <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ url('/') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Order Payment</li>
                </ol>
            </nav>

            <div class="product-search" style="padding: 0;">
                <div class="title-section" style="flex-grow: 1; min-width: 70%; margin: 0;">
                    <h1 class="m-0 fw-bold">Order Payment</h1>
                    <p>Complete your payment here.</p>
                </div>
            </div>
        </div>

        <div class="container pb-5 mt-4">
            <div class="mt-5 row">
                <div class="col-lg-8">
                    <div class="row">
                        @if ($product)
                            <div class="col-md-4">
                                <div class="w-100 d-flex justify-content-center">
                                    <img src="{{ asset('images/' . $product->cover_image) }}" class="card-img-top"
                                        style="border-radius: 10px; margin-top: 18px" alt="{{ $product->name }}">
                                </div>
                            </div>

                            <div class="col-md-8">
                                <div class="mt-3 font-size-6">
                                    <h4 class="fw-bold">{{ $product->name }}</h4>
                                    <h5 class="fw-bold text-secondary">{{ $product->category->name }}</h5>
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
                                </div>
                            </div>
                        @else
                            <div class="py-5 text-center alert alert-warning" role="alert">
                                <h1 class="charmonman-regular">No collection found.</h1>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <form id="payment-form" method="POST" action="{{ url('order-payment/' . $order->code) }}">
                                @csrf
                                <input type="hidden" name="transaction_token" id="transaction_token"
                                    value="{{ $order->transaction_token }}">
                                <input type="hidden" name="id_order" id="id_order" value="{{ $order->id_order }}">
                                <table class="table">
                                    <tr>
                                        <th colspan="2" class="text-center">
                                            <h2>INVOICE</h2>
                                        </th>
                                    </tr>
                                    <tr>
                                        <th>Name</th>
                                        <td>{{ $order->name }}</td>
                                    </tr>
                                    <tr>
                                        <th>Email address</th>
                                        <td>{{ $order->email }}</td>
                                    </tr>
                                    <tr>
                                        <th>Phone Number</th>
                                        <td>{{ $order->phone }}</td>
                                    </tr>
                                    <tr>
                                        <th>Address</th>
                                        <td>{{ $order->address }}</td>
                                    </tr>
                                    <tr>
                                        <th>Message</th>
                                        <td>{{ $order->message }}</td>
                                    </tr>
                                    <tr>
                                        <th>Quantity of Product</th>
                                        <td>{{ $order->quantity }}</td>
                                    </tr>
                                    <tr>
                                        <th>Total Price</th>
                                        <td>Rp {{ number_format($order->total, 0, ',', '.') }}</td>
                                    </tr>
                                </table>
                                <button type="button" id="pay-button" class="mt-5 text-white btn btn-primary w-100">Pay
                                    Now</button>

                                {{-- Check Payment --}}
                                <a href="{{ url('order-payment/' . $order->code) }}"
                                    class="mt-3 text-center d-block">Check Payment</a>
                                <a href="{{ url('my-order') }}" class="mt-3 text-center d-block">Cancel</a>
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
    <script src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="{{ config('services.midtrans.client_key') }}"></script>
    <script type="text/javascript">
        document.getElementById('pay-button').addEventListener('click', function(e) {
            e.preventDefault();
            snap.pay('{{ $order->transaction_token }}', {
                onSuccess: function(result) {
                    document.getElementById('payment-form').submit();
                },
            });
        });
    </script>
@endsection
