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
                        {{-- Author Column Input --}}
                        <div class="col-12 col-md-6 mb-3">
                            <label for="author" class="form-label">Author</label>
                            <input type="text" class="form-control" id="author" name="author"
                                placeholder="Enter article author" @error('author') error @enderror
                                value="{{ old('author', $article->author ?? '') }}">
                            @error('author')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Location --}}
                        <div class="col-12 col-md-6 mb-3">
                            <label for="location" class="form-label">Location</label>
                            <input type="text" class="form-control" id="location" name="location"
                                placeholder="Enter event location or address" @error('location') error @enderror
                                value="{{ old('location', $article->location ?? '') }}">
                            @error('location')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Cover Image Column Input --}}
                        <div class="col-12 col-md-6 mb-3">
                            <label for="cover_image" class="form-label">Cover Image</label>
                            <input type="file" class="form-control" id="cover_image" name="cover_image"
                                placeholder="Enter article cover image" @error('cover_image') error @enderror
                                value="{{ old('cover_image', $article->cover_image ?? '') }}">
                            @error('cover_image')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Published Date Column Input [published_at] --}}
                        <div class="col-12 col-md-6 mb-3">
                            <label for="published_at" class="form-label">Published Date</label>
                            <input onfocus="this.showPicker()" type="date" class="form-control" id="published_at"
                                name="published_at" placeholder="Enter article published date"
                                @error('published_at') error @enderror
                                value="{{ old('published_at', isset($article) ? $article->published_at->format('Y-m-d') : now()->format('Y-m-d')) }}">
                            @error('published_at')
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
                            @error('content') error @enderror value="{{ old('content', $article->content ?? '') }}"></textarea>

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
                "ckeditor5": "../../assets/ckeditor5/ckeditor5.js",
                "ckeditor5/": "../../assets/ckeditor5/"
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
            BlockQuote
        } from 'ckeditor5';

        ClassicEditor
            .create(document.querySelector('#editor'), {
                plugins: [Essentials, Paragraph, Bold, Italic, Font, List, Heading, Alignment, Link, BlockQuote],
                toolbar: [
                    'undo', 'redo', '|', 'bold', 'italic', 'heading', '|',
                    'fontSize', 'fontFamily', '|', 'fontColor', 'fontBackgroundColor', '|',
                    'bulletedList', 'numberedList', '|', 'alignment', '|', 'link', '|',
                    'blockQuote',
                ]
            })
            .then(editor => {
                window.editor = editor;
            })
            .catch(error => {
                console.error(error);
            });
    </script>
@endsection
