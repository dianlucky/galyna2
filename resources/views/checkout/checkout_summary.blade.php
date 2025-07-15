@extends('layout.user_layout')

@section('content')
    <section class="bg-motif-1 pt-5" style="min-height: 92.7vh">
        <div class="container pb-5">
            <nav class="breadcrumb small text-muted bg-transparent px-0 mb-2">
                <a class="breadcrumb-item text-decoration-none" href="{{ url('/') }}">Home</a>
                <a class="breadcrumb-item text-decoration-none" href="{{ route('order.my') }}">My Orders</a>
                <span class="breadcrumb-item active">Checkout</span>
            </nav>

            <div class="title-section mb-4">
                {{-- Judul dinamis berdasarkan jumlah order --}}
                @isset($order)
                    <h1 class="m-0 fw-bold">Checkout </h1>
                    <p>Lanjutkan pembayaran untuk pesanan Anda.</p>
                @else
                    {{-- Hanya tampilkan ini jika $ordersToProcess ada dan tidak kosong --}}
                    @if (isset($ordersToProcess) && $ordersToProcess->isNotEmpty())
                        <h1 class="m-0 fw-bold">Checkout Pesanan Terpilih ({{ $ordersToProcess->count() }} Order)</h1>
                        <p>Ringkasan pembayaran untuk pesanan yang Anda pilih.</p>
                    @else
                        <h1 class="m-0 fw-bold">Checkout</h1>
                        <p>Tidak ada pesanan untuk diproses.</p>
                    @endif
                @endisset
            </div>

            <div class="row">
                <div class="col-md-8">
                    {{-- Detail Pesanan (Loop jika banyak order, tampilkan langsung jika satu order) --}}
                    <div class="card mb-4">
                        <div class="card-header bg-primary text-white">
                            Detail Pesanan
                        </div>
                        <div class="card-body">
                            @if (isset($ordersToProcess) && $ordersToProcess->isNotEmpty())
                                <h6 class="mb-3">Daftar Pesanan:</h6>
                                <ul class="list-group mb-3">
                                    @php
                                        $grandTotal = 0;
                                    @endphp

                                    @foreach ($ordersToProcess as $multiOrder)
                                        @php
                                            $price = optional($multiOrder->product)->price ?? 0;
                                            $quantity = $multiOrder->quantity ?? 0;
                                            $total = $price * $quantity;
                                            $grandTotal += $total;
                                        @endphp
                                        <div class="row mb-1">
                                            <div class="col-md-2 text-end">
                                                <img src="{{ asset('images/' . optional($multiOrder->product)->cover_image ?? 'default.jpg') }}"
                                                    class="rounded" style="height: 75px; width: 60px;"
                                                    alt="{{ optional($multiOrder->product)->name ?? 'Produk' }}">
                                            </div>
                                            <div class="col-md-10">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <li class="list-group-item">
                                                            <strong>Order #{{ $loop->iteration }}</strong><br>
                                                            <div style="margin-bottom: -30px" class="d-flex">
                                                                <p> Produk:
                                                                    {{ optional($multiOrder->product)->name ?? 'N/A' }}</p>
                                                                <p>
                                                                    ({{ $quantity }}x)
                                                                </p>
                                                            </div>
                                                            <br>
                                                            <p> Total: Rp.
                                                                <span id="final_price{{ $loop->iteration }}">
                                                                    {{ number_format($total, 0, ',', '.') }}
                                                                </span>
                                                            </p>
                                                            <input type="hidden" id="product_price{{ $loop->iteration }}"
                                                                value="{{ $multiOrder->product->price }}">
                                                            <input type="hidden"
                                                                id="total_price_product{{ $loop->iteration }}"
                                                                value="{{ $total }}">
                                                            <input type="hidden" id="quantity{{ $loop->iteration }}"
                                                                value="{{ $quantity }}">
                                                        </li>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="promo" class="form-label">Kode promo</label>
                                                        <select class="form-select" name="promo"
                                                            id="promo{{ $loop->iteration }}"
                                                            data-product-id="{{ $multiOrder->product->id_product }}"
                                                            data-price="{{ $multiOrder->product->price }}">
                                                            <option value="null" amount="0" type="null"
                                                                data-discount="0">JANGAN GUNAKAN PROMO</option>
                                                            @if ($multiOrder->product->promos)
                                                                @foreach ($multiOrder->product->promos as $promo)
                                                                    <option value="{{ $promo->code_promo }}"
                                                                        amount={{ $promo->amount }}
                                                                        type={{ $promo->type }}
                                                                        data-discount="{{ $promo->type == 'persen' ? ($multiOrder->product->price * $promo->amount) / 100 : $promo->amount }}">
                                                                        {{ $promo->code_promo }}
                                                                        @if ($promo->type == 'persen')
                                                                            Diskon {{ $promo->amount }}%
                                                                        @else
                                                                            Potongan
                                                                            Rp.{{ number_format($promo->amount, 0, ',', '.') }}
                                                                        @endif
                                                                    </option>
                                                                @endforeach
                                                            @endif

                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach

                                </ul>
                                <p class="fw-bold">
                                    Total Harga Produk Keseluruhan: Rp <span
                                        id="total_semua_produk">{{ number_format($grandTotal, 0, ',', '.') }}</span>
                                </p>
                            @else
                                <p>Tidak ada detail pesanan untuk ditampilkan.</p>
                            @endif
                            {{-- @endisset --}}
                        </div>
                    </div>

                    {{-- RAJAONGKIR PENGIRIMAN --}}
                    <div class="card mb-4">
                        <div class="card-header bg-info text-white">
                            Informasi Pengiriman
                        </div>
                        <div class="card-body">
                            @csrf

                            {{-- Pilih alamat pengiriman --}}
                            <div class="mb-3">
                                <label for="address" class="form-label">Alamat pengiriman</label>
                                <select class="form-select" id="address" name="address_code" required>
                                    @foreach ($addresses as $data)
                                        <option value="{{ $data->address_code }}" destination="{{ $data->address_code }}"
                                            destination_code="{{ $data->address_code }}"
                                            {{ $data->status == true ? 'selected' : '' }}>
                                            {{ $data->city_name }} | {{ $data->address_name }}

                                        </option>
                                    @endforeach
                                </select>

                            </div>

                            {{-- Pilih kurir --}}
                            <div class="mb-3">
                                <label for="courier" class="form-label">Kurir</label>
                                <select class="form-select" id="courier" name="courier" required>
                                    <option value="">Pilih Kurir</option>
                                    <option value="jne">JNE</option>
                                    <option value="j&t">JNT</option>
                                    <option value="anteraja">Anteraja</option>
                                    <option value="pos">POS Indonesia</option>
                                    <option value="tiki">TIKI</option>
                                </select>
                            </div>

                            {{-- Layanan kurir muncul setelah hitung ongkir --}}
                            <div class="mb-3">
                                <label for="courier-service" class="form-label">Layanan Pengiriman</label>
                                <select class="form-select" id="courier-service" name="courier_service" required>
                                    <option value="">Pilih Layanan</option>
                                </select>
                            </div>

                            {{-- Hasil --}}
                            <div id="shippingCostResult" class="mt-2" style="display: none;">
                                <p>Biaya Pengiriman: <span id="shippingCostDisplay">Rp 0</span></p>
                                <p>Estimasi Waktu: <span id="shippingEtdDisplay">-</span></p>
                            </div>

                            <input type="hidden" id="hiddenShippingCost" name="shipping_cost" value="0">
                        </div>
                    </div>

                    <form id="paymentForm">
                        @csrf
                        <input type="hidden" id="hiddenShippingCost" name="shipping_cost" value="0">
                        <input type="hidden" id="selectedCourier">
                        <input type="hidden" id="destinationCode">
                        <input type="hidden" id="destination">
                        <input type="hidden" id="courier">
                        <input type="hidden" id="deliveryType">
                        <input type="hidden" id="estimatedDay">

                        <input type="hidden" id="paymentCode">
                        <input type="hidden" id="totalPayment"
                            value="{{ isset($order) ? $order->total : $grandTotal }}">
                        <input type="hidden" id="selectedOrderIds" value='@json($selectedOrderIds)'>
                        <button type="submit" class="btn btn-outline-info">Bayar Sekarang</button>
                    </form>
                </div>

                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Ringkasan Pembayaran</h5>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Total Harga Produk
                                    <span>Rp <span id="summaryProductTotal">0
                                        </span></span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center"
                                    id="shippingSummaryRow" style="display: none;">
                                    Biaya Pengiriman
                                    <span>Rp <span id="shippingCostDisplay2">0</span></span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center fw-bold">
                                    Total Bayar
                                    <span>Rp <span id="summaryTotalBayar">
                                            0
                                        </span></span>
                                </li>
                            </ul>
                            <p class="mt-3 text-muted small">Pastikan semua detail pesanan sudah benar sebelum melanjutkan
                                pembayaran.</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection

