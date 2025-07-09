@extends('layout.admin_layout')

@php
    $dataPage = [
        'page' => 'Link',
    ];
@endphp

{{-- Content --}}
@section('content')
    <section class="ps-0 ps-md-3">

        {{-- Header Page --}}
        <div class="row ps-lg-3 ps-sm-0">
            <h4 class="p-0 text-capitalize">{{ $dataPage['page'] }}</h4>
            <nav class="page-breadcrumb p-0">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('admin/' . $dataPage['page']) }}"
                            class="text-capitalize">{{ $dataPage['page'] }}</a></li>
                    <li class="breadcrumb-item active text-capitalize" aria-current="page">Tabel {{ $dataPage['page'] }}</li>
                </ol>
            </nav>
        </div>

        {{-- Main Content --}}
        <main id="contents" class="ps-lg-3 ps-sm-0">
            <div class="row">
                <div class="col-md-12 grid-margin stretch-card p-0">
                    <div class="card" style="background-color: rgba(255, 255, 255, 0.649);">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <h6 class="card-title text-capitalize">Table {{ $dataPage['page'] }}</h6>
                                <a href={{ url('admin/links/create') }} class="btn btn-primary">
                                    <i class="ti ti-plus me-2"></i>
                                    Tambah</a>
                            </div>
                            <div class="table-responsive" style="min-height: 400px">

                                {{-- Table of Data --}}
                                <table class="table text-center">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Link</th>
                                            <th>Link</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($links as $item)
                                            <tr>
                                                <th>{{ $loop->iteration }}</th>
                                                <td>{{ $item->name }}</td>
                                                <td><a target="_blank" href="{{ $item->link }}">{{ $item->link }}</a> </td>
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
                                                                        value={{ $item->id_link }}>
                                                                    <button type="submit"
                                                                        class="dropdown-item">Delete</button>
                                                                </form>
                                                            </li>
                                                            <li><a class="dropdown-item"
                                                                    href={{ url('admin/links/edit/' . $item->id_link) }}>Edit</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
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
    @include('components.notifications')
@endsection
