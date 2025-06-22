@extends('layout.user_layout') {{-- Sesuaikan dengan layout utama pengguna Anda --}}

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
                    <h1 class="m-0 fw-bold">Checkout Order #{{ $order->code }}</h1>
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
                                        @foreach ($ordersToProcess as $multiOrder)
                                            <li class="list-group-item">
                                                <strong>Order #{{ $multiOrder->code }}</strong><br>
                                                Produk: {{ optional($multiOrder->product)->name ?? 'N/A' }}
                                                ({{ $multiOrder->quantity }}x)
                                                <br>
                                                Total: Rp {{ number_format($multiOrder->total, 0, ',', '.') }}
                                            </li>
                                        @endforeach
                                    </ul>
                                    <p class="fw-bold">Total Harga Produk Keseluruhan: Rp
                                        {{ number_format($grandTotal, 0, ',', '.') }}</p>
                                @else
                                    <p>Tidak ada detail pesanan untuk ditampilkan.</p>
                                @endif
                            @endisset
                        </div>
                    </div>

                    {{-- Bagian Pengiriman (Raja Ongkir) --}}
                    <div class="card mb-4">
                        <div class="card-header bg-info text-white">
                            Informasi Pengiriman
                        </div>
                        <div class="card-body">
                            {{-- Perbaikan: Pastikan variabel alamat ada sebelum digunakan --}}
                            @php
                                $currentAddress = null;
                                if (isset($order)) {
                                    $currentAddress = $order->address;
                                } elseif (isset($ordersToProcess) && $ordersToProcess->isNotEmpty()) {
                                    $firstOrderInProcess = $ordersToProcess->first();
                                    $currentAddress = $firstOrderInProcess->address;
                                }
                            @endphp
                            {{-- <p id="address-destination">Alamat Pengiriman: </p>
                            <div class="mb-3">
                                <label for="address" class="form-label">Alamat pengiriman</label>
                                <select class="form-select" id="address" name="address" required>
                                    <option value="">Alamat Pengiriman</option>
                                    <option value="jne">JNE</option>
                                    <option value="pos">POS Indonesia</option>
                                    <option value="tiki">TIKI</option>
                                </select>
                            </div> --}}

                            <p id="address-destination">Alamat Pengiriman:</p>

                            <div class="mb-3">
                                <label for="address-search" class="form-label">Alamat pengiriman</label>

                                <div class="searchable-select">
                                    <div class="input-group">
                                        <input type="text" id="address-search" class="form-control"
                                            placeholder="Masukkan alamat anda..." autocomplete="off" />
                                        <button type="button" id="search-button" class="btn btn-primary">Cari</button>
                                    </div>

                                    <!-- Dropdown hasil pencarian -->
                                    <ul id="address-options" class="options-list"
                                        style="list-style: none; padding-left: 0; margin-top: 8px;"></ul>

                                    <!-- Hidden input untuk submit value -->
                                    <input type="hidden" name="address" id="address" required />
                                </div>
                            </div>



                            <form id="shippingForm">
                                @csrf
                                <div class="mb-3">
                                    <label for="courier" class="form-label">Kurir</label>
                                    <select class="form-select" id="courier" name="courier" required>
                                        <option value="">Pilih Kurir</option>
                                        <option value="jne">JNE</option>
                                        <option value="pos">POS Indonesia</option>
                                        <option value="tiki">TIKI</option>
                                    </select>
                                </div>
                                {{-- <button type="button" id="calculateShippingBtn" class="btn btn-outline-info">Cek Ongkir</button> --}}
                                <div id="shippingCostResult" class="mt-2" style="display: none;">
                                    <p>Biaya Pengiriman: <span id="shippingCostDisplay">Rp 0</span></p>
                                    <p>Estimasi Waktu: <span id="shippingEtdDisplay">-</span></p>
                                </div>
                                <p>Biaya ongkir: Rp. 100.000</p>

                                <input type="hidden" id="hiddenShippingCost" name="shipping_cost" value="0">
                            </form>
                        </div>

                    </div>
                    <form id="paymentForm">
                        @csrf
                        <input type="hidden" id="totalPayment"
                            value={{ isset($order) ? $order->total : $grandTotal + 100000 }}>
                        {{-- {{dd($selectedOrderIds[0])}} --}}
                        {{-- <input type="hidden" id="id_order" value={{$selectedOrderIds[0]}}> --}}
                        <input type="hidden" id="selectedOrderIds" value='@json($selectedOrderIds)'>
                        <button type="submit" class="btn btn-outline-info">Bayar Sekarang</button>
                    </form>
                </div>
                <div class="col-md-4">
                    {{-- Kolom samping untuk ringkasan total --}}
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Ringkasan Pembayaran</h5>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Total Harga Produk
                                    <span>Rp <span
                                            id="summaryProductTotal">{{ number_format(isset($order) ? $order->total : $grandTotal, 0, ',', '.') }}</span></span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center"
                                    id="shippingSummaryItem" style="display: none;">
                                    Biaya Pengiriman
                                    <span id="shippingSummaryCost">Rp 100.000</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center fw-bold">
                                    Total Bayar
                                    <span>Rp
                                        {{ number_format(isset($order) ? $order->total : $grandTotal + 100000, 0, ',', '.') }}</span>
                                </li>
                                {{-- <input type="hidden" id=""> --}}
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
        const input = document.getElementById("address-search");
        const list = document.getElementById("address-options");
        const hidden = document.getElementById("address");
        const button = document.getElementById("search-button");

        let debounceTimer;

        // Ganti event listener dari button click ke input
        input.addEventListener("input", () => {
            clearTimeout(debounceTimer);
            debounceTimer = setTimeout(async () => {
                const keyword = input.value.trim();
                if (keyword.length < 2) {
                    list.style.display = "none";
                    return;
                }
                await searchDestination(keyword);
            }, 500); // Wait 500ms after user stops typing
        });

        async function searchDestination(keyword) {
            try {
                const response = await fetch(`/api/search-destination?keyword=${encodeURIComponent(keyword)}`, {
                    method: 'GET',
                    headers: {
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                });

                if (response.status === 429) {
                    console.warn("Rate limit exceeded. Please wait...");
                    list.innerHTML = "<li style='color: red;'>Terlalu banyak request, coba lagi nanti</li>";
                    list.style.display = "block";
                    return;
                }

                const data = await response.json();
                if (data.success && Array.isArray(data.results)) {
                    renderDropdown(data.results);
                } else {
                    renderDropdown([]);
                }
            } catch (error) {
                console.error("Error fetching destinations:", error);
                renderDropdown([]);
            }
        }

        function renderDropdown(options = []) {
            list.innerHTML = "";

            if (!options.length) {
                list.style.display = "none";
                return;
            }

            options.forEach(opt => {
                const li = document.createElement("li");
                li.textContent = opt.label;
                li.dataset.value = opt.value;
                list.appendChild(li);
            });

            list.style.display = "block";
        }

        // ketika salah satu opsi diklik
        list.addEventListener("click", e => {
            if (e.target.tagName === "LI") {
                input.value = e.target.textContent;
                hidden.value = e.target.dataset.value;
                list.style.display = "none";
            }
        });

        // tutup dropdown kalau klik di luar
        document.addEventListener("click", e => {
            if (!e.target.closest(".searchable-select")) {
                list.style.display = "none";
            }
        });
    </script>



    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // console.log("Client Key:", "{{ env('MIDTRANS_CLIENT_KEY') }}");
            const paymentForm = document.getElementById('paymentForm');
            const totalPayment = document.getElementById('totalPayment').value;
            // const idOrder = document.getElementById('id_order').value;

            paymentForm.addEventListener('submit', async function(event) {
                event.preventDefault();

                try {
                    // Panggil endpoint API Laravel yang return snap_token saja
                    const response = await fetch('/midtrans-test-token', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            total: totalPayment,
                        })
                    });

                    const result = await response.json();

                    if (result.snap_token) {
                        snap.pay(result.snap_token, {
                            onSuccess: async function() {
                                const selectedOrderIds = JSON.parse(document.getElementById(
                                    'selectedOrderIds').value);

                                try {
                                    const updateResponse = await fetch(
                                        '/update-payment-status', {
                                            method: 'POST',
                                            headers: {
                                                'Content-Type': 'application/json',
                                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                            },
                                            body: JSON.stringify({
                                                order_ids: selectedOrderIds
                                            })
                                        });

                                    const updateResult = await updateResponse.json();
                                    if (updateResult.success) {
                                        alert(
                                            'Pembayaran berhasil dan status order diperbarui!'
                                        );
                                        window.location.href = '/my-order';
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
                            },
                            // onClose: function () {
                            //     alert('Popup ditutup.');
                            // }
                        });
                    } else {
                        alert('Token tidak diterima, ada pembayaran yang belum diselesaikan');
                    }
                } catch (error) {
                    console.error('Gagal fetch token Midtrans:', error);
                    alert('Gagal menampilkan popup Midtrans.');
                }
            });
        });
    </script>

    {{-- <script>
        document.addEventListener('DOMContentLoaded', function() {
            const calculateShippingBtn = document.getElementById('calculateShippingBtn');
            const courierSelect = document.getElementById('courier');
            const shippingCostResult = document.getElementById('shippingCostResult');
            const shippingCostDisplay = document.getElementById('shippingCostDisplay');
            const shippingEtdDisplay = document.getElementById('shippingEtdDisplay');
            const hiddenShippingCost = document.getElementById('hiddenShippingCost');
            const shippingSummaryItem = document.getElementById('shippingSummaryItem');
            const shippingSummaryCost = document.getElementById('shippingSummaryCost');
            const finalTotalDisplay = document.getElementById('finalTotalDisplay');
            const finalShippingCostForPayment = document.getElementById('finalShippingCostForPayment');
            const paymentForm = document.getElementById('paymentForm');

            const initialProductTotal = json((isset($order) ? $order => total : $grandTotal) ?? 0);
            let currentShippingCost = 100000;

            function updateFinalTotal() {
                const finalTotal = initialProductTotal + currentShippingCost;
                finalTotalDisplay.textContent = 'Rp ' + finalTotal.toLocaleString('id-ID');
                finalShippingCostForPayment.value = currentShippingCost;
            }

            // calculateShippingBtn.addEventListener('click', async () => {
            //     const courier = courierSelect.value;
            //     if (!courier) {
            //         alert('Mohon pilih kurir terlebih dahulu.');
            //         return;
            //     }

            //     // Perbaikan: Menentukan alamat tujuan dengan lebih aman
            //     let destinationAddress = '';
            //     // Menggunakan PHP untuk mengekstrak alamat dengan aman sebelum di-JSON-kan
            //     <?php
            //     $addressToUse = null;
            //     if (isset($order)) {
            //         $addressToUse = $order->address;
            //     } elseif (isset($ordersToProcess) && $ordersToProcess->isNotEmpty()) {
            //         $firstOrderInProcess = $ordersToProcess->first();
            //         $addressToUse = $firstOrderInProcess->address;
            //     }
            //
            ?>
            //     destinationAddress = json($addressToUse ?? '');

            //     const totalWeight = 1000;

            //     const apiUrl = `{{ route('shipping.calculate') }}`;

            //     try {
            //         calculateShippingBtn.textContent = 'Menghitung...';
            //         calculateShippingBtn.disabled = true;

            //         const response = await fetch(apiUrl, {
            //             method: 'POST',
            //             headers: {
            //                 'Content-Type': 'application/json',
            //                 'X-CSRF-TOKEN': '{{ csrf_token() }}'
            //             },
            //             body: JSON.stringify({
            //                 courier: courier,
            //                 destination_address: destinationAddress,
            //                 weight: totalWeight
            //             })
            //         });

            //         if (!response.ok) {
            //             const errorData = await response.json();
            //             throw new Error(errorData.message || 'Gagal menghitung ongkir.');
            //         }

            //         const data = await response.json();

            //         if (data.success && data.cost && data.etd) {
            //             currentShippingCost = data.cost;
            //             shippingCostDisplay.textContent = 'Rp ' + data.cost.toLocaleString('id-ID');
            //             shippingEtdDisplay.textContent = data.etd;
            //             hiddenShippingCost.value = data.cost;
            //             shippingSummaryCost.textContent = 'Rp ' + data.cost.toLocaleString('id-ID');
            //             shippingSummaryItem.style.display = 'flex';
            //             shippingCostResult.style.display = 'block';

            //             updateFinalTotal();
            //         } else {
            //             alert(data.message || 'Tidak ada biaya pengiriman ditemukan.');
            //             shippingCostResult.style.display = 'none';
            //             shippingSummaryItem.style.display = 'none';
            //             currentShippingCost = 0;
            //             updateFinalTotal();
            //         }

            //     } catch (error) {
            //         console.error('Error saat menghitung ongkir:', error);
            //         alert('Terjadi kesalahan: ' + error.message);
            //         shippingCostResult.style.display = 'none';
            //         shippingSummaryItem.style.display = 'none';
            //         currentShippingCost = 0;
            //         updateFinalTotal();
            //     } finally {
            //         calculateShippingBtn.textContent = 'Cek Ongkir';
            //         calculateShippingBtn.disabled = false;
            //     }
            // });

            // Midtrans Snap Integration (Example)
            paymentForm.addEventListener('submit', async function(event) {
                event.preventDefault(); // Prevent default form submission

                const form = event.target;
                const url = form.action;
                const method = form.method;
                const formData = new FormData(form);
                const data = Object.fromEntries(formData.entries());

                // Tambahkan order_ids jika ini multiple checkout
                const orderIds = [];
                document.querySelectorAll('input[name="order_ids[]"]').forEach(input => {
                    orderIds.push(input.value);
                });
                if (orderIds.length > 0) {
                    data.order_ids = orderIds;
                }

                // Tambahkan biaya pengiriman yang sudah dihitung
                data.shipping_cost = finalShippingCostForPayment.value;

                try {
                    const response = await fetch(url, {
                        method: method,
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify(data)
                    });

                    if (!response.ok) {
                        const errorData = await response.json();
                        throw new Error(errorData.message || 'Gagal memproses pembayaran.');
                    }

                    const result = await response.json();

                    if (result.snap_token) {
                        // Render Midtrans Snap pop-up
                        snap.pay(result.snap_token, {
                            onSuccess: function(response) {
                                /* You may add your own implementation here */
                                alert("Pembayaran berhasil!");
                                window.location.href =
                                '{{ route('order.my') }}'; // Redirect ke halaman My Orders
                            },
                            onPending: function(response) {
                                /* You may add your own implementation here */
                                alert("Menunggu pembayaran Anda.");
                                window.location.href = '{{ route('order.my') }}';
                            },
                            onError: function(response) {
                                /* You may add your own implementation here */
                                alert("Pembayaran gagal!");
                                window.location.href = '{{ route('order.my') }}';
                            },
                            onClose: function() {
                                /* You may add your own implementation here */
                                alert(
                                'Anda menutup pop-up tanpa menyelesaikan pembayaran.');
                            }
                        });
                    } else {
                        // Jika tidak ada snap_token, berarti pembayaran langsung di backend (contoh: status langsung sukses)
                        alert(result.message || 'Pembayaran berhasil diproses.');
                        window.location.href = '{{ route('order.my') }}';
                    }

                } catch (error) {
                    console.error('Error saat memproses pembayaran:', error);
                    alert('Terjadi kesalahan saat memproses pembayaran: ' + error.message);
                }
            });

            // Panggil updateFinalTotal saat halaman dimuat untuk memastikan total awal benar
            updateFinalTotal();
        });
    </script> --}}
@endsection
