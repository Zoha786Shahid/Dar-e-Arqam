<?php $__env->startSection('title'); ?>
    <?php echo app('translator')->get('translation.evaluation-form'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <?php $__env->startComponent('components.breadcrumb'); ?>
        <?php $__env->slot('li_1'); ?>
            Forms
        <?php $__env->endSlot(); ?>
        <?php $__env->slot('title'); ?>
            Permissions
        <?php $__env->endSlot(); ?>
    <?php echo $__env->renderComponent(); ?>
    <?php echo $__env->make('partials.alerts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1"> Permissions</h4>
                    <a href="<?php echo e(route('permissions.create')); ?>" class="btn btn-primary ms-auto">Create </a>
                </div><!-- end card header -->
                <div class="card-body">
                    <!-- Bordered Tables -->
                    <table class="table table-bordered table-nowrap">
                        <thead>
                            <tr>
                                <th scope="col">Permission Name</th>
                                <th scope="col">Guard Name</th>
                                <th scope="col">Created At</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $permissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $permission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($permission->name); ?></td> <!-- Display permission name -->
                                    <td><?php echo e($permission->guard_name); ?></td> <!-- Display guard name -->
                                    <td><?php echo e($permission->created_at->format('Y-m-d')); ?></td> <!-- Display created at date -->
                                   
                                        <td>
                                            <!-- Check if the user has permission to edit the section -->
                                            
                                            <a href="<?php echo e(route('permissions.edit', $permission->id)); ?>" class="btn btn-sm btn-warning">
                                                <i class="ri-edit-line"></i> Edit
                                            </a>
                                            
                                      
                                            <!-- Check if the user has permission to delete the section -->
                                            
                                            <form id="delete-form-<?php echo e($permission->id); ?>"
                                                action="<?php echo e(route('permissions.destroy', $permission->id)); ?>" method="POST"
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
    <script src="<?php echo e(URL::asset('build/libs/prismjs/prism.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('build/js/app.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\Dar-e-Arqam\resources\views/permissions/index.blade.php ENDPATH**/ ?>