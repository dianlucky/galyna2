@use('Carbon\Carbon')
@use('Illuminate\Support\Str')
@extends('layout.admin_layout')
@php
    $dataPage = [
        'page' => 'article',
    ];
@endphp
{{-- Content --}}
@section('content')
    <section>
        {{-- Header Page --}}
        <div class="row ps-lg-3 ps-sm-0">
            <h4 class="p-0 text-capitalize">{{ $dataPage['page'] }}</h4>
            <nav class="page-breadcrumb p-0">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('admin/' . $dataPage['page']) }}"
                            class="text-capitalize">{{ $dataPage['page'] }}</a></li>
                    <li class="breadcrumb-item active text-capitalize" aria-current="page">Data {{ $dataPage['page'] }}</li>
                </ol>
            </nav>
        </div>

        {{-- Main Content --}}
        <main id="contents" class="ps-lg-3 ps-sm-0">


            {{-- Header List --}}
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h4 class="text-capitalize m-0">List of {{ $dataPage['page'] }}</h4>
                    <p class="m-0">
                        {{ $articles->count() }} articles found
                    </p>
                </div>
                <a href={{ url('admin/' . $dataPage['page'] . '/create') }} class="btn btn-primary">
                    <i class="ti ti-plus me-2"></i>
                    Add</a>
            </div>

            {{-- List --}}
            <div class="row">
                @foreach ($articles as $item)
                    <div class="col-12">
                        <div class="card"
                            style="border: 1px solid rgb(216, 216, 216); position: relative; max-height:230px; overflow: hidden;">
                            <div class="card-body d-block d-md-flex gap-3">
                                {{-- Image Cover --}}
                                <div class="d-flex justify-content-center">
                                    <img style="object-fit: cover;" width="270" height="160"
                                        src={{ asset('images/' . $item->cover_image) }} alt={{ $item->title }}
                                        class="py-4 py-md-0">
                                </div>
                                {{-- Content --}}
                                <div>
                                    <h4 class="m-0">{{ $item->title }}</h4>
                                    <p class="text-muted" style="font-size: 12px">
                                        {{ Carbon::parse($item->published_at)->translatedFormat('d F Y') }} | Author :
                                        {{ $item->author }} | Location : {{ $item->location }}</p>

                                    {{-- Main Content of Article --}}
                                    <section class="content-article" style="font-size: 12px">
                                        {!! Str::limit($item->content, 100, '') !!}<span>...</span></section>
                                </div>
                            </div>

                            {{-- Action --}}
                            <div class="dropdown" style="position: absolute; top: 15px; right:15px;">
                                <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    Action
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item"
                                            href={{ url('admin/' . $dataPage['page'] . '/edit/' . $item->id_article) }}>Edit</a>
                                    </li>
                                    <li>
                                        <form action="" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <input type="hidden" name="id" value={{ $item->id_article }}>
                                            <button type="submit" class="dropdown-item">Delete</button>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

        </main>
        {{-- End Of Main Content --}}

    </section>
@endsection

@section('script')
    @include('components.notifications')
@endsection
