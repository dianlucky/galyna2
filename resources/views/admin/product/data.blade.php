@extends('layout.admin_layout')

@php
    $dataPage = [
        'page' => 'product',
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
                    <li class="breadcrumb-item active text-capitalize" aria-current="page">Table {{ $dataPage['page'] }}</li>
                </ol>
            </nav>
        </div>

        {{-- Main Content --}}
        <main id="contents" class="ps-sm-0">
            <div class="d-flex justify-content-between align-items-center">
                <form action="" method="GET">
                    <div class="input-group mb-3">
                        <input name="query" value="{{ request()->get('query') ?? '' }}" type="text"
                            class="form-control" placeholder="Search Product" aria-label="Search Product"
                            aria-describedby="button-addon2">
                        <button class="btn btn-primary text-white" type="submit" id="button-addon2">
                            <i class="ti ti-search"></i>
                        </button>
                    </div>
                </form>
                <a href={{ url('admin/' . $dataPage['page'] . '/create') }} class="btn btn-primary">
                    <i class="ti ti-plus me-2"></i>
                    Add</a>
            </div>
            <div class="row px-2" style="min-width: 100%">
                @foreach ($products as $item)
                    <div class="col-6 col-sm-6 col-md-3 col-lg-2 p-1">
                        <div class="card-product">

                            {{-- Card Image --}}
                            <div class="card-img">
                                <img src={{ asset('images/' . $item->cover_image) }} alt={{ $item->name }}>
                            </div>

                            {{-- Edit button --}}
                            <div class="edit-product-btn dropdown">
                                <button class="btn text-white dropdown-toggl" type="button" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    <i class="ti ti-settings"></i>
                                </button>
                                <div class="dropdown-menu" style="font-size: 15px; ">
                                    <div style="p-0">
                                        <a class="dropdown-item"
                                            href={{ url('admin/' . $dataPage['page'] . '/edit/' . $item->id_product) }}>
                                            <i class="ti ti-pencil me-3"></i>
                                            Edit
                                        </a>
                                        <form action="{{ url('admin/' . $dataPage['page']) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <input type="hidden" name="id" value={{ $item->id_product }}>
                                            <button type="submit" class="dropdown-item">
                                                <i class="ti ti-trash me-3"></i>
                                                Hapus
                                            </button>

                                        </form>
                                        {{-- <a class="dropdown-item"
                                            href={{ url('admin/' . $dataPage['page'] . '/edit/' . $item->id_product) }}>
                                            <i class="ti ti-trash me-3"></i>
                                            Hapus
                                        </a> --}}
                                    </div>
                                </div>
                            </div>

                            {{-- Card Label --}}
                            <div class="card-label">
                                <div class="mb-1">
                                    <span class="badge p-1" style="background-color: rgb(255, 129, 181); font-size: 10px">
                                        <i class="ti ti-heart"></i>
                                        {{ $item->rating }}
                                    </span>
                                    @if ($item->is_new)
                                        <span class="badge bg-primary p-1"
                                            style="background-color: rgb(255, 129, 181);font-size: 10px">
                                            New
                                        </span>
                                    @endif
                                </div>
                                <h6 class="m-0" style="font-size: 12px; color: white;">{{ $item->name }}</h6>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </main>
        {{-- End Of Main Content --}}

    </section>
@endsection

@section('script')
    @include('components.notifications')
@endsection
