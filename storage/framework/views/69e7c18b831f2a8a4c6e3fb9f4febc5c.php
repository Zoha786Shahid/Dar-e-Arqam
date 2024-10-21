

<?php $__env->startSection('title'); ?>
    <?php echo app('translator')->get('translation.campus-form'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <?php $__env->startComponent('components.breadcrumb'); ?>
        <?php $__env->slot('li_1'); ?>
            Forms
        <?php $__env->endSlot(); ?>
        <?php $__env->slot('title'); ?>
            Campus
        <?php $__env->endSlot(); ?>
    <?php echo $__env->renderComponent(); ?>
    <?php echo $__env->make('partials.alerts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Campus Form</h4>
                    <a href="<?php echo e(route('campus.create')); ?>" class="btn btn-primary ms-auto">Create Campus</a>
                </div><!-- end card header -->
                <div class="card-body">
                    <!-- Bordered Tables -->
                    <table class="table table-bordered table-nowrap">
                        <thead>
                            <tr>

                                <th scope="col">Name</th>
                                <th scope="col">City</th>
                                <th scope="col">Capacity</th>
                                <th scope="col">Status</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $campuses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $campus): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>

                                    <td><?php echo e($campus->name); ?></td>
                                    <td><?php echo e($campus->city); ?></td>
                                    <td><?php echo e($campus->capacity); ?></td>
                                    <td>
                                        <?php if($campus->status == 'active'): ?>
                                            <span class="badge badge-soft-success">Active</span>
                                        <?php elseif($campus->status == 'inactive'): ?>
                                            <span class="badge badge-soft-secondary">Inactive</span>
                                        <?php else: ?>
                                            <span class="badge badge-soft-danger">Unknown</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <a href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown"
                                                aria-expanded="false">
                                                <i class="ri-more-2-fill"></i>
                                            </a>

                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                
                                                <li><a class="dropdown-item"
                                                        href="<?php echo e(route('campus.edit', $campus->id)); ?>">Edit</a></li>
                                                <li>
                                                    <a class="dropdown-item" href="#"
                                                        onclick="confirmDelete(event, 'delete-form-<?php echo e($campus->id); ?>')">
                                                        Delete
                                                    </a>
                                                </li>
                                                <form id="delete-form-<?php echo e($campus->id); ?>"
                                                    action="<?php echo e(route('campus.destroy', $campus->id)); ?>" method="POST"
                                                    style="display: none;">
                                                    <?php echo csrf_field(); ?>
                                                    <?php echo method_field('DELETE'); ?>
                                                </form>

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
    <script src="<?php echo e(URL::asset('build/libs/prismjs/prism.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('build/js/app.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\wamp\www\Dar-e-Arqam\resources\views/campus/index.blade.php ENDPATH**/ ?>