<?php $__env->startSection('title'); ?>
    <?php echo app('translator')->get('translation.evaluation-form'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <?php $__env->startComponent('components.breadcrumb'); ?>
        <?php $__env->slot('li_1'); ?>
            Forms
        <?php $__env->endSlot(); ?>
        <?php $__env->slot('title'); ?>
            Teacher Performance Report
        <?php $__env->endSlot(); ?>
    <?php echo $__env->renderComponent(); ?>
    <?php echo $__env->make('partials.alerts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1"> Roles</h4>
                    <a href="<?php echo e(route('roles.create')); ?>" class="btn btn-primary ms-auto">Create </a>
                </div><!-- end card header -->
                <div class="card-body">
                    <!-- Bordered Tables -->

                    <table class="table table-bordered table-nowrap">
                        <thead>
                            <tr>
                                <th scope="col">Role Name</th>
                                <th scope="col">Guard Name</th>
                                <th scope="col">Created At</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($role->name); ?></td> <!-- Display role name -->
                                    <td><?php echo e($role->guard_name); ?></td> <!-- Display guard name -->
                                    <td><?php echo e($role->created_at->format('Y-m-d')); ?></td> <!-- Display created at date -->

                                    <td>
                                        <!-- Edit button -->
                                        
                                        <a href="<?php echo e(route('roles.edit', $role->id)); ?>" class="btn btn-sm btn-warning">
                                            <i class="ri-edit-line"></i> Edit
                                        </a>
                                        

                                        <!-- Show button -->
                                        

                                        <!-- Delete button -->
                                        <form id="delete-form-<?php echo e($role->id); ?>"
                                            action="<?php echo e(route('roles.destroy', $role->id)); ?>" method="POST"
                                            style="display:inline;">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('DELETE'); ?>
                                            <button type="submit" class="btn btn-sm btn-danger"
                                                onclick="return confirm('Are you sure?')">
                                                <i class="ri-delete-bin-line"></i> Delete
                                            </button>
                                        </form>
                                    </td>

                                </tr>

                                <!-- Collapsible Section for Role Permissions -->
                                <tr>
                                    <td colspan="4">
                                        <a class="btn btn-sm btn-info" data-bs-toggle="collapse"
                                            href="#permissions-<?php echo e($role->id); ?>" role="button" aria-expanded="false"
                                            aria-controls="permissions-<?php echo e($role->id); ?>">
                                            <i class="ri-eye-line"></i> View Permissions
                                        </a>

                                        <div class="collapse" id="permissions-<?php echo e($role->id); ?>">
                                            <ul class="list-group mt-2">
                                                <?php if($role->permissions->isEmpty()): ?>
                                                    <li class="list-group-item">No permissions assigned</li>
                                                <?php else: ?>
                                                    <?php $__currentLoopData = $role->permissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $permission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                                        <?php echo e($permission->name); ?>

                                                    
                                                        <!-- Revoke Permission button, hidden for 'Owner' role -->
                                                        <?php if($role->name !== 'Owner'): ?>
                                                            <form action="<?php echo e(route('roles.revokePermission', [$role->id, $permission->id])); ?>" method="POST" style="margin: 0;">
                                                                <?php echo csrf_field(); ?>
                                                                <?php echo method_field('DELETE'); ?>
                                                                <button type="submit" class="btn btn-secondary btn-sm" title="Revoke Permission">
                                                                    <i class="fas fa-user-lock"></i> Revoke
                                                                </button>
                                                                
                                                            </form>
                                                        <?php endif; ?>
                                                    </li>
                                                    
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                <?php endif; ?>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>


                </div>
                <!-- end card body -->
            </div>
        </div>
    </div>
    <!-- end row -->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="<?php echo e(URL::asset('build/js/app.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\wamp\www\Dar-e-Arqam\resources\views/roles/index.blade.php ENDPATH**/ ?>