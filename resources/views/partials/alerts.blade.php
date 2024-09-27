<!-- resources/views/partials/alerts.blade.php -->

@if (session()->has('success') || session()->has('error') || session()->has('warning'))
    <script>
        // Function to show SweetAlert
        function showAlert(type, title, text) {
            Swal.fire({
                title: title,
                text: text,
                icon: type,
                confirmButtonText: type === 'success' ? 'Cool' : (type === 'error' ? 'OK' : 'Understood')
            });
        }

        // Check session and display appropriate alert
        document.addEventListener('DOMContentLoaded', function() {
            @if (session('success'))
                showAlert('success', 'Success!', "{{ session('success') }}");
            @endif

            @if (session('error'))
                showAlert('error', 'Error!', "{{ session('error') }}");
            @endif

            @if (session('warning'))
                showAlert('warning', 'Warning!', "{{ session('warning') }}");
            @endif
        });
    </script>
@endif

<!-- Delete Confirmation Alert -->
<script>
    function confirmDelete(event, formId) {
        event.preventDefault(); // Prevent the default action
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'No, cancel!'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById(formId).submit(); // Submit the form if confirmed
                Swal.fire(
                    'Deleted!',
                    'Your item has been deleted.',
                    'success'
                );
            }
        });
    }
</script>