@section('script')
    @parent {{-- Penting: panggil @parent untuk menjaga script dari layout utama --}}
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}">
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const totalItems = {{ $ordersToProcess->count() }};
            const totalSemuaProdukEl = document.getElementById('total_semua_produk');
            const summaryProductTotal = document.getElementById("summaryProductTotal");

            const addressSelect = document.getElementById("address");
            const courierServiceSelect = document.getElementById("courier-service");
            const courierSelect = document.getElementById("courier");
            const destinationCode = document.getElementById("destinationCode");
            const selectedCourier = document.getElementById("selectedCourier");
            const destination = document.getElementById("destination");
            const estimatedDay = document.getElementById("estimatedDay");
            const deliveryType = document.getElementById("deliveryType");
            const shippingCostResult = document.getElementById("shippingCostResult");
            const shippingCostDisplay = document.getElementById("shippingCostDisplay");

            const costDisplay = document.getElementById('shippingCostDisplay2');
            const shippingRow = document.getElementById('shippingSummaryRow');
            const totalPaymentInput = document.getElementById('totalPayment');
            const summaryTotalBayar = document.getElementById('summaryTotalBayar');
            const shippingEtdDisplay = document.getElementById('shippingEtdDisplay');
            const hiddenShippingCost = document.getElementById("hiddenShippingCost");
            const paymentForm = document.getElementById('paymentForm');

            let shippingCost = 0;
            let promoSelections = {};
            let productBasePrices = {};
            let productQuantities = {};
            let productDiscounts = {};

            // Fungsi bantu: Format ke dalam mata uang rupiah
            function formatRupiah(angka) {
                return angka.toLocaleString('id-ID', {
                    style: 'decimal',
                    maximumFractionDigits: 0
                });
            }

            // Hitung total produk
            function calculateTotalSemuaProduk() {
                let totalAll = 0;

                for (let i = 1; i <= totalItems; i++) {
                    const quantityEl = document.getElementById('quantity' + i);
                    const productPriceEl = document.getElementById('product_price' + i);
                    const promoEl = document.getElementById('promo' + i);
                    const finalPriceEl = document.getElementById('final_price' + i);

                    if (!quantityEl || !productPriceEl || !promoEl || !finalPriceEl) continue;

                    const quantity = parseInt(quantityEl.value) || 0;
                    const productPrice = parseFloat(productPriceEl.value) || 0;

                    const selectedOption = promoEl.options[promoEl.selectedIndex];
                    const discountType = selectedOption.getAttribute('type');
                    const discountAmount = parseFloat(selectedOption.getAttribute('amount')) || 0;

                    let discount = 0;
                    if (discountType === 'persen') {
                        discount = (productPrice * discountAmount) / 100;
                    } else {
                        discount = discountAmount;
                    }

                    let finalTotal = (productPrice - discount) * quantity;
                    if (finalTotal < 0) finalTotal = 0;

                    finalPriceEl.textContent = formatRupiah(finalTotal);
                    totalAll += finalTotal;
                }

                totalSemuaProdukEl.textContent = formatRupiah(totalAll);
                summaryProductTotal.textContent = formatRupiah(totalAll);
                updateTotalPayment(); // <-- update setelah produk diubah
            }

            // Hitung total + ongkir
            function updateTotalPayment() {
                const subtotal = parseInt(totalSemuaProdukEl.textContent.replace(/\./g, ''), 10);
                const total = subtotal + shippingCost;

                console.log("Subtotal :", subtotal);
                console.log("Total :", total);
                console.log("Summarytotal :", totalSemuaProdukEl.textContent);

                summaryTotalBayar.textContent = total.toLocaleString('id-ID');
                totalPaymentInput.value = total;
            }

            // Update tujuan pengiriman
            function updateDestinationFields() {
                const selectedOption = addressSelect.options[addressSelect.selectedIndex];
                const destinationCodeValue = selectedOption.getAttribute('destination_code');
                const destinationText = selectedOption.textContent.trim();

                destinationCode.value = destinationCodeValue || '';
                destination.value = destinationText || '';
            }

            function triggerCalculateShipping() {
                const selectedDestination = addressSelect.selectedOptions[0]?.getAttribute('destination');
                const courier = courierSelect.value;

                if (selectedDestination && courier) {
                    selectedCourier.value = courier;
                    calculateOngkir(courier, selectedDestination);
                }
            }

            async function calculateOngkir(courier, destination) {
                try {
                    const response = await fetch("/api/calculate-shipping", {
                        method: "POST",
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded',
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                        },
                        body: new URLSearchParams({
                            origin: 3820,
                            destination: destination,
                            weight: 500,
                            courier: courier
                        })
                    });

                    const result = await response.json();
                    if (result.success && Array.isArray(result.data)) {
                        courierServiceSelect.innerHTML = `<option value="">Pilih Layanan</option>`;
                        result.data.forEach(service => {
                            const option = document.createElement("option");
                            option.value = service.cost;
                            option.text =
                                `${service.service} - Rp ${service.cost.toLocaleString()} (${service.etd})`;
                            option.dataset.etd = service.etd;
                            option.dataset.description = service.description;
                            courierServiceSelect.appendChild(option);
                        });
                    } else {
                        console.error("Gagal hitung ongkir:", result.message);
                    }
                } catch (err) {
                    console.error("Error calculate ongkir:", err);
                }
            }

            courierServiceSelect.addEventListener("change", () => {
                const selected = courierServiceSelect.selectedOptions[0];
                shippingCost = parseInt(selected.value || 0);
                const etd = selected.dataset.etd || "-";
                const description = selected.dataset.description || "";

                if (!isNaN(shippingCost)) {
                    costDisplay.textContent = shippingCost.toLocaleString('id-ID');
                    hiddenShippingCost.value = shippingCost;
                    shippingRow.style.display = 'flex';
                    updateTotalPayment();
                }

                deliveryType.value = description;
                shippingCostDisplay.textContent = `Rp ${shippingCost.toLocaleString("id-ID")}`;
                shippingEtdDisplay.textContent = etd;
                estimatedDay.value = etd;
                shippingCostResult.style.display = "block";
            });

            addressSelect.addEventListener('change', () => {
                courierServiceSelect.innerHTML = `<option value="">Pilih Layanan</option>`;
                updateDestinationFields();
                triggerCalculateShipping();
            });

            courierSelect.addEventListener('change', () => {
                triggerCalculateShipping();
            });

            paymentForm.addEventListener('submit', async function(event) {
                event.preventDefault();

                const totalPayment = totalPaymentInput.value;
                const shippingCostVal = hiddenShippingCost.value;

                if (!shippingCostVal || parseInt(shippingCostVal) === 0) {
                    alert('Harap mengisi formulir pengiriman terlebih dahulu');
                    return;
                }

                try {
                    const generatedOrderId = `INV-${Date.now()}`;
                    const response = await fetch('/midtrans-test-token', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            total: totalPayment,
                            order_id: generatedOrderId,
                        })
                    });

                    const result = await response.json();

                    if (result.snap_token) {
                        snap.pay(result.snap_token, {
                            onSuccess: async function(result) {
                                const selectedOrderIds = JSON.parse(document.getElementById(
                                    'selectedOrderIds').value);
                                let selectedPromos = [];

                                for (let i = 1; i <= totalItems; i++) {
                                    const promoEl = document.getElementById('promo' + i);

                                    if (promoEl) {
                                        const productId = promoEl.getAttribute(
                                            'data-product-id');
                                        const selectedCodePromo = promoEl.value;

                                        if (selectedCodePromo && selectedCodePromo !==
                                            "null") {
                                            selectedPromos.push({
                                                product_id: productId,
                                                code_promo: selectedCodePromo
                                            });
                                        }
                                    } else {
                                        console.warn(`promo${i} not found in DOM`);
                                    }
                                }

                                    const updateResult = await updateResponse.json();
                                    if (updateResult.success) {
                                        alert(
                                            'Pembayaran berhasil dan status order diperbarui!'
                                        );
                                        window.location.href = '/history-order';
                                    } else {
                                        alert(
                                            'Pembayaran berhasil, tapi gagal update status order.'
                                        );
                                    }
                                } catch (error) {
                                    console.error('Gagal update status order:', error);
                                    alert('Terjadi kesalahan saat update status.');
                                }
                            },
                            onPending: function() {
                                alert('Pembayaran tertunda.');
                            },
                            onError: function() {
                                alert('Pembayaran gagal.');
                            }
                        });
                    } else {
                        alert('Token tidak diterima, ada pembayaran yang belum diselesaikan');
                    }
                } catch (error) {
                    console.error('Gagal fetch token Midtrans:', error);
                    alert('Gagal menampilkan popup Midtrans.');
                }
            });

            // Inisialisasi event listener untuk semua promo
            for (let i = 1; i <= totalItems; i++) {
                const promoEl = document.getElementById('promo' + i);
                if (promoEl) {
                    promoEl.addEventListener('change', calculateTotalSemuaProduk);
                }
            }

            calculateTotalSemuaProduk();
            updateDestinationFields();
        });
    </script>
@endsection
