

<?php $__env->startSection('title'); ?>
    <?php echo app('translator')->get('translation.campus-form'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <?php $__env->startComponent('components.breadcrumb'); ?>
        <?php $__env->slot('li_1'); ?>
            Forms
        <?php $__env->endSlot(); ?>
        <?php $__env->slot('title'); ?>
            Edit User
        <?php $__env->endSlot(); ?>
    <?php echo $__env->renderComponent(); ?>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Edit User</h4>
                    <a href="<?php echo e(route('user.index')); ?>" class="btn btn-primary ms-auto">Back</a>
                </div><!-- end card header -->
                <div class="card-body">
                    <!-- Form for editing Teacher -->

                    <form action="<?php echo e(route('user.update', $user->id)); ?>" method="POST" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('PUT'); ?>

                        <div class="row gy-4">
                            <!-- Name -->
                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" class="form-control" id="name" name="name"
                                        value="<?php echo e(old('name', $user->name)); ?>" required>
                                </div>
                            </div>
                            <!--end col-->

                            <!-- Email -->
                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" name="email"
                                        value="<?php echo e(old('email', $user->email)); ?>" required>
                                </div>
                            </div>
                            <!--end col-->

                            <!-- Password (optional) -->
                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" class="form-control" id="password" name="password"
                                        placeholder="Leave blank if not changing">
                                </div>
                            </div>
                            <!--end col-->
                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="password_confirmation" class="form-label">Confirm Password</label>
                                    <input type="password"
                                        class="form-control <?php $__errorArgs = ['password_confirmation'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                        id="password_confirmation" name="password_confirmation">
                                    <?php $__errorArgs = ['password_confirmation'];
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


                            <!-- Avatar Upload -->
                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="avatar" class="form-label">Avatar</label>
                                    <input type="file" class="form-control <?php $__errorArgs = ['avatar'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="avatar" name="avatar">
                                    
                                    <?php if($user->avatar): ?>
                                        <img src="<?php echo e(asset('images/' . $user->avatar)); ?>" alt="Avatar" width="50" height="50" class="mt-2">
                                    <?php else: ?>
                                        <p>No avatar uploaded</p> <!-- Message when no avatar is present -->
                                    <?php endif; ?>
                                    
                                    <?php $__errorArgs = ['avatar'];
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
                            
                            <!--end col-->




                            <!-- Role (optional if roles exist) -->
                            
                            <!-- Role (optional if roles exist) -->
<div class="col-xxl-4 col-md-6">
    <div>
        <label for="role" class="form-label">Role</label>
        <select class="form-select" id="role" name="role_id" required>
            <option value="">Select a role</option> <!-- Placeholder option -->
            <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($role->id); ?>" <?php echo e((old('role_id', $user->role_id) == $role->id) ? 'selected' : ''); ?>>
                    <?php echo e($role->name); ?>

                </option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
        <?php $__errorArgs = ['role_id'];
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

<!-- Display Permissions -->
<!-- Display Permissions -->
<div class="col-xxl-4 col-md-6">
    <div>
        <label for="permissions" class="form-label">Permissions</label>
        <?php if($permissions && $permissions->isNotEmpty()): ?>
            <?php $__currentLoopData = $permissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $permission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <p><?php echo e($permission->name); ?></p>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php else: ?>
            <p>No permissions assigned to this role.</p>
        <?php endif; ?>
    </div>
</div>


                            <!--end col-->
                        </div>
                        <!--end row-->

                        <div class="mt-4">
                            <button type="submit" class="btn btn-primary">Update</button>
                            <a href="<?php echo e(route('user.index')); ?>" class="btn btn-secondary">Cancel</a>
                        </div>
                    </form>


                </div>
                <!-- end card body -->
            </div>
        </div>
    </div>
    <!-- end row -->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <script src="<?php echo e(URL::asset('build/libs/prismjs/prism.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('build/js/app.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\wamp\www\Dar-e-Arqam\resources\views/user/edit.blade.php ENDPATH**/ ?>