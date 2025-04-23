@use('Carbon\Carbon')
@extends('layout.user_layout')

@section('meta')
    <meta name="description" content="Your order history.">
    <meta name="keywords" content="orders, history, products">
    <meta property="og:title" content="My Orders">
    <meta property="og:description" content="View your past orders and their details.">
    <meta property="og:image" content="{{ asset('images/orders.png') }}">
    <meta property="og:url" content="{{ url('my-orders') }}">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="My Orders">
    <meta name="twitter:description" content="View your past orders and their details.">
    <meta name="twitter:image" content="{{ asset('images/orders.png') }}">
    <meta name="twitter:site" content="@GalynaHeiwa">
@endsection

@section('content')
    <section class="bg-motif-1" style="padding-top: 10vh; min-height: 92.7vh">
        <div class="container pt-3">
            <nav style="font-size: 12px; color: #999; margin-bottom: -5px;">
                <ol class="breadcrumb" style="background-color: transparent; padding: 0;">
                    <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ url('/') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">My Orders</li>
                </ol>
            </nav>

            <div class="product-search" style="padding: 0;">
                <div class="title-section" style="flex-grow: 1; min-width: 70%; margin: 0;">
                    <h1 class="m-0 fw-bold">My Orders</h1>
                    <p>View your past orders and their details.</p>
                </div>
            </div>
        </div>

        <div class="container pb-5 mt-4">
            <div class="mt-5 row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            @if ($orders->isEmpty())
                                <div class="py-5 text-center alert alert-warning" role="alert">
                                    <h1 class="charmonman-regular">No orders found.</h1>
                                </div>
                            @else
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">Order ID</th>
                                            <th scope="col">Product Name</th>
                                            <th scope="col">Quantity</th>
                                            <th scope="col">Total Price</th>
                                            <th scope="col">Order Date</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($orders as $order)
                                            <tr>
                                                <td>{{ $order->code }}</td>
                                                <td>{{ $order->product->name }}</td>
                                                <td>{{ $order->quantity }}</td>
                                                <td>Rp {{ number_format($order->total, 0, ',', '.') }}</td>
                                                <td>{{ Carbon::parse($order->created_at)->format('d F Y') }}</td>
                                                <td>
                                                    @if ($order->status == 'pending')
                                                        <span class="badge bg-warning text-dark">Pending</span>
                                                    @elseif ($order->status == 'success')
                                                        <span class="badge bg-success">Success</span>
                                                    @elseif ($order->status == 'failed')
                                                        <span class="badge bg-danger">Failed</span>
                                                    @elseif ($order->status == 'expired')
                                                        <span class="badge bg-secondary">Expired</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($order->status == 'pending')
                                                        <a href="{{url('order-payment/'.$order->code)}}" class="text-white btn btn-primary btn-sm">Pay Now</a>
                                                    @else
                                                        <a href="https://wa.me/1234567890?text=I%20have%20a%20question%20about%20my%20order%20{{ $order->code }}" class="text-white btn btn-success btn-sm">Contact Support</a>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('script')
    @include('components.notifications')
@endsection
