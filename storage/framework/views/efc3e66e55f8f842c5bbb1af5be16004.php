<?php $__env->startSection('title'); ?>
    <?php echo app('translator')->get('translation.evaluation-form'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <?php $__env->startComponent('components.breadcrumb'); ?>
        <?php $__env->slot('li_1'); ?>
            Forms
        <?php $__env->endSlot(); ?>
        <?php $__env->slot('title'); ?>
            Roles
        <?php $__env->endSlot(); ?>
    <?php echo $__env->renderComponent(); ?>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Role Form</h4>
                    <a href="<?php echo e(route('roles.index')); ?>" class="btn btn-primary ms-auto">Back</a>
                </div><!-- end card header -->
                <div class="card-body">
                    <form method="POST" action="<?php echo e(route('roles.assignPermissions')); ?>">
                        <?php echo csrf_field(); ?>

                        <!-- Select Role -->
                        <div class="form-group">
                            <label for="role_name">Select Role</label>
                            <select name="role_name" id="role_name" class="form-control" required>
                                <option value="" disabled selected>Select a Role</option>
                                <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($role->name); ?>"><?php echo e($role->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>

                        <!-- Select Permissions (Multiple) -->
                        <div class="form-group mt-3">
                            <label for="permissions">Assign Permissions</label>
                            <select name="permissions[]" id="permissions" class="form-control select2" multiple required>
                                <?php $__currentLoopData = $permissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $permission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($permission->name); ?>"><?php echo e($permission->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="btn btn-primary mt-3">Assign Permissions</button>
                    </form>
                </div>
                <!-- end card body -->
            </div>
        </div>
    </div>
    <!-- end row -->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <!-- Load jQuery before your script -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Include Select2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <!-- Include Select2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <!-- Select2 Initialization -->
    <script>
        $(document).ready(function() {
            // Initialize Select2 for permissions dropdown
            $('#permissions').select2({
                placeholder: "Select permissions", // Optional: Add placeholder
                allowClear: true // Optional: Allow users to clear selection
            });
        });
    </script>

    <!-- Your other script files -->
    <script src="<?php echo e(URL::asset('build/libs/prismjs/prism.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('build/js/app.js')); ?>"></script>

    <!-- jQuery to Fetch and Populate Permissions -->
    <script>
        // When the role is changed, fetch permissions for the selected role
        $('#role_name').on('change', function() {
            let roleName = $(this).val();

            if (roleName) {
                // Make an AJAX call to fetch assigned and all permissions
                $.ajax({
                    url: `/roles/${roleName}/permissions`,
                    type: 'GET',
                    success: function(data) {
                        // Clear the existing options
                        $('#permissions').empty();

                        // Loop through all permissions and append to the dropdown
                        $.each(data.all, function(index, value) {
                            let isSelected = data.assigned.includes(
                            value); // Check if this permission is assigned
                            let option = new Option(value, value, isSelected, isSelected);
                            $('#permissions').append(option);
                        });

                        // Trigger the change event to update the Select2 UI
                        $('#permissions').trigger('change');
                    },
                    error: function() {
                        alert('Unable to fetch permissions.');
                    }
                });
            } else {
                $('#permissions').val([]).trigger('change'); // Clear selection if no role selected
            }
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\Dar-e-Arqam\resources\views/roles/assign_permissions.blade.php ENDPATH**/ ?>