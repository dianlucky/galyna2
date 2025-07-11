@extends('layout.admin_layout')
@php
    $dataPage = [
        'page' => 'promo',
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
                <form action={{ $data['action'] }} method="POST">
                    @csrf

                    {{-- Edit Condition --}}
                    @if ($data['form'] == 'Edit')
                        @method('PUT')
                    @endif

                    {{-- Title Column Input --}}
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama promo</label>
                        <input type="text" class="form-control" id="title" name="name"
                            placeholder="Masukkan nama promo" @error('title') error @enderror
                            value="{{ old('name', $promo->name ?? '') }}">
                        @error('product')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="row mb-3">
                        <div class="col-12 col-md-6">

                            <div class="mb-3">
                                <label for="product" class="form-label">Produk </label>
                                <select name="id_product" class="form-control" id="product" required>
                                    <option value="">Pilih produk yang ingin diberi promo</option>
                                    <option price="{{ $promo->product->price }}" value="{{ $promo->product->id_product }}"
                                        selected>{{ $promo->product->name }}</option>
                                    @foreach ($data['product'] as $data)
                                        <option price="{{ $data->price }}" value="{{ $data->id_product }}">
                                            {{ $data->name }}</option>
                                    @endforeach
                                </select>
                                @error('product')
                                    <span class="error-message">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="code_promo" class="form-label">Kode promo</label>
                                <input type="text" class="form-control" id="code_promo" name="code_promo"
                                    placeholder="Masukkan kode promo | contoh : AUGS-001 / BELANJAHEMAT /GALYNAAJA"
                                    @error('code_promo') error @enderror
                                    value="{{ old('code_promo', $promo->code_promo ?? '') }}">
                                @error('code_promo')
                                    <span class="error-message">{{ $message }}</span>
                                @enderror
                            </div>



                        </div>
                        <div class="col-12 col-md-6">

                            <div class="mb-3">
                                <label for="type" class="form-label">Tipe promo</label>
                                <select name="type" class="form-control" id="type">
                                    <option value="{{ $promo->type }}">{{ $promo->type }}</option>
                                    <option value="persen">Persen</option>
                                    <option value="potongan">Potongan langsung</option>
                                </select>
                                @error('type')
                                    <span class="error-message">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="normal_price" class="form-label">Harga awal</label>
                                        <input type="text" class="form-control" id="normal_price"
                                            value="{{ $promo ? number_format($promo->product->price, 0, ',', '.') : 0 }}"
                                            disabled>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="amount" class="form-label">Potongan</label>
                                        <input onfocus="this.showPicker()" type="number" class="form-control"
                                            id="amount" name="amount" placeholder="Masukkan jumlah potongan / diskon"
                                            @error('amount') error @enderror
                                            value="{{ old('amount', isset($promo) ? $promo->amount : now()->format('Y-m-d')) }}">
                                        @error('amount')
                                            <span class="error-message">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="discount_price" class="form-label">Harga akhir</label>
                                        <input type="text" class="form-control" id="discount_price"
                                            value="{{ $promo && $promo->type == 'persen'
                                                ? number_format($promo->product->price - (($promo->product->price * $promo->amount) / 100) , 0, ',', '.')
                                                : ($promo && $promo->type == 'potongan'
                                                    ? number_format($data->product->price - $promo->amount, 0, ',', '.')
                                                    : 0) }}"
                                            disabled>
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>



                    {{-- Content Column Input --}}
                    <div class="mb-3">
                        <label for="content" class="form-label">Deskripsi promo</label>
                        @error('description')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                        <textarea style="height: 600px" class="form-control" id="editor" name="description"
                            placeholder="Masukkan deskripsi dari promo" @error('content') error @enderror>
                            {{ old('description', $promo->description ?? '') }}
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
                editor.setData(`{!! old('content', $promo->description ?? '') !!}`);
            })
            .catch(error => {
                console.error(error);
            });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const productSelect = document.getElementById('product');
            const typeSelect = document.getElementById('type');
            const amountInput = document.getElementById('amount');
            const normalPriceInput = document.getElementById('normal_price');
            const discountPriceInput = document.getElementById('discount_price');

            function updatePrices() {
                const selectedOption = productSelect.options[productSelect.selectedIndex];
                const price = parseFloat(selectedOption.getAttribute('price')) || 0;
                const type = typeSelect.value;
                const amount = parseFloat(amountInput.value) || 0;

                normalPriceInput.value = price.toLocaleString('id-ID');

                let finalPrice = price;
                if (type === 'persen') {
                    finalPrice = price - (price * amount / 100);
                } else if (type === 'potongan') {
                    finalPrice = price - amount;
                }

                // Cegah harga minus
                finalPrice = Math.max(0, finalPrice);

                discountPriceInput.value = finalPrice.toLocaleString('id-ID');
            }

            // Event listeners
            productSelect.addEventListener('change', updatePrices);
            typeSelect.addEventListener('change', updatePrices);
            amountInput.addEventListener('input', updatePrices);
        });
    </script>
@endsection
