@if (session('success'))
    <script>
        // Setelah Page di Load, Munculkan Toast
        Swal.fire({
            icon: "success",
            title: "Success",
            text: "{{ session('success') }}",
        });
        document.addEventListener('DOMContentLoaded', function() {
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

@if(session('info'))
    <script>
        // Setelah Page di Load, Munculkan Toast
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                icon: "info",
                title: "Info",
                text: "{{ session('info') }}",
            });
        });
    </script>
@endif
