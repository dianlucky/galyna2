{{-- resources/views/cart/index.blade.php --}}
@extends('layout.user_layout')

<style>
    #address-options {
        position: absolute;
        width: 100%;
        z-index: 1000;
        max-height: 200px;
        overflow-y: auto;
        margin-top: -1px;
        border: 1px solid #ced4da;
        border-top: none;
        border-radius: 0 0 0.375rem 0.375rem;
        background-color: #fff;
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
        padding-left: 0;
    }

    #address-options li {
        list-style: none;
        padding: 0.5rem 0.75rem;
        cursor: pointer;
    }

    #address-options li:hover {
        background-color: #f8f9fa;
    }
</style>

@section('content')
    <div class="container mt-5">
        <div class="container overflow-hidden" style="margin-top: 80px">
            <div class="row ">
                <div class="col-md-5">
                    <div class="card mb-4">
                        <div class="card-header bg-success text-white">
                            Biodata saya
                        </div>
                        <div class="card-body">
                            <ul class="list-group mb-3">
                                <div class="row mb-1">
                                    <div class="col-md-4 text-center">
                                        <img src="{{ asset('assets-modernize/images/user.png') }}" class="rounded"
                                            style="height: 120px; width: 120px; margin-top: 50px;" alt="test">
                                        <p>{{ $dataProfile->role }}</p>
                                    </div>
                                    <div class="col-md-8">
                                        <form action={{url('/profile/update/' . $dataProfile->id_user)}} method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <div class="mb-3">
                                                <label for="name" class="form-label">Name</label>
                                                <input type="text" class="form-control" id="name" name="name"
                                                    value="{{ old('name') ? old('name') : $dataProfile->name }}"
                                                    aria-describedby="nameHelp" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="email" class="form-label">Email address</label>
                                                <input type="email" class="form-control" id="email" name="email"
                                                    value={{ old('email') ? old('email') : $dataProfile->email }}
                                                    aria-describedby="emailHelp" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="password" class="form-label">Password</label>
                                                <input type="text" class="form-control" id="password" name="password"
                                                    value="{{ old('password') ? old('password') : '' }}"
                                                    placeholder="optional" aria-describedby="emailHelp">
                                            </div>
                                            <div class=" mt-5">
                                                <button class="btn btn-primary w-100 text-white"
                                                    type="submit">Simpan</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-7">
                    {{-- Detail Pesanan (Loop jika banyak order, tampilkan langsung jika satu order) --}}
                    <div class="card mb-4">
                        <div class="card-header bg-secondary text-white">
                            Alamat saya
                        </div>
                        <div class="card-body">
                            <div class="container mb-4">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <h5 class="mb-4">Alamat</h5>
                                    </div>
                                    <div>
                                        <button class="btn btn-primary w-20 btn-sm text-white" data-bs-toggle="modal"
                                            data-bs-target="#addAddress">Tambah</button>
                                    </div>
                                </div>
                                <div class="modal fade" id="addAddress" tabindex="-1" aria-labelledby="exampleModalLabel"
                                    aria-hidden="true">
                                    <div class="modal-dialog">
                                        <form action={{ url('/address/add') }} method="POST">
                                            @csrf
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Tambah alamat baru</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">

                                                    <div class="mb-3">
                                                        <label for="address_code" class="form-label">Kode alamat</label>
                                                        <input type="text" class="form-control" id="address_code"
                                                            name="address_code" value="" readonly>
                                                    </div>
                                                    <div class="mb-3 position-relative">
                                                        <label for="address-search" class="form-label">Alamat</label>
                                                        <input type="text" class="form-control" id="address-search"
                                                            autocomplete="off" value="{{ old('address_name') }}" required>
                                                        <ul id="address-options" class="list-group bg-white"
                                                            style="list-style:none; position: absolute; top: 100%; left: 0; right: 0; z-index: 1050;">
                                                        </ul>
                                                    </div>
                                                    <input type="hidden" name="address_name" id="address_name" required />
                                                    <input type="hidden" name="province_name" id="province_name" />
                                                    <input type="hidden" name="city_name" id="city_name" />
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary text-white"
                                                        data-bs-dismiss="modal">Batal</button>
                                                    <button type="submit"
                                                        class="btn btn-primary text-white">Simpan</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                @foreach ($dataAddress as $data)
                                    <div class="border rounded p-3 mb-3">
                                        <div class="d-flex justify-content-between align-items-start">
                                            <div>
                                                <strong>{{ $data['province_name'] }}</strong> |
                                                <span>{{ $data['address_code'] }}</span>
                                                <p class="mb-1">{{ $data['address_name'] }}</p>

                                                @if ($data['status'] == true)
                                                    <span class="badge bg-danger">Utama</span>
                                                @else
                                                    <span class="badge bg-secondary"></span>
                                                @endif
                                            </div>

                                            <div class="text-end">
                                                @if ($data['status'] == false)
                                                    <form action="{{ url('/address/remove', $data['id_address']) }}"
                                                        method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit "class="btn btn-outline-danger btn-sm me-1" style="color: red">Hapus</button>
                                                    </form>
                                                  
                                                    <form action="{{ url('/address/status', $data['id_address']) }}"
                                                        method="POST" class="d-inline">
                                                        @csrf
                                                        @method('PATCH')
                                                        <button type="submit" class="btn btn-outline-secondary btn-sm">
                                                            Atur sebagai utama
                                                        </button>
                                                    </form>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
@endsection
@section('script')
    @include('components.notifications')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const addressInput = document.getElementById("address-search");
            const addressOptions = document.getElementById("address-options");
            const addressCode = document.getElementById("address_code");
            const addressName = document.getElementById("address_name");
            const provinceName = document.getElementById("province_name");
            const cityName = document.getElementById("city_name");
            let debounceTimer = null;

            addressInput.addEventListener("input", () => {
                clearTimeout(debounceTimer);
                const keyword = addressInput.value.trim();
                if (keyword.length < 2) {
                    addressOptions.style.display = "none";
                    return;
                }
                debounceTimer = setTimeout(() => searchDestination(keyword), 400);
            });

            async function searchDestination(keyword) {
                try {
                    const response = await fetch(
                        `/api/search-destination?keyword=${encodeURIComponent(keyword)}`);
                    const result = await response.json();
                    // console.log("RES : ", result);
                    if (result.success && Array.isArray(result.results)) {
                        renderDropdown(result.results);
                    } else {
                        addressOptions.innerHTML = "<li>Tidak ditemukan</li>";
                        addressOptions.style.display = "block";
                    }
                } catch (error) {
                    console.error("Gagal fetch alamat:", error);
                }
            }

            function renderDropdown(results) {
                addressOptions.innerHTML = "";
                results.forEach(item => {
                    const li = document.createElement("li");
                    li.textContent = item.label;
                    li.style.cursor = "pointer";
                    li.style.padding = "5px";
                    li.style.borderBottom = "1px solid #ddd";
                    li.addEventListener("click", () => {
                        addressInput.value = item.label;
                        addressName.value = item.label;
                        provinceName.value = item.province_name;
                        cityName.value = item.city_name;
                        addressCode.value = item.id;
                        addressOptions.style.display = "none";
                    });
                    addressOptions.appendChild(li);
                });
                addressOptions.style.display = "block";
            }
        })
    </script>
@endsection
