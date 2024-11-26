@extends('layout.admin_layout')
@section('content')
    <section class="ps-3">

        {{-- Header Page --}}
        <div class="row">
            <h4 class="p-0">Dashboard</h4>
            <nav class="page-breadcrumb p-0">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Analytics</li>
                </ol>
            </nav>
        </div>

        {{-- Main --}}
        <div>
            <div class="row">
                Selamat Datang Bos
            </div>
        </div>
    </section>
@endsection
