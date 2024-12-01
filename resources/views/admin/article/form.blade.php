@extends('layout.admin_layout')
@php
    $dataPage = [
        'page' => 'article',
    ];
@endphp
@section('style')
    {{-- CKEDITOR5 STYLE CUSTOM --}}
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

                {{-- Form Input Element --}}
                <form action={{ $data['action'] }} method="POST" enctype="multipart/form-data">
                    @csrf

                    {{-- Edit Condition --}}
                    @if ($data['form'] == 'Edit')
                        @method('PUT')
                    @endif

                    {{-- Title Column Input --}}
                    <div class="mb-3">
                        <label for="title" class="form-label">Title of Article</label>
                        <input type="text" class="form-control" id="title" name="title"
                            placeholder="Enter article title" @error('title') error @enderror
                            value="{{ old('title', $article->title ?? '') }}">
                        @error('title')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Grouping Input --}}
                    <div class="row mb-3">
                        <div class="col-12 col-md-8">

                            {{-- Author Column Input --}}
                            <div class="mb-3">
                                <label for="author" class="form-label">Author</label>
                                <input type="text" class="form-control" id="author" name="author"
                                    placeholder="Enter article author" @error('author') error @enderror
                                    value="{{ old('author', $article->author ?? '') }}">
                                @error('author')
                                    <span class="error-message">{{ $message }}</span>
                                @enderror
                            </div>

                            {{-- Location --}}
                            <div class="mb-3">
                                <label for="location" class="form-label">Location</label>
                                <input type="text" class="form-control" id="location" name="location"
                                    placeholder="Enter event location or address" @error('location') error @enderror
                                    value="{{ old('location', $article->location ?? '') }}">
                                @error('location')
                                    <span class="error-message">{{ $message }}</span>
                                @enderror
                            </div>

                            {{-- Published Date Column Input [published_at] --}}
                            <div class="mb-3">
                                <label for="published_at" class="form-label">Published Date</label>
                                <input onfocus="this.showPicker()" type="date" class="form-control" id="published_at"
                                    name="published_at" placeholder="Enter article published date"
                                    @error('published_at') error @enderror
                                    value="{{ old('published_at', isset($article) ? $article->published_at : now()->format('Y-m-d')) }}">
                                @error('published_at')
                                    <span class="error-message">{{ $message }}</span>
                                @enderror
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
                                    placeholder="{{ $item->cover_image ?? 'Enter article cover image' }}"
                                    @error('cover_image') error @enderror
                                    value="{{ old('cover_image', $article->cover_image ?? '') }}">

                                {{-- Display existing cover image if available --}}
                                @if (isset($article) && $article->cover_image)
                                    <div class="mt-3 mb-3">
                                        <img id="cover_image_preview" src="{{ asset('images/' . $article->cover_image) }}"
                                            alt="Current Cover Image" class="img-fluid"
                                            style="max-width: 100%; height: auto;">
                                    </div>
                                @else
                                    <div class="mt-3 mb-3">
                                        <img id="cover_image_preview"
                                            src="{{ asset('assets/images/default/cover_input_image.png') }}"
                                            alt="Current Cover Image" class="img-fluid"
                                            style="max-width: 100%; height: auto;">
                                    </div>
                                @endif
                            </div>
                            @error('cover_image')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>



                    {{-- Content Column Input --}}
                    <div class="mb-3">
                        <label for="content" class="form-label">Content of Article</label>
                        @error('content')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                        <textarea style="height: 600px" class="form-control" id="editor" name="content" placeholder="Enter article content"
                            @error('content') error @enderror>
                            {{-- {{ old('content', $article->content ?? '') }} --}}
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
                editor.setData(`{!! old('content', $article->content ?? '') !!}`);
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
