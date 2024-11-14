@extends('layout.user_layout')
@section('content')
    <div class="container" style="padding-top: 50px">
        {{-- Carousel --}}
        <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel" data-bs-delay="100">
            <div class="carousel-inner">
                @for ($i = 1; $i < 3; $i++)
                    <div class="carousel-item hero-carousel {{ $i == 1 ? 'active' : null }}">
                        <div class="card-carousel">
                            <div class="img-carousel">
                                <img src="{{ asset('assets/images/carousel/hero_' . $i . '.png') }}" class="d-block w-100"
                                    alt="Galyna Carousel">
                            </div>
                        </div>
                    </div>
                @endfor
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying"
                data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying"
                data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>

        {{-- Product Search --}}
        <div class="product-search">
            <div>
                <h4 class="fw-bold m-0">Our Product's</h4>
                <span>Find the best products for your needs</span>
            </div>
            <form action="" method="get">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Cari Produk" aria-label="Cari Produk"
                        aria-describedby="button-addon2">
                    <button class="btn btn-primary" type="submit" id="button-addon2">Cari</button>
                </div>
            </form>
        </div>
        {{-- Product List --}}
        <div class="row p-2">
            @for ($i = 1; $i < 7; $i++)
                <div class="col-6 col-sm-6 col-md-2 p-1">
                    <div class="card-product">
                        <div class="card-img">
                            <img src="{{ asset('assets/images/product/produk_' . $i . '.png') }}" alt="">
                        </div>
                        <div class="card-label">
                            product
                        </div>
                    </div>
                </div>
            @endfor
        </div>
    </div>
@endsection
