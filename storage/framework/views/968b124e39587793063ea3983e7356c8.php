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
                    <h4 class="card-title mb-0 flex-grow-1">Roles Form</h4>
                    <a href="<?php echo e(route('roles.index')); ?>" class="btn btn-primary ms-auto">Back</a>
                </div>
                <div class="card-body">
                    <form method="POST" action="<?php echo e(route('permissions.update', $permission->id)); ?>">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('PUT'); ?> <!-- Use PUT method for updating -->
                        
                        <div class="row gy-4">
                            <!-- Permission Name -->
                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="name" class="form-label">Permission Name</label>
                                    <input type="text" class="form-control <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                        id="name" name="name" value="<?php echo e(old('name', $permission->name)); ?>"
                                        placeholder="Enter Permission Name" required>
                                    <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <div class="invalid-feedback"><?php echo e($message); ?></div>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                            </div>
                    
                            <!-- Guard Name (optional: default to 'web') -->
                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="guard_name" class="form-label">Guard Name</label>
                                    <input type="text" class="form-control <?php $__errorArgs = ['guard_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                        id="guard_name" name="guard_name" value="<?php echo e(old('guard_name', $permission->guard_name ?? 'web')); ?>"
                                        placeholder="Enter Guard Name" required>
                                    <?php $__errorArgs = ['guard_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <div class="invalid-feedback"><?php echo e($message); ?></div>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                            </div>
                        </div>
                    
                        <!-- Submit Button -->
                        <div class="mt-4">
                            <button type="submit" class="btn btn-primary">Update</button>
                            <a href="<?php echo e(route('permissions.index')); ?>" class="btn btn-secondary">Cancel</a>
                        </div>
                    </form>
                    



                </div>
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

    <script>
        $(document).ready(function() {
            $('.select2').select2({
                placeholder: "Select permissions", // Optional: Add placeholder
                allowClear: true // Optional: Allow users to clear selection
            });
        });
    </script>

    <!-- Your other script files -->
    <script src="<?php echo e(URL::asset('build/libs/prismjs/prism.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('build/js/app.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\wamp\www\Dar-e-Arqam\resources\views/permissions/edit.blade.php ENDPATH**/ ?>