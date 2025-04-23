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
            <h4 class="p-0 text-capitalize">{{ $dataPage['page'] }}</h4>
            <nav class="p-0 page-breadcrumb">
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
                <div class="p-0 col-md-12 grid-margin stretch-card">
                    <div class="card" style="background-color: rgba(255, 255, 255, 0.649);">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <h6 class="card-title text-capitalize">Table {{ $dataPage['page'] }}</h6>
                                {{-- <a href={{ url('admin/' . $dataPage['page'] . '/create') }} class="btn btn-primary">
                                    <i class="ti ti-plus me-2"></i>
                                    Add</a> --}}
                            </div>
                            <div class="table-responsive" style="min-height: 400px">

                                {{-- Table of Data --}}
                                <table class="table text-center" style="font-size: 12px;">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th class="text-start">Customer</th>
                                            <th>Product</th>
                                            <th>Message</th>
                                            <th>Status</th>
                                            <th>Quantity</th>
                                            <th>Total</th>
                                            <th>Code</th>
                                            {{-- <th>Action</th> --}}
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($orders as $item)
                                            <tr>
                                                <th>{{ $loop->iteration }}</th>
                                                <td style="text-align: left;">
                                                    <div>{{ $item->name }}</div>
                                                    <div>{{ $item->email }}</div>
                                                    <div>{{ $item->phone }}</div>
                                                    <div>{{ $item->address }}</div>
                                                </td>
                                                <td>
                                                    <div>{{ $item->product->name }}</div>
                                                    <div>{{ $item->product->category->name }}</div>
                                                </td>
                                                <td>{{ $item->message ?? '-' }}</td>
                                                <td>
                                                    @if ($item->status == 'pending')
                                                        <span class="badge bg-warning text-dark" style="font-size: 10px; width: 70px;">Pending</span>
                                                    @elseif ($item->status == 'success')
                                                        <span class="badge bg-success" style="font-size: 10px; width: 70px;">Success</span>
                                                    @elseif ($item->status == 'expired')
                                                        <span class="badge" style="font-size: 10px; width: 70px; background-color: rgb(205, 205, 205)">Expired</span>
                                                    @elseif ($item->status == 'failed')
                                                        <span class="badge bg-danger" style="font-size: 10px; width: 70px;">Failed</span>
                                                    @else
                                                        <span class="badge bg-light text-dark" style="font-size: 10px; width: 70px;">Unknown</span>
                                                    @endif
                                                </td>
                                                <td>{{ $item->quantity }}</td>
                                                <td>Rp {{ number_format($item->total, 0, ',', '.') }}</td>
                                                <td>{{ $item->code }}</td>
                                                {{-- <td>
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
                                                </td> --}}
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
