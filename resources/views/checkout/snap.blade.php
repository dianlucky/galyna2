<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Midtrans Payment</title>
    
    <!-- Midtrans Snap.js -->
    <script src="https://app.midtrans.com/snap/snap.js"
            data-client-key="{{ config('services.midtrans.clientKey') }}"></script>

    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            padding-top: 50px;
        }
    </style>
</head>
<body>
    <h3>Menyiapkan pembayaran Anda...</h3>

    <p>Mohon tunggu, Anda akan diarahkan ke halaman pembayaran.</p>

    <script type="text/javascript">
        document.addEventListener("DOMContentLoaded", function () {
            snap.pay('{{ $snapToken }}', {
                onSuccess: function(result){
                    alert("✅ Pembayaran berhasil!");
                    console.log(result);
                    // Redirect atau simpan status transaksi jika diperlukan
                    window.location.href = "/user/order-history"; // ganti dengan URL tujuan setelah pembayaran sukses
                },
                onPending: function(result){
                    alert("⏳ Pembayaran sedang diproses. Silakan selesaikan pembayaran Anda.");
                    console.log(result);
                    // Bisa diarahkan ke halaman konfirmasi juga
                },
                onError: function(result){
                    alert("❌ Terjadi kesalahan saat pembayaran. Silakan coba lagi.");
                    console.log(result);
                },
                onClose: function(){
                    alert("❗ Anda menutup halaman pembayaran sebelum selesai.");
                }
            });
        });
    </script>
</body>
</html>
