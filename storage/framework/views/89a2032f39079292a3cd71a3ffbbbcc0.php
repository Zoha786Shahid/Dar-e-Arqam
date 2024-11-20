<?php $__env->startSection('title'); ?>
    <?php echo app('translator')->get('translation.teacher-form'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <?php $__env->startComponent('components.breadcrumb'); ?>
        <?php $__env->slot('li_1'); ?>
            Forms
        <?php $__env->endSlot(); ?>
        <?php $__env->slot('title'); ?>
            Sections
        <?php $__env->endSlot(); ?>
    <?php echo $__env->renderComponent(); ?>
    <?php echo $__env->make('partials.alerts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header align-items-center d-flex justify-content-between">
                    <h4 class="card-title mb-0 flex-grow-1">Section Form</h4>
                    <div class="d-flex align-items-center justify-content-end">
                        <form action="<?php echo e(route('sections.import')); ?>" method="POST" enctype="multipart/form-data" class="me-2">
                            <?php echo csrf_field(); ?>
                            <div class="d-inline-block">
                                <label for="csv_file" class="form-label mb-0">Upload CSV</label>
                                <input type="file" name="csv_file" id="csv_file" class="form-control d-inline-block" required>
                            </div>
                            <button type="submit" class="btn btn-success mt-2">Import CSV</button>
                            
                        </form>
                        <a href="<?php echo e(route('sections.create')); ?>" class="btn btn-primary">Create Sections</a>
                    </div>
                </div>
                
                <div class="card-body">
                    <!-- Bordered Tables -->
                    <table class="table table-bordered table-nowrap">
                        <thead>
                            <tr>
                                <th scope="col">Section Name</th>
                                <th scope="col">Class Name</th>
                                <th scope="col">Code</th>
                                <th scope="col">Actions</th> <!-- Action column -->
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $sections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($section->name); ?></td>
                                    <td><?php echo e($section->class ? $section->class->name : 'N/A'); ?></td>
                                    <!-- Display Class Name -->
                                    <td><?php echo e($section->code); ?></td>
                                    <td>
                                        <!-- Check if the user has permission to edit the section -->
                                        
                                        <a href="<?php echo e(route('sections.edit', $section->id)); ?>" class="btn btn-sm btn-warning">
                                            <i class="ri-edit-line"></i> Edit
                                        </a>
                                        

                                        <!-- Check if the user has permission to delete the section -->
                                        
                                        <form id="delete-form-<?php echo e($section->id); ?>"
                                            action="<?php echo e(route('sections.destroy', $section->id)); ?>" method="POST"
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

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\wamp\www\Dar-e-Arqam\resources\views/sections/index.blade.php ENDPATH**/ ?>