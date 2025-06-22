@extends('layout.user_layout') {{-- Sesuaikan dengan layout utama pengguna Anda --}}

@section('content')
<section class="bg-motif-1 pt-5" style="min-height: 92.7vh">
    <div class="container pb-5">
        <nav class="breadcrumb small text-muted bg-transparent px-0 mb-2">
            <a class="breadcrumb-item text-decoration-none" href="{{ url('/') }}">Home</a>
            <a class="breadcrumb-item text-decoration-none" href="{{ route('order.my') }}">My Orders</a>
            <span class="breadcrumb-item active">Order Detail</span>
        </nav>

        <div class="title-section mb-4">
            <h1 class="m-0 fw-bold">Detail Pesanan #{{ $order->code }}</h1>
            <p>Informasi lengkap mengenai pesanan Anda.</p>
        </div>

        <div class="row">
            <div class="col-md-8">
                <div class="card mb-4">
                    <div class="card-header bg-primary text-white">
                        Informasi Pesanan
                    </div>
                    <div class="card-body">
                        <p><strong>Produk:</strong> {{ optional($order->product)->name ?? 'N/A' }}</p>
                        <p><strong>Jumlah:</strong> {{ $order->quantity }}</p>
                        <p><strong>Total Harga Produk:</strong> Rp {{ number_format($order->total, 0, ',', '.') }}</p>
                        <p><strong>Status:</strong> 
                            @if ($order->status == 'pending')
                                <span class="badge bg-warning text-dark">Pending</span>
                            @elseif ($order->status == 'waiting_payment')
                                <span class="badge bg-info">Waiting Payment</span>
                            @elseif ($order->status == 'success')
                                <span class="badge bg-success">Success</span>
                            @elseif ($order->status == 'failed')
                                <span class="badge bg-danger">Failed</span>
                            @else
                                <span class="badge bg-secondary">{{ ucfirst($order->status) }}</span>
                            @endif
                        </p>
                        <p><strong>Kode Pesanan:</strong> {{ $order->code }}</p>
                        <p><strong>Tanggal Pesanan:</strong> {{ $order->created_at->format('d M Y H:i') }}</p>
                        <p><strong>Nama Penerima:</strong> {{ $order->name }}</p>
                        <p><strong>Email:</strong> {{ $order->email }}</p>
                        <p><strong>Telepon:</strong> {{ $order->phone }}</p>
                        <p><strong>Alamat:</strong> {{ $order->address }}</p>
                        <p><strong>Pesan:</strong> {{ $order->message ?? '-' }}</p>

                        {{-- Tombol Hapus/Cancel di halaman Detail Pesanan --}}
                        @if ($order->status == 'pending' || $order->status == 'waiting_payment')
                            <hr>
                            <form action="{{ route('order.cancel', $order->id_order) }}" method="POST" class="d-inline">
                                @csrf
                                @method('PUT') {{-- Menggunakan PUT untuk update status --}}
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin membatalkan pesanan ini?')">Batalkan Pesanan</button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                {{-- Kolom samping untuk informasi tambahan atau iklan --}}
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Ringkasan</h5>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Total Harga Produk
                                <span>Rp {{ number_format($order->total, 0, ',', '.') }}</span>
                            </li>
                            {{-- Jika ada biaya pengiriman yang sudah dibayar, bisa ditampilkan di sini --}}
                            {{-- <li class="list-group-item d-flex justify-content-between align-items-center">
                                Biaya Pengiriman
                                <span>Rp {{ number_format($order->shipping_cost ?? 0, 0, ',', '.') }}</span>
                            </li> --}}
                            <li class="list-group-item d-flex justify-content-between align-items-center fw-bold">
                                Total Bayar
                                <span>Rp {{ number_format($order->total, 0, ',', '.') }}</span>
                            </li>
                        </ul>
                        <p class="mt-3 text-muted small">Informasi ini adalah ringkasan pesanan Anda.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
