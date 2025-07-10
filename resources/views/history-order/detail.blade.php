@extends('layout.user_layout') {{-- Sesuaikan dengan layout utama pengguna Anda --}}

@section('content')
    <section class="bg-motif-1 pt-5" style="min-height: 92.7vh">
        <div class="container pb-5">
            <nav class="breadcrumb small text-muted bg-transparent px-0 mb-2">
                <a class="breadcrumb-item text-decoration-none" href="{{ url('/') }}">Home</a>
                <a class="breadcrumb-item text-decoration-none" href="{{ url('/history-order') }}">My Order History</a>
                <span class="breadcrumb-item active">detail</span>
            </nav>

            <div class="title-section mb-4">
                <h1 class="m-0 fw-bold">Detail order #{{ $order->order_code }}</h1>
                <p>Your order details</p>

            </div>

            <div class="row">
                <div class="col-md-8">
                    <div class="card mb-4">
                        <div class=" d-flex justify-content-between card-header bg-primary text-white">
                            <h5><strong>Order detail</strong></h5>
                            {{-- <p>{{ Carbon::parse($dataOrder->updated_at)->translatedFormat('d F Y') }}</p> --}}
                        </div>
                        <div class="card-body">
                            <h6 class="mb-3">Detail product:</h6>
                            @foreach ($detailOrders as $data)
                            <ul class="list-group mb-3">
                                <div class="row mb-1">
                                    <div class="col-md-2 text-end">
                                        <img src="{{ asset('images/' . $data->product->cover_image) }}" class="rounded"
                                            style="height: 75px; width: 60px;" alt="{{ $data->product->name }}">
                                    </div>
                                    <div class="col-md-10">
                                        <li class="list-group-item">
                                            <strong>Order #{{ $order->order_code }}</strong><br>
                                            Product: {{ optional($data->product)->name ?? 'N/A' }}
                                            ({{ $data->quantity }}x)
                                            <br>
                                            Total price : Rp
                                            {{ number_format($data->product->price , 0, ',', '.') }}
                                        </li>
                                    </div>
                                </div>
                            </ul>
                            @endforeach

                            <p class="fw-bold">Total price of all product: Rp
                                {{ number_format($order->payment->amount - $order->delivery->delivery_cost, 0, ',', '.') }}
                            </p>
                        </div>
                    </div>

                    <div class="card mb-4">
                        <div class="card-header bg-info text-white">
                          <h5><strong>Delivery Information</strong></h5> 
                        </div>
                        <div class="card-body">
                            @csrf
                            {{-- Input pencarian alamat --}}
                            <div class="mb-1">
                                <label for="address-search" class="form-label">Recipient's name : </label>
                                <p style="margin-top: -10px"><strong>{{ $order->user->name }}</strong></p>
                            </div>
                            <div class="mb-1">
                                <label for="address-search" class="form-label">Delivery address : </label>
                                <p style="margin-top: -10px"><strong>{{ $order->delivery->destination }}</strong></p>
                            </div>
                        
                            <div class="mb-1">
                                <label for="address-search" class="form-label">Expedition by : </label>
                                <p style="margin-top: -10px"><span style="text-transform: uppercase">{{ $order->delivery->courier }}</span> {{$order->delivery->delivery_type}}</p>
                            </div>
                            <div class="mb-1">
                                <label for="address-search" class="form-label">Estimated arrival by: </label>
                                <p style="margin-top: -10px">
                                    <strong>{{ $order->estimated_arrival}}</strong>
                                </p>
                            </div>

                        </div>
                    </div>


                </div>

                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Payment Information</h5>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Total price of all product
                                    <span>Rp <span id="summaryProductTotal">
                                            {{ number_format($order->payment->amount - $order->delivery->delivery_cost, 0, ',', '.') }}
                                        </span></span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center"
                                    style="display: none;">
                                    Delivery cost
                                    <span>Rp.  {{ number_format($order->delivery->delivery_cost, 0, ',', '.') }}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center fw-bold">
                                    Total payment
                                    <span>Rp 
                                        {{ number_format($order->payment->amount, 0, ',', '.') }}
                                       </span>
                                </li>
                            </ul>
                            <p class="mt-3 text-muted small">Please be patient while your order is being processed.</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection

@section('script')
    @parent {{-- Penting: panggil @parent untuk menjaga script dari layout utama --}}
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}">
    </script>
@endsection
