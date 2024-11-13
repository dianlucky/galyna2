@extends('layout.user_layout')
@section('content')
    <div class="container" style="padding-top: 50px">
        <div class="row">
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
