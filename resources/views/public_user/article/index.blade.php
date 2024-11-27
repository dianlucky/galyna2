@use('Carbon\Carbon')
@use('Illuminate\Support\Str')
@extends('layout.user_layout')
@section('content')
    <section style="padding-top: 10vh; min-height: 92.7vh">

        {{-- Header Page --}}
        <div class="container pt-3">
            {{-- Navigation Breadcrumb --}}
            <nav style="font-size: 12px; color: #999; margin-bottom: -5px;">
                <ol class="breadcrumb" style="background-color: transparent; padding: 0;">
                    <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ url('/') }}">Home</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Article</li>
                </ol>
            </nav>

            {{-- Header Page --}}
            <div class="product-search" style="padding: 0;">
                <div class="title-section" style="flex-grow: 1; min-width: 70%; margin: 0;">
                    <h1 class="fw-bold m-0">Article</h1>
                    <p>Explore the latest updates article or blog, tips, and stories.</p>
                </div>

                {{-- Form input Search --}}
                <form action="" method="get" style="align-items: center;">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search Article or Blog"
                            aria-label="Search Article" aria-describedby="button-addon2">
                        <button class="btn btn-primary text-white" type="submit" id="button-addon2">
                            <i class="bi bi-search"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>

        {{-- Main Content --}}
        <div class="container mt-4 pb-5">
            <div class="row">
                {{-- Main Column --}}
                <div class="col-md-7">
                    @if ($article)
                        <img src="{{ asset('images/' . $article->cover_image) }}" class="card-img-top"
                            alt="{{ $article->title }}">
                        <div class="mt-3">
                            <h2 class="fw-bold">{{ $article->title }}</h2>
                        </div>
                        <div>
                            <p class="text-secondary">
                                {{ Carbon::parse($article->published_at)->translatedFormat('d F Y') }} | Author :
                                {{ $article->author }} | Location : {{ $article->location }}
                            </p>
                        </div>

                        <div class="font-size-5 mb-5" style="text-align: justify">
                            {!! $article->content !!}
                        </div>
                    @else
                        <div class="alert alert-warning text-center py-5" role="alert">
                            <h1 class="charmonman-regular">No article found.</h1>
                        </div>
                    @endif
                </div>

                {{-- Sidebar Column --}}
                <div class="col-md-5">
                    <div class="sidebar">
                        <h4 class="fw-bold m-0">Recent Articles</h4>
                        <p class="text-secondary">
                            Here are some of the latest articles for you to read.
                        </p>

                        <div class="row gap-3">
                            @foreach ($articles as $item)
                                @if ($item->id_article != ($article->id_article ?? '0'))
                                    <div class="col-12 mb-4">
                                        <div class="d-flex gap-2 w-100">
                                            <a href="{{ url('article/' . $item->slug) }}" style="width: 50%">
                                                <img width="100%" style="height: auto; object-fit: contain;"
                                                    src="{{ asset('images/' . $item->cover_image) }}"
                                                    alt="{{ $item->title }}">
                                            </a>
                                            <div class="card-body flex-grow">
                                                <h6 class="card-title fw-bold mt-1 font-size-4">{{ $item->title }}
                                                </h6>
                                                <p class="m-0 text-secondary">{{ $item->location }}</p>
                                                <p class="card-text">
                                                    {{ Carbon::parse($item->published_at)->translatedFormat('d F Y') }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
