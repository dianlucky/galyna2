@extends('layout.admin_layout') 

@php
    $dataPage = [
        'page' => 'omset', 
    ];
@endphp

{{-- Content --}}
@section('content')
    <section class="ps-3">

        {{-- Header Page --}}
        <div class="row ps-lg-3 ps-sm-0">
            {{-- Menggunakan judul yang lebih spesifik untuk "My Order" --}}
            <h4 class="p-0 text-capitalize">Omset</h4>
            <nav class="p-0 page-breadcrumb">
                <ol class="breadcrumb">
                    {{-- Sesuaikan link breadcrumb jika ini bukan halaman admin --}}
                    <li class="breadcrumb-item"><a href="{{ url('/omset') }}"
                            class="text-capitalize">Omset</a></li> {{-- Menggunakan '/my-order' sebagai base --}}
                    <li class="breadcrumb-item active text-capitalize" aria-current="page">Semua</li>
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
                                <h6 class="card-title text-capitalize">Omset bulanan</h6>
                             
                            </div>
                            <div class="table-responsive" style="min-height: 400px">

                                {{-- Table of Data --}}
                                <table class="table text-center" style="font-size: 15px;">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Bulan</th>
                                            <th>Total produk yang dipesan</th> 
                                            <th class="text-end">Total omset</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($totalOmsetBulanan as $data) 
                                            <tr>
                                                <th>{{ $loop->iteration }}</th>
                                                <td>{{ \Carbon\Carbon::createFromFormat('Y-m', $data->bulan)->translatedFormat('F Y') }}</td>
                                                <td>{{ $data->totalProduk }}</td>
                                                <td class="text-end">Rp {{ number_format($data->totalOmset, 0, ',', '.') }}</td>
                                               
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="8">Data tidak ditemukan.</td> 
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