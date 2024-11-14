@extends('layout.admin_layout')
@section('content')
    <div>
        <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('admin/category') }}">Kategori</a></li>
                <li class="breadcrumb-item active" aria-current="page">Data Kategori</li>
                <li class="breadcrumb-item active" aria-current="page">Tambah Kategori</li>
            </ol>
        </nav>

        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <h6 class="card-title">Tambah Data Kategori</h6>
                        </div>

                          <!-- Form untuk input data kategori -->
                          <form action="{{ route('category.store') }}" method="POST">
                            @csrf
                            <!-- Input Nama kategori -->
                            <div class="form-group">
                                <label for="nama_kategori">Nama kategori</label>
                                <input type="text" class="form-control" id="nama_kategori" name="nama_ketegori" placeholder="Masukkan Nama Kategori" required>
                            </div>

                            <!-- Input Deskripsi kategori -->
                            <div class="form-group">
                                <label for="deskripsi">Deskripsi</label>
                                <textarea class="form-control" id="deskripsi" name="deskripsi" rows="4" placeholder="Masukkan Deskripsi Kategori" required></textarea>
                            </div>

                            <a href="{{ url('admin/category') }}" class="btn btn-secondary">Kembali</a>
                            <button type="submit" class="btn btn-primary">Simpan</button>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
