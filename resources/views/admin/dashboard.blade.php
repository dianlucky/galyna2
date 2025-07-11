@extends('layout.admin_layout')
@section('content')
    <section>

        {{-- Header Page --}}
        <div class="row ps-lg-3 ps-sm-0">
            <h4 class="p-0">Dashboard</h4>
            <nav class="page-breadcrumb p-0">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Analytics</li>
                </ol>
            </nav>
        </div>

        {{-- Main --}}
        <div class="ps-lg-3 ps-sm-0">
            <div class="row ">
                {{-- Card --}}
                <div class="col-md-4 p-0">
                    <div class="card">
                        <div class="card-body" style="background-color: #FFE8B6; border-radius: 10px;">
                            <div class="d-flex justify-content-between align-items-center">
                                <h6 class="card-title fw-bolder">Total produk yang terjual</h6>
                                <div>
                                    <a class="btn btn-secondary btn-sm" type="button" href="{{ url('admin/product') }}">
                                        Detail
                                    </a>
                                </div>
                            </div>
                            <div class="mt-3">
                                <h3 class="mb-0 fw-bolder">{{ number_format($totalProduk, 0, ',', '.') }}</h3>
                                <p class="text-muted">Products</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-7 p-0" style="margin-left: 10px">
                    <div class="card">
                        <div class="card-body" style="background-color: #A4B465; border-radius: 10px;">
                            <div class="d-flex justify-content-between align-items-center">
                                <h6 class="card-title fw-bolder">Total Omset bulan ini</h6>
                                <div>
                                    <a class="btn btn-secondary btn-sm" type="button" href="{{ url('admin/omset') }}">
                                        Detail
                                    </a>
                                </div>
                            </div>
                            <div class="mt-3">
                                <h3 class="mb-0 fw-bolder">Rp. {{ number_format($totalOmset, 0, ',', '.') }}</h3>
                                <p class="text-muted">Rupiah</p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="row ">
                {{-- Card --}}
                <div class="col-md-7 p-0">
                    <div class="row">
                        <div class="col-md-7">
                            <div class="card">
                                <div class="card-body " style="background-color: #FFB22C; border-radius: 10px;">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <h6 class="text-white fw-bolder">Pesanan belum selesai</h6>
                                        <div>
                                            <a class="btn btn-secondary btn-sm" type="button"
                                                href="{{ url('admin/product') }}">
                                                Detail
                                            </a>
                                        </div>
                                    </div>
                                    <div class="mt-3">
                                        <h3 class="mb-0 text-white fw-bolder">{{ $totalProduk }}</h3>
                                        <p class="text-muted text-white">Pesanan</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5 "  style="margin-left: -15px">
                            <div class="card">
                                <div class="card-body " style="background-color: #5B913B; border-radius: 10px;">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <h6 class="text-white fw-bolder">Pesanan selesai</h6>
                                        <div>
                                            <a class="btn btn-secondary btn-sm" type="button"
                                                href="{{ url('admin/product') }}">
                                                Detail
                                            </a>
                                        </div>
                                    </div>
                                    <div class="mt-3">
                                        <h3 class="mb-0 text-white fw-bolder">{{ $totalProduk }}</h3>
                                        <p class="text-muted text-white">Pesanan</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-md-4 p-0" style="margin-left: 10px">
                    {{-- <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <h6 class="card-title">Total Omset bulan ini</h6>
                                <div>
                                    <a class="btn btn-secondary btn-sm" type="button" href="{{ url('admin/omset') }}">
                                        Detail
                                    </a>
                                </div>
                            </div>
                            <div class="mt-3">
                                <h3 class="mb-0">Rp. {{ number_format($totalOmset, 0, ',', '.') }}</h3>
                                <p class="text-muted">Rupiah</p>
                            </div>
                        </div>
                    </div> --}}
                </div>

            </div>
        </div>
    </section>
@endsection
