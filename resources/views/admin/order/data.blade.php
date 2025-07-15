@extends('layout.admin_layout') 

@php
    $dataPage = [
        'page' => 'order', 
    ];
@endphp

{{-- Content --}}
@section('content')
    <section class="ps-3">

        {{-- Header Page --}}
        <div class="row ps-lg-3 ps-sm-0">
            {{-- Menggunakan judul yang lebih spesifik untuk "My Order" --}}
            <h4 class="p-0 text-capitalize">Daftar Pesanan {{$data['status']}}</h4>
            <nav class="p-0 page-breadcrumb">
                <ol class="breadcrumb">
                    {{-- Sesuaikan link breadcrumb jika ini bukan halaman admin --}}
                    <li class="breadcrumb-item"><a href="{{ url('/admin') }}"
                            class="text-capitalize">Pesanan</a></li> {{-- Menggunakan '/my-order' sebagai base --}}
                    <li class="breadcrumb-item active text-capitalize" aria-current="page">Daftar pesanan {{$data['status']}}</li>
                </ol>
            </nav>
        </div>

        {{-- Main Content --}}
        <main id="contents" class="ps-lg-3 ps-sm-0">
            <div class="row">
                <div class="p-0 col-md-12 grid-margin stretch-card">
                    <div class="card" style="background-color: rgba(255, 255, 255, 0.649);">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                {{-- Judul tabel yang lebih spesifik --}}
                                <h6 class="card-title text-capitalize">Daftar pesanan {{$data['status']}}</h6>
                             
                            </div>
                            <div class="table-responsive" style="min-height: 400px">

                                {{-- Table of Data --}}
                                <table class="table text-center" style="font-size: 12px;">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Kode Order</th>
                                            <th>Tanggal pesan</th>
                                            <th>Total harga barang</th>
                                            <th>Ekspedisi</th>
                                            <th>Biaya ongkir</th>
                                            <th>Total bayar</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($orders as $item) {{-- Menggunakan @forelse untuk handle jika tidak ada order --}}
                                            <tr>
                                                <th>{{ $loop->iteration }}</th>
                                                <td>{{ $item->order_code}}</td>
                                                <td>{{ $item->created_at}}</td>
                                                <td>Rp {{ number_format($item->payment->amount - $item->delivery->delivery_cost, 0, ',', '.') }}</td>
                                                <td>{{ $item->delivery->courier . ' ' .$item->delivery->delivery_type}}</td>
                                                <td>Rp {{ number_format($item->delivery->delivery_cost, 0, ',', '.') }}</td>
                                                <td>Rp {{ number_format($item->payment->amount, 0, ',', '.') }}</td>
                                                <td>
                                                    @if ($item->status_order == 'packing')
                                                        <span class="badge bg-warning text-white" style="font-size: 10px; width: 70px;">Packing</span>
                                                    @elseif ($item->status_order == 'shipping')
                                                        <span class="badge bg-warning text-white"  style="font-size: 10px; width: 70px;">Shipping</span>
                                                    @elseif ($item->status_order == 'done')
                                                        <span class="badge bg-success text-white"  style="font-size: 10px; width: 70px;">Done</span>
                                                    @else
                                                        <span class="badge bg-light text-dark" style="font-size: 10px; width: 70px;">Unknown</span>
                                                    @endif
                                                </td>
                                                {{-- Kolom Action dikomentari --}}
                                                <td>
                                                    <div class="dropdown">
                                                        <button class="btn btn-secondary dropdown-toggle" type="button"
                                                            data-bs-toggle="dropdown" aria-expanded="false">
                                                            Action
                                                        </button>
                                                        <ul class="dropdown-menu">
                                                            <li>
                                                                <form action="" method="POST">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <input type="hidden" name="id"
                                                                        value={{ $item->id_order }}>
                                                                    <button type="submit"
                                                                        class="dropdown-item">Delete</button>
                                                                </form>
                                                            </li>
                                                            <li><a class="dropdown-item"
                                                                    href={{ url('admin/order/edit/' . $item->id_order) }}>Edit</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="8">No orders found.</td> {{-- Kolom disesuaikan jika tidak ada order --}}
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                                {{-- End Of Table --}}

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        {{-- End Of Main Content --}}

    </section>
@endsection

@section('script')
    {{-- Ini akan menginclude notifikasi jika ada (misalnya dari with('success', 'Order berhasil dibuat!')) --}}
    @include('components.notifications')
@endsection