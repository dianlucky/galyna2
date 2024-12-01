@extends('layout.admin_layout')

@php
    $dataPage = [
        'page' => 'product',
    ];
@endphp
@section('style')
    {{-- CK EDITOR5 STYLE CUSTOM --}}
    <link rel="stylesheet" href="{{ url('/') }}/assets/ckeditor5/ckeditor5.css">
    <style>
        div[role="textbox"] {
            min-height: 400px;
        }

        .container-input-img {
            position: relative;
            width: 100%;
            height: 220px;
            border: 3px solid #ced4da;
            border-radius: .25rem;
            overflow: hidden;
            border-style: dashed;
            padding: 10px;
            background-color: white;
        }

        .container-input-img input[type="file"] {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            opacity: 0;
            cursor: pointer;
        }
    </style>
@endsection

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
                <form action={{ $data['action'] }} method="POST" enctype="multipart/form-data">
                    @csrf

                    @if ($data['form'] == 'Edit')
                        @method('PUT')
                    @endif

                    <div class="row">
                        <div class="col-12 col-md 6">
                            {{-- Product Name --}}
                            <div class="mb-3">
                                <label for="name" class="form-label">Product Name</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    placeholder="Enter product name" @error('name') error @enderror
                                    value="{{ old('name', $product->name ?? '') }}">
                                @error('name')
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


                            {{-- Category Input Choose --}}
                            <div class="mb-3">
                                <label for="category" class="form-label">Category</label>
                                <select class="form-select" id="category" name="id_category">
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id_category }}"
                                            @if (old('category', $product->category_id_category ?? '') == $category->id_category) selected @endif>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        {{-- Column Input Cover Image --}}
                        <div class="col-12 col-md-4 mb-3">

                            <label for="cover_image" class="form-label">Cover Image <i
                                    class="text-secondary fw-light">(Landscape is more
                                    recommended)</i></label>

                            <div class="container-input-img">
                                {{-- Input --}}
                                <input type="file" id="cover_image" name="cover_image"
                                    placeholder="{{ $item->cover_image ?? 'Enter Product cover image' }}"
                                    @error('cover_image') error @enderror
                                    value="{{ old('cover_image', $product->cover_image ?? '') }}">

                                {{-- Display existing cover image if available --}}
                                <div class="mt-3 mb-3" style="height: 100%; padding-bottom: 20px;">
                                    <img id="cover_image_preview"
                                        src="{{ isset($product) && $product->cover_image ? asset('images/' . $product->cover_image) : asset('assets/images/default/cover_input_image.png') }}"
                                        alt="Current Cover Image" class="img-fluid"
                                        style="height: 100%; width:100%; object-fit: contain;">
                                </div>
                            </div>
                            @error('cover_image')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    {{-- Description Column Input --}}
                    <div class="mb-3">
                        <label for="description" class="form-label">Description Product</label>
                        @error('description')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                        <textarea style="height: 600px" class="form-control" id="editor" name="description"
                            placeholder="Enter Product Description" @error('description') error @enderror>
                        </textarea>
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

@section('script')
    @include('components.notifications')
    <script src="{{ url('/') }}/assets/ckeditor5/ckeditor5.js"></script>
    <script type="importmap">
        {
            "imports": {
                "ckeditor5": "{{url('/')}}/assets/ckeditor5/ckeditor5.js",
                "ckeditor5/": "{{url('/')}}/assets/ckeditor5/"
            }
        }
    </script>
    <script type="module">
        import {
            ClassicEditor,
            Essentials,
            Paragraph,
            Bold,
            Italic,
            Font,
            List, // Import the List plugin
            Heading,
            Alignment,
            Link,
            BlockQuote,
            MediaEmbed
        } from 'ckeditor5';

        ClassicEditor
            .create(document.querySelector('#editor'), {
                plugins: [Essentials, Paragraph, Bold, Italic, Font, List, Heading, Alignment, Link, BlockQuote,
                    MediaEmbed
                ],
                toolbar: [
                    'undo', 'redo', '|', 'bold', 'italic', 'heading', '|', 'fontColor', 'fontBackgroundColor', '|',
                    'bulletedList', 'numberedList', '|', 'alignment', '|', 'link', '|',
                    'blockQuote', '|', 'mediaEmbed',
                ]
            })
            .then(editor => {
                window.editor = editor;
                editor.setData(`{!! old('description', $product->description ?? '') !!}`);
            })
            .catch(error => {
                console.error(error);
            });
    </script>

    <script>
        // JavaScript to handle file selection and update image preview
        document.getElementById('cover_image').addEventListener('change', function(event) {
            console.log(event);
            var input = event.target;
            var reader = new FileReader();
            reader.onload = function() {
                var dataURL = reader.result;
                var output = document.getElementById('cover_image_preview');
                output.src = dataURL;
                output.style.display = 'block';
            };
            reader.readAsDataURL(input.files[0]);
        });
    </script>
@endsection
