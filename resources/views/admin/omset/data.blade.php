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
            <h4 class="p-0 text-capitalize">Omset</h4>
            <nav class="p-0 page-breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('/omset') }}" class="text-capitalize">Omset</a></li>
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
                            <div class="row">
                                <div class="col-md-8">
                                    <h6 class="card-title text-capitalize">Omset bulanan</h6>
                                </div>
                                <div class="col-md-4">
                                    <div class="input-group">
                                        <input type="text" class="form-control @error('title') is-invalid @enderror"
                                            id="title" name="name" placeholder="Cari berdasarkan bulan..."
                                            value="{{ old('name', $promo->name ?? '') }}">
                                        <span class="input-group-text"><i class="ti ti-search"></i></span>
                                    </div>
                                </div>


                            </div>
                            <div class="table-responsive" style="min-height: 400px">

                                {{-- Table of Data --}}
                                <table class="table text-center" id="omsetTable" style="font-size: 15px;">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Bulan</th>
                                            <th class="text-center">Total omset</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($totalOmsetBulanan as $data)
                                            <tr>
                                                <th>{{ $loop->iteration }}</th>
                                                <td>{{ \Carbon\Carbon::createFromFormat('Y-m', $data->bulan)->translatedFormat('F Y') }}
                                                </td>
                                                <td class="text-center">Rp
                                                    {{ number_format($data->totalOmset, 0, ',', '.') }}</td>

                                            </tr>
                                            <tr id="noDataFound" style="display: none;">
                                                <td colspan="8">Data tidak ditemukan.</td>
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
    @include('components.notifications')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#title').on('keyup', function() {
                var value = $(this).val().toLowerCase();
                var rows = $('#omsetTable tbody tr').not('#noDataFound');

                // Filter rows
                var visibleCount = 0;
                rows.each(function() {
                    var monthText = $(this).find('td:nth-child(2)').text().toLowerCase();
                    var isMatch = monthText.indexOf(value) > -1;
                    $(this).toggle(isMatch);
                    if (isMatch) visibleCount++;
                });

                // Tampilkan "Data tidak ditemukan" jika tidak ada baris yang match
                if (visibleCount === 0) {
                    $('#noDataFound').show();
                } else {
                    $('#noDataFound').hide();
                }
            });
        });
    </script>
@endsection
