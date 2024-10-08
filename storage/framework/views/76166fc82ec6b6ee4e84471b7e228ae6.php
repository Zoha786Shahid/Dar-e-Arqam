

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
                    <h4 class="card-title mb-0 flex-grow-1"> Evaluation Report</h4>
                    <a href="<?php echo e(route('evaluation.create')); ?>" class="btn btn-primary ms-auto">Create </a>
                </div><!-- end card header -->
                <div class="card-body">
                    <!-- Bordered Tables -->
                    <table class="table table-bordered table-nowrap">
                        <thead>
                            <tr>
                                <th scope="col">Teacher name</th>
                                <th scope="col">Campus</th>
                                <th scope="col">Percentage</th>
                                <th scope="col">Created At</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $evaluations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $evaluation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($evaluation->teacher->first_name); ?> <?php echo e($evaluation->teacher->last_name); ?></td>
                                    <!-- Concatenate first_name and last_name --><!-- Display the teacher's name from the relationship -->
                                    <td><?php echo e($evaluation->campus->name ?? 'N/A'); ?></td> <!-- Display campus name -->
                                    <td><?php echo e($evaluation->percentage); ?>%</td>
                                    <td><?php echo e($evaluation->created_at->format('Y-m-d')); ?></td>
                                    <td>
                                        <div class="dropdown">
                                            <a href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown"
                                                aria-expanded="false">
                                                <i class="ri-more-2-fill"></i>
                                            </a>

                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                <li><a class="dropdown-item"
                                                        href="<?php echo e(route('evaluation.download', $evaluation->id)); ?>">Download</a>
                                                </li>

                                                <li><a class="dropdown-item"
                                                        href="<?php echo e(route('evaluation.edit', $evaluation->id)); ?>">Edit</a></li>
                                                <li>
                                                    <a class="dropdown-item" href="#"
                                                        onclick="confirmDelete(event, 'delete-form-<?php echo e($evaluation->id); ?>')">
                                                        Delete
                                                    </a>
                                                </li>
                                                <form id="delete-form-<?php echo e($evaluation->id); ?>"
                                                    action="<?php echo e(route('evaluation.destroy', $evaluation->id)); ?>"
                                                    method="POST" style="display: none;">
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

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\wamp\www\Dar-e-Arqam\resources\views/evaluation/index.blade.php ENDPATH**/ ?>