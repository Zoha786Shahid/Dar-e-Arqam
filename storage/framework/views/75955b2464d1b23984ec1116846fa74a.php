

<?php $__env->startSection('title'); ?>
    <?php echo app('translator')->get('translation.seniorevaluation-form'); ?>
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
                    <h4 class="card-title mb-0 flex-grow-1"> Senior Evaluation Report</h4>
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <form method="GET" action="<?php echo e(route('seniorevaluation.index')); ?>">
                                <div class="input-group">
                                    <input type="text" name="search" class="form-control" placeholder="Search by Teacher Name"
                                        value="<?php echo e(request('search')); ?>">
                                    <button class="btn btn-primary" type="submit">Search</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <a href="<?php echo e(route('seniorevaluation.create')); ?>" class="btn btn-primary ms-auto">Create </a>
                </div><!-- end card header -->
                <div class="card-body">
                    <!-- Bordered Tables -->
                    <table class="table table-bordered table-nowrap">
                        <thead>
                            <tr>
                                <th scope="col">Teacher name</th>
                                <th scope="col">Campus</th>
                                <th scope="col">Total Marks</th>
                                <th scope="col">Created At</th>
                                <th scope="col">Action</th>
                
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $reports; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $seniorevaluation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <!-- Display the teacher's name from the relationship -->
                                    <td><?php echo e($seniorevaluation->teacher->first_name ?? 'N/A'); ?>

                                        <?php echo e($seniorevaluation->teacher->last_name ?? ''); ?></td>
                                    <!-- Display campus name -->
                                    <td><?php echo e($seniorevaluation->campus->name ?? 'N/A'); ?></td>
                                    <td><?php echo e($seniorevaluation->total_marks ?? 'N/A'); ?></td>
                                    <td><?php echo e($seniorevaluation->created_at->format('Y-m-d')); ?></td>
                                   
                                    <td>
                                        <!-- Check if the user has permission to edit the section -->
                                        
                                        <a href="<?php echo e(route('seniorevaluation.edit',  $seniorevaluation->id)); ?>" class="btn btn-sm btn-warning">
                                            <i class="ri-edit-line"></i> Edit
                                        </a>
                                        
                                        <a href="<?php echo e(route('seniorevaluation.download', $seniorevaluation->id)); ?>"
                                            class="btn btn-sm btn-success">
                                            <i class="ri-download-line"></i> Download
                                        </a>
                                        <!-- Check if the user has permission to delete the section -->
                                        
                                        <form id="delete-form-<?php echo e($seniorevaluation->id); ?>"
                                            action="<?php echo e(route('seniorevaluation.destroy', $seniorevaluation->id)); ?>" method="POST"
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

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\wamp\www\Dar-e-Arqam\resources\views/seniorEvaluation/index.blade.php ENDPATH**/ ?>