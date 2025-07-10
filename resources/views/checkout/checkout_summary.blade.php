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
                            @isset($order)
                                {{-- Tampilan untuk satu order --}}
                                <p><strong>Produk:</strong> {{ optional($order->product)->name ?? 'N/A' }}</p>
                                <p><strong>Jumlah:</strong> {{ $order->quantity }}</p>
                                <p><strong>Total Harga Produk:</strong> Rp {{ number_format($order->total, 0, ',', '.') }}</p>
                                <p><strong>Status:</strong> <span class="badge bg-info">{{ ucfirst($order->status) }}</span></p>
                                <p><strong>Kode Pesanan:</strong> {{ $order->code }}</p>
                                <p><strong>Nama Penerima:</strong> {{ $order->name }}</p>
                                <p><strong>Email:</strong> {{ $order->email }}</p>
                                <p><strong>Telepon:</strong> {{ $order->phone }}</p>
                                <p><strong>Alamat:</strong> {{ $order->address }}</p>
                                <p><strong>Pesan:</strong> {{ $order->message ?? '-' }}</p>
                            @else
                                {{-- Tampilan untuk banyak order --}}
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
                                                    <li class="list-group-item">
                                                        <strong>Order #{{ $multiOrder->id ?? 'N/A' }}</strong><br>
                                                        Produk: {{ optional($multiOrder->product)->name ?? 'N/A' }}
                                                        ({{ $quantity }}x)
                                                        <br>
                                                        Total: Rp {{ number_format($total, 0, ',', '.') }}
                                                    </li>
                                                </div>
                                            </div>
                                        @endforeach

                                    </ul>
                                    <p class="fw-bold">
                                        Total Harga Produk Keseluruhan: Rp {{ number_format($grandTotal, 0, ',', '.') }}
                                    </p>
                                @else
                                    <p>Tidak ada detail pesanan untuk ditampilkan.</p>
                                @endif
                            @endisset
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
                                        <option 
                                            value="{{ $data->address_code }}" 
                                            destination="{{ $data->address_code }}"
                                            destination_code="{{ $data->address_code }}"
                                            {{ $data->status == true ? 'selected' : '' }}
                                        >
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
                        <input type="hidden" id="totalPayment" value="{{ isset($order) ? $order->total : $grandTotal }}">
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
                                    <span>Rp <span id="summaryProductTotal">
                                            {{ number_format(isset($order) ? $order->total : $grandTotal, 0, ',', '.') }}
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
                                            {{ number_format(isset($order) ? $order->total : $grandTotal, 0, ',', '.') }}
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
            const hiddenShippingCost = document.getElementById("hiddenShippingCost");

            const costDisplay = document.getElementById('shippingCostDisplay2');
            const shippingRow = document.getElementById('shippingSummaryRow');
            const totalPaymentInput = document.getElementById('totalPayment');
            const summaryTotalBayar = document.getElementById('summaryTotalBayar');
            const shippingEtdDisplay = document.getElementById('shippingEtdDisplay');

            const productTotal = {{ isset($order) ? $order->total : $grandTotal }};

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

            addressSelect.addEventListener('change', () => {
                courierServiceSelect.innerHTML = `<option value="">Pilih Layanan</option>`;
                updateDestinationFields(); 
                triggerCalculateShipping(); 
            });

            courierSelect.addEventListener('change', () => {
                triggerCalculateShipping();
            });

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
                    console.log('HASIL KURIR', result);

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

            function updateShippingCost(shippingCost, etd = null) {
                costDisplay.textContent = shippingCost.toLocaleString('id-ID');
                hiddenShippingCost.value = shippingCost;
                shippingRow.style.display = 'flex';

                const total = productTotal + shippingCost;
                summaryTotalBayar.textContent = total.toLocaleString('id-ID');
                totalPaymentInput.value = total;
            }

            courierServiceSelect.addEventListener("change", () => {
                const selected = courierServiceSelect.selectedOptions[0];
                const value = parseInt(selected.value || 0);
                const etd = selected.dataset.etd || "-";
                const description = selected.dataset.description || "";

                if (!isNaN(value)) {
                    updateShippingCost(value, etd);
                }

                deliveryType.value = description;
                shippingCostDisplay.textContent = `Rp ${value.toLocaleString("id-ID")}`;
                shippingEtdDisplay.textContent = etd;
                estimatedDay.value = etd;
                shippingCostResult.style.display = "block";
            });

            const paymentForm = document.getElementById('paymentForm');

            paymentForm.addEventListener('submit', async function(event) {
                event.preventDefault();
                const totalPayment = totalPaymentInput.value;
                const shippingCost = hiddenShippingCost.value;

                if (shippingCost == 0 || shippingCost == null) {
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
                    console.log(result);

                    if (result.snap_token) {
                        snap.pay(result.snap_token, {
                            onSuccess: async function(result) {
                                console.log("Hasil Midtrans:", result);
                                const selectedOrderIds = JSON.parse(document.getElementById(
                                    'selectedOrderIds').value);
                                try {
                                    console.log({
                                        order_ids: selectedOrderIds,
                                        delivery_cost: shippingCost,
                                        courier: selectedCourier.value,
                                        payment_code: generatedOrderId,
                                        amount: totalPaymentInput.value,
                                        estimated_day: estimatedDay.value,
                                        destination_code: destinationCode.value,
                                        destination: destination.value,
                                        delivery_type: deliveryType.value,
                                    });

                                    const updateResponse = await fetch(
                                        '/checkout-order/add', {
                                            method: 'POST',
                                            headers: {
                                                'Content-Type': 'application/json',
                                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                            },
                                            body: JSON.stringify({
                                                order_ids: selectedOrderIds,
                                                address: addressSelect.value,
                                                delivery_cost: shippingCost,
                                                courier: selectedCourier.value,
                                                payment_code: result.transaction_id,
                                                payment_type: result.payment_type,
                                                bank: result.payment_type == "bank_transfer" ? result.va_numbers[0].bank : '',
                                                amount: totalPaymentInput.value,
                                                estimated_day: estimatedDay.value,
                                                destination_code: destinationCode .value,
                                                destination: destination.value,
                                                delivery_type: deliveryType.value,
                                            })
                                        });

                                    const updateResult = await updateResponse.json();
                                    if (updateResult.success) {
                                        alert(
                                            'Pembayaran berhasil dan status order diperbarui!');
                                        window.location.href = '/history-order';
                                    } else {
                                        alert(
                                            'Pembayaran berhasil, tapi gagal update status order.');
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

            // Set nilai awal destination saat pertama kali halaman dimuat
            updateDestinationFields();
        });
    </script>
@endsection
