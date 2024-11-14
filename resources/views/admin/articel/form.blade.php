@extends('layout.admin_layout')
@section('content')
    <div>
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">{{ $data['form'] }} Data Artikel</h6>
                        <form action="{{ $data['action'] }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="date">Tanggal</label>
                                <input type="date" class="form-control" id="date" name="date" required>
                            </div>

                            <div class="form-group">
                                <label for="title">Judul Artikel</label>
                                <input type="text" class="form-control" id="title" name="title" placeholder="Masukkan Judul Artikel" required>
                            </div>

                            <div class="form-group">
                                <label for="slug">Slug</label>
                                <input type="text" class="form-control" id="slug" name="slug" placeholder="Masukkan Slug" required>
                            </div>

                            <div class="form-group">
                                <label for="description">Isi Artikel</label>
                                <textarea class="form-control" id="description" name="description" rows="5" placeholder="Masukkan Deskripsi Artikel" required></textarea>
                            </div>


                            <!-- <div class="form-group">
                                <label for="image">Gambar Artikel</label>
                                <input type="file" class="form-control-file" id="image" name="image">
                            </div> -->

                            <button type="submit" class="btn btn-primary">Simpan Artikel</button>
                            <a href="{{ url('admin/articel') }}" class="btn btn-secondary">Kembali</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
