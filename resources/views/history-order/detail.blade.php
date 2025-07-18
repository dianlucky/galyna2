@extends('layout.user_layout') {{-- Sesuaikan dengan layout utama pengguna Anda --}}
<style>
    .star-rating {
        direction: rtl;
        display: inline-flex;
        font-size: 1.5rem;
    }

    .star-rating input[type="radio"] {
        display: none;
    }

    .star-rating label {
        color: #ccc;
        cursor: pointer;
        transition: color 0.2s;
    }

    .star-rating input[type="radio"]:checked~label {
        color: #ffc107;
    }

    .star-rating label:hover,
    .star-rating label:hover~label {
        color: #ffc107;
    }
</style>
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
                            <div>
                                @if ($order->status_order == 'packing')
                                    <span class="badge bg-warning text-white">Packing</span>
                                @elseif ($order->status_order == 'shipping')
                                    <span class="badge bg-warning">Shipping</span>
                                @else
                                    <span class="badge bg-secondary">{{ ucfirst($order->status_order) }}</span>
                                @endif
                            </div>
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
                                        <div class="col-md-8">
                                            <li class="list-group-item">
                                                <strong>Order #{{ $order->order_code }}</strong><br>
                                                Product: {{ optional($data->product)->name ?? 'N/A' }}
                                                ({{ $data->quantity }}x)
                                                <br>
                                                Total price : Rp
                                                {{ number_format($data->product->price, 0, ',', '.') }}
                                            </li>
                                        </div>
                                        <div class="col-md-2">
                                            <button type="button" class="btn btn-primary btn-sm text-white"
                                                data-bs-toggle="modal"
                                                data-bs-target="#comment{{ $data->product->id_product }}">Rate this
                                                product</button>
                                        </div>
                                        <!-- Modal -->
                                        <div class="modal fade" id="comment{{ $data->product->id_product }}" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <form
                                                    action={{ url('/history-order/comment/' . $data->product->id_product) }}
                                                    method="POST">
                                                    @csrf
                                                    <input type="hidden" name="id_product"
                                                        value="{{ $data->product->id_product }}">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Add Comment to
                                                                this product</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">

                                                            <div class="mb-3">
                                                                <label for="product_name" class="form-label">Product
                                                                    name</label>
                                                                <input type="text" class="form-control" id="product_name"
                                                                    name="product_name" value="{{ $data->product->name }}"
                                                                    readonly>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="product_price" class="form-label">Price</label>
                                                                <input type="text" class="form-control"
                                                                    id="product_price" name="product_price"
                                                                    value="Rp {{ number_format($data->product->price, 0, ',', '.') }}"
                                                                    readonly>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="rating" class="form-label">Rating</label>
                                                                <div class="star-rating">
                                                                    <input type="radio"
                                                                        id="star5{{ $data->product->id_product }}"
                                                                        name="rating" value="5" /><label
                                                                        for="star5{{ $data->product->id_product }}"
                                                                        title="5 stars">★</label>
                                                                    <input type="radio"
                                                                        id="star4{{ $data->product->id_product }}"
                                                                        name="rating" value="4" /><label
                                                                        for="star4{{ $data->product->id_product }}"
                                                                        title="4 stars">★</label>
                                                                    <input type="radio"
                                                                        id="star3{{ $data->product->id_product }}"
                                                                        name="rating" value="3" /><label
                                                                        for="star3{{ $data->product->id_product }}"
                                                                        title="3 stars">★</label>
                                                                    <input type="radio"
                                                                        id="star2{{ $data->product->id_product }}"
                                                                        name="rating" value="2" /><label
                                                                        for="star2{{ $data->product->id_product }}"
                                                                        title="2 stars">★</label>
                                                                    <input type="radio"
                                                                        id="star1{{ $data->product->id_product }}"
                                                                        name="rating" value="1" /><label
                                                                        for="star1{{ $data->product->id_product }}"
                                                                        title="1 star">★</label>
                                                                </div>
                                                            </div>

                                                            <div class="mb-3">
                                                                <label for="comment" class="form-label">Comment</label>
                                                                <textarea type="text" class="form-control" id="comment" min="1" name="comment" value=""
                                                                    required></textarea>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary text-white"
                                                                data-bs-dismiss="modal">Cancel</button>
                                                            <button type="submit"
                                                                class="btn btn-primary text-white">Save</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
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
                                <p style="margin-top: -10px"><span
                                        style="text-transform: uppercase">{{ $order->delivery->courier }}</span>
                                    {{ $order->delivery->delivery_type }}</p>
                            </div>
                            <div class="mb-1">
                                <label for="address-search" class="form-label">Estimated arrival by: </label>
                                <p style="margin-top: -10px">
                                    <strong>{{ $order->estimated_arrival }}</strong>
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
                                    <span>Rp. {{ number_format($order->delivery->delivery_cost, 0, ',', '.') }}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center fw-bold">
                                    Total payment
                                    <span>Rp
                                        {{ number_format($order->payment->amount, 0, ',', '.') }}
                                    </span>
                                </li>
                            </ul>
                            <p class="mt-3 text-muted small">Please be patient while your order is being processed.</p>
                            <div class="mt-2">
                                <button class="btn btn-primary text-white" data-bs-toggle="modal"
                                    data-bs-target="#modalAcceptance">I've received this package.</button>
                            </div>
                            <!-- Modal -->
                            <div class="modal fade" id="modalAcceptance" tabindex="-1"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <form action="{{ url('/history-order/update-status/' . $order->id_order) }}"
                                        method="POST">
                                        @csrf
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Are you sure?</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <h5 class="text-center">I’ve received the package and marked the order as
                                                    <span class="text-success">completed </span>.</h5>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary text-white"
                                                    data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary text-white">Save</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
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
