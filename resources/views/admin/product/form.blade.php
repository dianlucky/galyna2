@extends('layout.admin_layout')

@php
    $dataPage = [
        'page' => 'product',
    ];
@endphp

@section('content')
    <section class="ps-3">

        {{-- Header Page --}}
        <div class="row">
            <h4 class="p-0 text-capitalize">Form {{ $data['form'] . ' ' . $dataPage['page'] }}</h4>
            <nav class="page-breadcrumb p-0">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a class="text-capitalize"
                            href={{ url('admin/' . $dataPage['page']) }}>{{ $dataPage['page'] }}</a>
                    </li>
                    <li class="breadcrumb-item active text-capitalize" aria-current="page">Form
                        {{ $data['form'] . ' ' . $dataPage['page'] }}
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

                    {{-- Product Name --}}
                    <div class="mb-3">
                        <label for="name" class="form-label">Product Name</label>
                        <input type="text" class="form-control" id="name" name="name"
                            placeholder="Enter product name" @error('name') error @enderror
                            value={{ old('name', $product->name ?? '') }}>
                        @error('name')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Description --}}
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <input type="text" class="form-control" id="description" name="description"
                            placeholder="Enter product description" @error('description') error @enderror
                            value={{ old('description', $product->description ?? '') }}>
                        @error('description')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Is New  Input Choose --}}
                    <div class="mb-3">
                        <label for="is_new" class="form-label">Product Is New</label>
                        <select class="form-select" id="is_new" name="is_new">
                            <option value="1" @if (old('is_new', $product->is_new ?? '') == 1) selected @endif>Yes</option>
                            <option value="0" @if (old('is_new', $product->is_new ?? '') == 0) selected @endif>No</option>
                        </select>
                    </div>

                    {{-- Cover Image --}}
                    <div class="mb-3">
                        <label for="cover_image" class="form-label">Product Cover Image</label>
                        <input type="file" class="form-control" id="cover_image" name="cover_image"
                            @error('cover_image') error @enderror>
                        @error('cover_image')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Category Input Choose --}}
                    <div class="mb-3">
                        <label for="category" class="form-label">Category</label>
                        <select class="form-select" id="category" name="category">
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" @if (old('category', $product->category_id ?? '') == $category->id) selected @endif>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
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
