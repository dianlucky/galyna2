@extends('layout.user_layout') {{-- Sesuaikan dengan layout utama pengguna Anda --}}

@section('content')
    <section class="bg-motif-1" style="padding-top: 10vh; min-height: 92.7vh">
        <div class="container pt-3 pb-5">
            <nav style="font-size: 12px; color: #999; margin-bottom: -5px;">
                <ol class="breadcrumb" style="background-color: transparent; padding: 0;">
                    <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ url('/') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">My Orders</li>
                </ol>
            </nav>

            <div class="title-section mb-4">
                <h1 class="m-0 fw-bold">My Orders</h1>
                <p>
                    View your past orders and their details.
                </p>
            </div>

            <div class="mt-4">
                {{-- Menampilkan pesan sukses dari session --}}
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                {{-- Menampilkan pesan error dari session --}}
                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif

                @if ($orders->count() > 0)
                    <form id="selectOrdersForm">
                        @csrf
                        <div class="table-responsive">
                            <table class="table table-hover text-center" style="font-size: 14px;">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th><input type="checkbox" id="selectAllOrders"></th>
                                        <th>Order ID</th>
                                        <th class="text-start">Product Name</th>
                                        <th>Quantity</th>
                                        <th>Total Price</th>
                                        <th>Order Date</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orders as $order)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                @if ($order->status == 'pending' || $order->status == 'waiting_payment')
                                                    <input class="form-check-input order-checkbox" type="checkbox"
                                                        name="order_ids[]" value="{{ $order->id_order }}"
                                                        id="orderCheck{{ $order->id_order }}">
                                                @endif
                                            </td>
                                            <td>{{ $order->code }}</td>
                                            <td class="text-start">{{ optional($order->product)->name ?? 'N/A' }}</td>
                                            <td>{{ $order->quantity }}</td>
                                            <td>Rp {{ number_format($order->total, 0, ',', '.') }}</td>
                                            <td>{{ $order->created_at->format('d M Y') }}</td>
                                            <td>
                                                @if ($order->status == 'pending')
                                                    <span class="badge bg-warning text-dark">Pending</span>
                                                @elseif ($order->status == 'waiting_payment')
                                                    <span class="badge bg-info">Waiting Payment</span>
                                                @elseif ($order->status == 'paid')
                                                    <span class="badge bg-success">Paid</span>
                                                @elseif ($order->status == 'failed')
                                                    <span class="badge bg-danger">Failed</span>
                                                @else
                                                    <span class="badge bg-secondary">{{ ucfirst($order->status) }}</span>
                                                @endif
                                            </td>
                                            <td>
                                                {{-- Dropdown untuk Detail dan Hapus/Cancel --}}
                                                @if ($order->status == 'pending' || $order->status == 'waiting_payment')
                                                    <div class="dropdown">
                                                        <button class="btn btn-sm btn-secondary dropdown-toggle"
                                                            type="button" id="dropdownMenuButton{{ $order->id_order }}"
                                                            data-bs-toggle="dropdown" aria-expanded="false">
                                                            Action
                                                        </button>
                                                        <ul class="dropdown-menu"
                                                            aria-labelledby="dropdownMenuButton{{ $order->id_order }}">
                                                            <li><a class="dropdown-item"
                                                                    href="{{ url('/checkout/detail/' . $order->id_order) }}">Detail</a>
                                                            </li>
                                                            <li>
                                                                <form
                                                                    action="{{ url('/checkout/hapus/' . $order->id_order) }}"
                                                                    method="POST" class="d-inline">
                                                                    @csrf
                                                                    @method('PUT') {{-- Menggunakan PUT untuk update status --}}
                                                                    <button type="submit" class="dropdown-item"
                                                                        onclick="return confirm('Apakah Anda yakin ingin membatalkan pesanan ini?')">Hapus</button>
                                                                </form>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                @else
                                                    <a class="btn btn-sm btn-secondary"
                                                        href="{{ url('/detail-paid/' . $order->id_order) }}">View</a>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="d-flex justify-content-end p-3">
                            <button type="button" id="checkoutSelectedBtn" class="btn btn-info" disabled>
                                Checkout
                            </button>
                        </div>
                    </form>
                @else
                    <div class="py-5 text-center alert alert-info" role="alert">
                        <h1 class="charmonman-regular">You have no orders yet.</h1>
                        <p>Start by browsing our <a href="{{ url('/collection') }}">products</a>!</p>
                    </div>
                @endif
            </div>
        </div>
    </section>
@endsection

@section('script')
    @parent {{-- Penting: panggil @parent untuk menjaga script dari layout utama --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const selectAllCheckbox = document.getElementById('selectAllOrders');
            const orderCheckboxes = document.querySelectorAll('.order-checkbox');
            const checkoutSelectedBtn = document.getElementById('checkoutSelectedBtn');

            function toggleCheckoutButton() {
                const anyChecked = Array.from(orderCheckboxes).some(checkbox => checkbox.checked);
                checkoutSelectedBtn.disabled = !anyChecked;
            }

            function toggleSelectAll() {
                orderCheckboxes.forEach(checkbox => {
                    if (!checkbox.disabled) { // Hanya centang yang tidak disabled (yaitu status pending)
                        checkbox.checked = selectAllCheckbox.checked;
                    }
                });
                toggleCheckoutButton();
            }

            selectAllCheckbox.addEventListener('change', toggleSelectAll);

            orderCheckboxes.forEach(checkbox => {
                checkbox.addEventListener('change', () => {
                    if (!checkbox.checked) {
                        selectAllCheckbox.checked = false;
                    } else {
                        const allActiveChecked = Array.from(orderCheckboxes)
                            .filter(cb => !cb.disabled)
                            .every(cb => cb.checked);
                        selectAllCheckbox.checked = allActiveChecked;
                    }
                    toggleCheckoutButton();
                });
            });

            checkoutSelectedBtn.addEventListener('click', () => {
                const selectedOrderIds = Array.from(orderCheckboxes)
                    .filter(checkbox => checkbox.checked)
                    .map(checkbox => checkbox.value);

                if (selectedOrderIds.length > 0) {
                    // Redirect ke halaman checkout_summary dengan order_ids di URL
                    const queryString = selectedOrderIds.map(id => `order_ids[]=${encodeURIComponent(id)}`)
                        .join('&');
                    window.location.href = `{{ route('checkout.summary_multiple') }}?${queryString}`;
                } else {
                    alert('Mohon pilih setidaknya satu pesanan untuk checkout.');
                }
            });

            // Panggil saat halaman dimuat untuk mengatur status awal tombol
            toggleCheckoutButton();
            const allInitialChecked = Array.from(orderCheckboxes)
                .filter(cb => !cb.disabled)
                .every(cb => cb.checked);
            selectAllCheckbox.checked = allInitialChecked;
        });
    </script>
@endsection
