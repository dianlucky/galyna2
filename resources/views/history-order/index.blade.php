@extends('layout.user_layout') {{-- Sesuaikan dengan layout utama pengguna Anda --}}

@section('content')
    <section class="bg-motif-1" style="padding-top: 10vh; min-height: 92.7vh">
        <div class="container pt-3 pb-5">
            <nav style="font-size: 12px; color: #999; margin-bottom: -5px;">
                <ol class="breadcrumb" style="background-color: transparent; padding: 0;">
                    <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ url('/') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">History Order</li>
                </ol>
            </nav>

            <div class="title-section mb-4">
                <h1 class="m-0 fw-bold">My Order</h1>
                <p>
                    View your order history!
                </p>
            </div>

            <div class="mt-4">
                @if ($dataOrder->count() > 0)
                    <form id="selectOrdersForm">
                        @csrf
                        <div class="table-responsive">
                            <table class="table table-hover text-center" style="font-size: 14px;">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th class="text-start">Order Code</th>
                                        <th>Checkout date</th>
                                        <th>Expedition by</th>
                                        <th>Estimated Arrival</th>
                                        <th>Total Price</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($dataOrder as $data)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td class="text-start">{{ $data->order_code }}</td>
                                            <td>{{ $data->created_at->translatedFormat('l, d F Y') }}</td>
                                            <td><span style="text-transform: uppercase">{{$data->delivery->courier}}</span> {{ $data->delivery->delivery_type }}</td>
                                            <td>{{ $data->estimated_arrival }}</td>
                                            <td>Rp {{ number_format($data->payment->amount, 0, ',', '.') }}</td>
                                            <td>
                                                @if ($data->status_order == 'packing')
                                                    <span class="badge bg-secondary text-white">Packing</span>
                                                @elseif ($data->status_order == 'shipping')
                                                    <span class="badge bg-warning">Shipping</span>
                                                @else
                                                    <span class="badge bg-success">{{ ucfirst($data->status_order) }}</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{url('/history-order/'. $data->order_code)}}" class="btn btn-sm btn-primary text-white shadow-lg">Detail</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="d-flex justify-content-end p-3">
                            <button type="button" id="checkoutSelectedBtn" class="btn btn-info" disabled>
                                Checkout
                            </button>
                        </div>
                    </form>
                @else
                    <div class="py-5 text-center alert alert-info" role="alert">
                        <h1 class="charmonman-regular">You have no orders yet.</h1>
                        <p>Start by browsing our <a href="{{ url('/collection') }}">products</a>!</p>
                    </div>
                @endif
            </div>
        </div>
    </section>
@endsection

@section('script')
    @include('components.notifications')
@endsection
