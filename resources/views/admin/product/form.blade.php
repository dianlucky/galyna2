@extends('layout.admin_layout')
@section('content')
    <div>
        <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('product') }}">Produk</a></li>
                <li class="breadcrumb-item active" aria-current="page">Data Produk</li>
                <li class="breadcrumb-item active" aria-current="page">Tambah Produk</li>
            </ol>
        </nav>

        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <h6 class="card-title">Tambah Data Produk</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
