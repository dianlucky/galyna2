@extends('layout.admin_layout')

@php
    $dataPage = [
        'page' => 'promo',
    ];
@endphp

{{-- Content --}}
@section('content')
    <section class="ps-3">

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
        <main id="contents" class="ps-lg-3 ps-sm-0">
            <div class="row">
                <div class="col-md-12 grid-margin stretch-card p-0">
                    <div class="card" style="background-color: rgba(255, 255, 255, 0.649);">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <h6 class="card-title text-capitalize">Table {{ $dataPage['page'] }}</h6>
                                <a href={{ url('admin/promo/create') }} class="btn btn-primary">
                                    <i class="ti ti-plus me-2"></i>
                                    Tambah</a>
                            </div>
                            <div class="table-responsive" style="min-height: 400px">

                                {{-- Table of Data --}}
                                <table class="table text-center">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama promo</th>
                                            <th>Nama produk</th>
                                            <th class="text-end">Harga produk</th>
                                            <th class="text-end">Jumlah potongan</th>
                                            <th class="text-end">Harga akhir produk</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($promo as $data)
                                            @php
                                                if ($data->type == 'persen') {
                                                    $discountValue = ($data->product->price * $data->amount) / 100;
                                                } else {
                                                    $discountValue = $data->amount;
                                                }
                                            @endphp
                                            <tr>
                                                <th>{{ $loop->iteration }}</th>
                                                <td>{{ $data->name }}</td>
                                                <td>{{ $data->product->name }}</td>
                                                <td class="text-end">Rp.
                                                    {{ number_format($data->product->price, 0, ',', '.') }} </td>
                                                <td class="text-end">
                                                    {{ $data->type == 'persen' ? $data->amount . '%' : 'Rp.' . number_format($discountValue, 0, ',', '.') }}
                                                </td>
                                                <td class="text-end">Rp.
                                                    {{ number_format($data->product->price - $discountValue, 0, ',', '.') }}
                                                </td>
                                                <td>
                                                    @if ($data->status == 'active')
                                                        <span class="badge bg-success text-white"
                                                            style="font-size: 10px; width: 70px;">Aktif</span>
                                                    @elseif ($data->status == 'inactive')
                                                        <span class="badge bg-warning text-white"
                                                            style="font-size: 10px; width: 70px;">Tidak Aktif</span>
                                                    @else
                                                        <span class="badge bg-light text-dark"
                                                            style="font-size: 10px; width: 70px;">Unknown</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="dropdown">
                                                        <button class="btn btn-secondary dropdown-toggle" type="button"
                                                            data-bs-toggle="dropdown" aria-expanded="false">
                                                            Action
                                                        </button>
                                                        <ul class="dropdown-menu">
                                                            <li>
                                                                <form action="{{url('/admin/promo')}}" method="POST">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <input type="hidden" name="id"
                                                                        value={{ $data->id_promo }}>
                                                                    <button type="submit"
                                                                        class="dropdown-item">Delete</button>
                                                                </form>
                                                            </li>
                                                            <li><a class="dropdown-item"
                                                                    href={{ url('admin/promo/edit/' . $data->id_promo) }}>Edit</a>
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
