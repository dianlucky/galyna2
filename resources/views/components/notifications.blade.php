@if (session('success'))
    <script>
        // Setelah Page di Load, Munculkan Toast
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                icon: "success",
                title: "Success",
                text: "{{ session('success') }}",
            });
        });
    </script>
@endif


@if (session('error'))
    <script>
        // Setelah Page di Load, Munculkan Toast
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                icon: "error",
                title: "Error",
                text: "{{ session('error') }}",
            });
        });
    </script>
@endif
