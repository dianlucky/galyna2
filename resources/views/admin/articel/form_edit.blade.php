@extends('layout.admin_layout')

@section('content')
    <div>
        <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('articel') }}">Artikel</a></li>
                <li class="breadcrumb-item active" aria-current="page">Data Artikel</li>
                <li class="breadcrumb-item active" aria-current="page">Edit Artikel</li>
            </ol>
        </nav>

        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Edit Data Artikel</h6>
                        <form action="{{ route('articel.update', $article->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <!-- Input untuk Judul Artikel -->
                            <div class="form-group">
                                <label for="title">Judul Artikel</label>
                                <input type="text" class="form-control" id="title" name="title" value="{{ $article->title }}">
                            </div>
                            <!-- Input untuk Deskripsi Artikel -->
                            <div class="form-group">
                                <label for="description">Deskripsi</label>
                                <textarea class="form-control" id="description" name="description">{{ $article->description }}</textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Update Artikel</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
