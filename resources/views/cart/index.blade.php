@extends('layout.user_layout') {{-- Sesuaikan dengan layout utama pengguna Anda --}}

@section('content')
    <section class="bg-motif-1" style="padding-top: 10vh; min-height: 92.7vh">
        <div class="container pt-3 pb-5">
            <nav style="font-size: 12px; color: #999; margin-bottom: -5px;">
                <ol class="breadcrumb" style="background-color: transparent; padding: 0;">
                    <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ url('/') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Cart</li>
                </ol>
            </nav>

            <div class="title-section mb-4">
                <h1 class="m-0 fw-bold">My Shopping Cart</h1>
                <p>
                    View your cart and checkout your items!
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

                @if ($carts->count() > 0)
                    <form id="selectOrdersForm">
                        @csrf
                        <div class="table-responsive">
                            <table class="table table-hover text-center" style="font-size: 14px;">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th><input type="checkbox" id="selectAllOrders"></th>
                                        <th class="text-start">Product Name</th>
                                        <th>Product Price</th>
                                        <th>Quantity</th>
                                        <th>Total Price</th>
                                        <th>Order Date</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($carts as $data)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                @if ($data->status == 'cart')
                                                    <input class="form-check-input order-checkbox" type="checkbox"
                                                        name="cart_ids[]" value="{{ $data->id_cart }}"
                                                        id="orderCheck{{ $data->id_cart }}">
                                                @endif


                                            </td>
                                            <td class="text-start">{{ optional($data->product)->name ?? 'N/A' }}</td>
                                            <td>Rp {{ number_format($data->product->price, 0, ',', '.') }}</td>
                                            <td>{{ $data->quantity }}</td>
                                            <td>Rp {{ number_format($data->product->price * $data->quantity, 0, ',', '.') }}
                                            </td>
                                            <td>{{ $data->created_at->format('d M Y') }}</td>
                                            <td>
                                                @if ($data->status == 'cart')
                                                    <span class="badge bg-warning text-dark">cart</span>
                                                @elseif ($data->status == 'paid')
                                                    <span class="badge bg-success">Paid</span>
                                                @else
                                                    <span class="badge bg-secondary">{{ ucfirst($data->status) }}</span>
                                                @endif
                                            </td>
                                            <td>
                                                <form action="{{ url('/shopping-cart/remove/' . $data->id_cart) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="btn btn-sm btn-warning text-white shadow-lg">Hapus</button>
                                                </form>
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
                    const queryString = selectedOrderIds.map(id => `cart_ids[]=${encodeURIComponent(id)}`)
                        .join('&');
                    console.log('id: ', queryString)
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
