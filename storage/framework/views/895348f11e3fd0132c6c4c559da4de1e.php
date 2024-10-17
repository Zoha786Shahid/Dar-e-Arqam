<!-- resources/views/partials/alerts.blade.php -->

<?php if(session()->has('success') || session()->has('error') || session()->has('warning')): ?>
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
            <?php if(session('success')): ?>
                showAlert('success', 'Success!', "<?php echo e(session('success')); ?>");
            <?php endif; ?>

            <?php if(session('error')): ?>
                showAlert('error', 'Error!', "<?php echo e(session('error')); ?>");
            <?php endif; ?>

            <?php if(session('warning')): ?>
                showAlert('warning', 'Warning!', "<?php echo e(session('warning')); ?>");
            <?php endif; ?>
        });
    </script>
<?php endif; ?>

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
<?php /**PATH C:\wamp64\www\Dar-e-Arqam\resources\views/partials/alerts.blade.php ENDPATH**/ ?>