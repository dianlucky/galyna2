@extends('layout.user_layout') {{-- Sesuaikan dengan layout utama pengguna Anda --}}

@section('content')
    @php
        use Carbon\Carbon;
        use Carbon\CarbonInterval;

        $tanggalSampai = Carbon::parse($dataOrder->updated_at)->add(CarbonInterval::make($dataOrder->estimated_day));
    @endphp
    <section class="bg-motif-1 pt-5" style="min-height: 92.7vh">
        <div class="container pb-5">
            <nav class="breadcrumb small text-muted bg-transparent px-0 mb-2">
                <a class="breadcrumb-item text-decoration-none" href="{{ url('/') }}">Home</a>
                <a class="breadcrumb-item text-decoration-none" href="{{ route('order.my') }}">My Orders</a>
                <span class="breadcrumb-item active">Checkout</span>
            </nav>

            <div class="title-section mb-4">
                <h1 class="m-0 fw-bold">Detail pesanan #{{ $dataOrder->code }}</h1>
                <p>Detail pesanan anda</p>

            </div>

            <div class="row">
                <div class="col-md-8">
                    <div class="card mb-4">
                        <div class=" d-flex justify-content-between card-header bg-primary text-white">
                            <p> Detail Pesanan</p>
                            <p>{{ Carbon::parse($dataOrder->updated_at)->translatedFormat('d F Y') }}</p>
                        </div>
                        <div class="card-body">
                            {{-- Tampilan untuk banyak order --}}
                            <h6 class="mb-3">Data Pesanan:</h6>

                            <ul class="list-group mb-3">
                                <div class="row mb-1">
                                    <div class="col-md-2 text-end">
                                        <img src="{{ asset('images/' . $dataOrder->product->cover_image) }}" class="rounded"
                                            style="height: 75px; width: 60px;" alt="{{ $dataOrder->product->name }}">
                                    </div>
                                    <div class="col-md-10">
                                        <li class="list-group-item">
                                            <strong>Order #{{ $dataOrder->code }}</strong><br>
                                            Produk: {{ optional($dataOrder->product)->name ?? 'N/A' }}
                                            ({{ $dataOrder->quantity }}x)
                                            <br>
                                            Harga produk : Rp
                                            {{ number_format($dataOrder->total / $dataOrder->quantity, 0, ',', '.') }}
                                        </li>
                                    </div>
                                </div>
                            </ul>
                            <p class="fw-bold">Total Harga Produk Keseluruhan: Rp
                                {{ number_format($dataOrder->total, 0, ',', '.') }}
                            </p>
                        </div>
                    </div>

                    <div class="card mb-4">
                        <div class="card-header bg-info text-white">
                            Informasi Pengiriman
                        </div>
                        <div class="card-body">
                            @csrf
                            {{-- Input pencarian alamat --}}
                            <div class="mb-1">
                                <label for="address-search" class="form-label">Alamat Pengiriman : </label>
                                <p style="margin-top: -10px"><strong>{{ $dataOrder->address }}</strong></p>
                            </div>
                            <div class="mb-1">
                                <label for="address-search" class="form-label">Nomor penerima : </label>
                                <p style="margin-top: -10px"><strong>{{ $dataOrder->phone }}</strong></p>
                            </div>

                            <div class="mb-1">
                                <label for="address-search" class="form-label">Kurir : </label>
                                <p style="margin-top: -10px"><strong>{{ $dataOrder->courier }}</strong></p>
                            </div>


                            <div class="mb-1">
                                <label for="address-search" class="form-label">Perkiraan sampai: </label>
                                <p style="margin-top: -10px">
                                    <strong>{{ $tanggalSampai->translatedFormat('d F Y') }}</strong>
                                </p>
                            </div>

                        </div>
                    </div>


                </div>

                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Ringkasan Pembayaran</h5>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Total Harga Produk
                                    <span>Rp <span id="summaryProductTotal">
                                            {{ number_format(isset($dataOrder) ? $dataOrder->total : $grandTotal, 0, ',', '.') }}
                                        </span></span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center"
                                    style="display: none;">
                                    Biaya Pengiriman
                                    <span>Rp.  {{ number_format($dataOrder->delivery_cost, 0, ',', '.') }}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center fw-bold">
                                    Total Bayar
                                    <span>Rp 
                                        {{ number_format($dataOrder->delivery_cost + $dataOrder->total, 0, ',', '.') }}
                                       </span>
                                </li>
                            </ul>
                            <p class="mt-3 text-muted small">Harap untuk bersabar dalam menunggu proses pengiriman</p>
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
