@extends('layout.admin_layout')
@section('content')
    <section class="ps-3">

        {{-- Header Page --}}
        <div class="row">
            <h4 class="p-0">Form {{ $data['form'] }} Category</h4>
            <nav class="page-breadcrumb p-0">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('admin/category') }}">Category</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Form {{ $data['form'] }} Category</li>
                </ol>
            </nav>
        </div>

        {{-- Main --}}
        <div class="row mt-3">
            <div class="col-md-12 p-0">
                <form action={{ $data['action'] }} method="POST">
                    @csrf

                    {{-- Category Name --}}
                    <div class="mb-3">
                        <label for="name" class="form-label">Category Name</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}"
                            placeholder="Enter category name" @error('name') error @enderror>
                        @error('name')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Description --}}
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <input type="text" class="form-control" id="description" name="description" value="{{ old('description') }}"
                            placeholder="Enter category description" @error('description') error @enderror>
                        @error('description')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </section>
@endsection
