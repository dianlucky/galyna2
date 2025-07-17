@extends('layout.admin_layout')
@section('content')
    <section>

        {{-- Header Page --}}
        <div class="row ps-lg-3 ps-sm-0">
            <h4 class="p-0">Detail pesanan #{{ $dataOrder->order_code }}</h4>
            <nav class="page-breadcrumb p-0">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('admin/order') }}">Pesanan</a></li>
                    <li class="breadcrumb-item active" aria-current="page">detail pesanan</li>
                </ol>
            </nav>
        </div>

        {{-- Main --}}
        <div class="ps-lg-3 ps-sm-0">
            <div class="row ">
                {{-- Card --}}
                <div class="col-md-6 p-0">
                    <div class="card mb-4">
                        <div class=" d-flex justify-content-between card-header bg-primary text-white">
                            <h5><strong>Order detail</strong></h5>
                            {{-- <p>{{ Carbon::parse($dataOrder->updated_at)->translatedFormat('d F Y') }}</p> --}}
                            <div>
                                @if ($dataOrder->status_order == 'packing')
                                    <span class="badge bg-warning text-white">Packing</span>
                                @elseif ($dataOrder->status == 'shipping')
                                    <span class="badge bg-warning">Shipping</span>
                                @else
                                    <span class="badge bg-secondary">{{ ucfirst($data->status) }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="card-body">
                            <h6 class="mb-3">Detail produk:</h6>
                            @foreach ($detailOrders as $data)
                                <ul class="list-group mb-3">
                                    <div class="row mb-1">
                                        <div class="col-md-2 text-end">
                                            <img src="{{ asset('images/' . $data->product->cover_image) }}" class="rounded"
                                                style="height: 75px; width: 60px;" alt="{{ $data->product->name }}">
                                        </div>
                                        <div class="col-md-10">
                                            <li class="list-group-item">
                                                <strong>Order #{{ $dataOrder->order_code }}</strong><br>
                                                Product: {{ optional($data->product)->name ?? 'N/A' }}
                                                ({{ $data->quantity }}x)
                                                <br>
                                                Total price : Rp
                                                {{ number_format($data->product->price, 0, ',', '.') }}
                                            </li>
                                        </div>
                                    </div>
                                </ul>
                            @endforeach

                            <p class="fw-bold">Total harga dari semua produk : Rp
                                {{ number_format($dataOrder->payment->amount - $dataOrder->delivery->delivery_cost, 0, ',', '.') }}
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-5 p-0" style="margin-left: 10px">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Informasi pembayaran</h5>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Total harga dari semua produk
                                    <span>Rp <span id="summaryProductTotal">
                                            {{ number_format($dataOrder->payment->amount - $dataOrder->delivery->delivery_cost, 0, ',', '.') }}
                                        </span></span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center"
                                    style="display: none;">
                                    Biaya pengiriman
                                    <span>Rp. {{ number_format($dataOrder->delivery->delivery_cost, 0, ',', '.') }}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center fw-bold">
                                    Total yang perlu dibayar
                                    <span>Rp
                                        {{ number_format($dataOrder->payment->amount, 0, ',', '.') }}
                                    </span>
                                </li>
                            </ul>
                            {{-- <p class="mt-3 text-muted small"></p> --}}
                            <div class="d-flex justify-content-end mt-3">
                                {{-- <form action="{{ url('/admin/order/update-status/' . $dataOrder->id_order) }}"
                                    method="POST">
                                    @csrf
                                    @method('PUT') --}}
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal">Ubah status pesanan</button>
                                {{-- </form> --}}
                            </div>
                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog">
                                    <form action="{{ url('/admin/order/update-status/' . $dataOrder->id_order) }}"
                                        method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Ubah status pesanan</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label for="resi" class="form-label">No Resi</label>
                                                    <input type="text" class="form-control" id="resi" name="resi"
                                                        placeholder="Masukkan nomor resi" @error('resi') error @enderror
                                                        value="{{ old('resi', $product->resi ?? '') }}">
                                                    @error('resi')
                                                        <span class="error-message">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Batal</button>
                                                <button type="submit" class="btn btn-primary">Ubah status</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="row ">
                {{-- Card --}}
                <div class="col-md-6 p-0">
                    <div class="card mb-4">
                        <div class="card-header bg-info text-white">
                            <h5><strong>Informasi pengiriman</strong></h5>
                        </div>
                        <div class="card-body">
                            @csrf
                            {{-- Input pencarian alamat --}}
                            <div class="mb-1">
                                <label for="address-search" class="form-label">Nama penerima : </label>
                                <p style="margin-top: -10px"><strong>{{ $dataOrder->user->name }}</strong></p>
                            </div>
                            <div class="mb-1">
                                <label for="address-search" class="form-label">Alamat pengiriman: </label>
                                <p style="margin-top: -10px"><strong>{{ $dataOrder->delivery->destination }}</strong></p>
                            </div>

                            <div class="mb-1">
                                <label for="address-search" class="form-label">Ekspedisi : </label>
                                <p style="margin-top: -10px"><span
                                        style="text-transform: uppercase">{{ $dataOrder->delivery->courier }}</span>
                                    {{ $dataOrder->delivery->delivery_type }}</p>
                            </div>
                            <div class="mb-1">
                                <label for="address-search" class="form-label">Perkiraan sampai: </label>
                                <p style="margin-top: -10px">
                                    <strong>{{ $dataOrder->estimated_arrival }}</strong>
                                </p>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
