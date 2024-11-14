@extends('layout.admin_layout')
@section('content')
    <div>
        <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('admin/product') }}">Produk</a></li>
                <li class="breadcrumb-item active" aria-current="page">Data Produk</li>
                <li class="breadcrumb-item active" aria-current="page">Edit Produk</li>
            </ol>
        </nav>

        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <h6 class="card-title">Edit Data Produk</h6>
                        </div>

                          <!-- Form untuk input data produk -->
                          <form action="{{ route('product.update', $product->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <!-- Input Nama Produk -->
                            <div class="form-group">
                                <label for="edit_nama_produk">Nama Produk</label>
                                <input type="text" class="form-control" id="edit_nama_produk" name="edit_nama_produk" placeholder="Masukkan Nama Produk" required>
                            </div>

                            <!-- Input Deskripsi Produk -->
                            <div class="form-group">
                                <label for="edit_deskripsi">Deskripsi</label>
                                <textarea class="form-control" id="edit_deskripsi" name="edit_deskripsi" rows="4" placeholder="Masukkan Deskripsi Produk" required></textarea>
                            </div>

                            <!-- Input Kode Produk -->
                            <div class="form-group">
                                <label for="edit_kode_produk">Kode Produk</label>
                                <input type="text" class="form-control" id="edit_kode_produk" name="edit_kode_produk" placeholder="Masukkan Kode Produk" required>
                            </div>

                            <!-- Dropdown Nama Kategori -->
                            <div class="form-group">
                                <label for="edit_kategori">Nama Kategori</label>
                                <select class="form-control" id="edit_kategori" name="edit_kategori" required>
                                    <option value="" disabled selected>Pilih Kategori</option>
                                    <option value="kategori1">Kategori 1</option>
                                    <option value="kategori2">Kategori 2</option>
                                </select>
                            </div>

                            <a href="{{ url('admin/product') }}" class="btn btn-secondary">Kembali</a>
                            <button type="submit" class="btn btn-primary">Simpan</button>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
