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
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <h6 class="card-title">Total Produk</h6>
                                <div>
                                    <a class="btn btn-secondary" type="button" href="{{url('admin/product')}}">
                                        Detail
                                    </a>
                                </div>
                            </div>
                            <div class="mt-3">
                                <h3 class="mb-0">{{$totalProduk}}</h3>
                                <p class="text-muted">Products</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-7 p-0" style="margin-left: 10px">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <h6 class="card-title">Total Omset bulan ini</h6>
                                <div>
                                    <a class="btn btn-secondary" type="button" href="{{url('admin/omset')}}">
                                        Detail
                                    </a>
                                </div>
                            </div>
                            <div class="mt-3">
                                <h3 class="mb-0">Rp. {{ number_format($totalOmset, 0, ',', '.') }}</h3>
                                <p class="text-muted">Rupiah</p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
