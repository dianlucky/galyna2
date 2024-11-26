@extends('layout.admin_layout')
@php
    $dataPage = [
        'page' => 'category',
    ];
@endphp
@section('content')
    <section class="ps-3">

        {{-- Header Page --}}
        <div class="row text-capitalize">
            <h4 class="p-0 ">Form {{ $data['form'] . ' ' . $dataPage['page'] }}</h4>
            <nav class="page-breadcrumb p-0">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('admin/' . $dataPage['page']) }}">{{ $dataPage['page'] }}</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Form {{ $data['form'] }} {{ $dataPage['page'] }}
                    </li>
                </ol>
            </nav>
        </div>

        {{-- Main --}}
        <div class="row mt-3">
            <div class="col-md-12 p-0">
                <form action={{ $data['action'] }} method="POST">
                    @csrf

                    @if ($data['form'] == 'Edit')
                        @method('PUT')
                    @endif


                    {{-- Category Name --}}
                    <div class="mb-3">
                        <label for="name" class="form-label">Category Name</label>
                        <input type="text" class="form-control" id="name" name="name"
                            placeholder="Enter category name" @error('name') error @enderror
                            value={{ old('name', $category->name ?? '') }}>
                        @error('name')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Description --}}
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <input type="text" class="form-control" id="description" name="description"
                            placeholder="Enter category description" @error('description') error @enderror
                            value={{ old('description', $category->description ?? '') }}>
                        @error('description')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Submit Button --}}
                    <button type="submit" class="btn btn-primary">Submit</button>

                    {{-- Cancel Button --}}
                    <a href={{ url('admin/' . $dataPage['page']) }} class="btn btn-dark">Cancel</a>
                </form>
            </div>
        </div>
    </section>
@endsection
