<?php $__env->startSection('title'); ?>
    <?php echo app('translator')->get('translation.teacher-form'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <?php $__env->startComponent('components.breadcrumb'); ?>
        <?php $__env->slot('li_1'); ?>
            Forms
        <?php $__env->endSlot(); ?>
        <?php $__env->slot('title'); ?>
            Teacher
        <?php $__env->endSlot(); ?>
    <?php echo $__env->renderComponent(); ?>
    <?php echo $__env->make('partials.alerts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Teacher Form</h4>
                    <a href="<?php echo e(route('teacher.create')); ?>" class="btn btn-primary ms-auto">Create Teacher</a>
                </div><!-- end card header -->
                <div class="card-body">
                    <!-- Bordered Tables -->
                    <table class="table table-bordered table-nowrap">
                        <thead>
                            <tr>
                                <th scope="col">Name</th>
                                <th scope="col">Employee Id</th>
                                <th scope="col">Qualification</th>
                                <th scope="col">Experience</th>
                                <th scope="col">Campus</th>
                                <th scope="col">Actions</th> <!-- Action column -->
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $teachers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $teacher): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($teacher->first_name); ?></td>
                                    <td><?php echo e($teacher->employee_id); ?></td>
                                    <td><?php echo e($teacher->qualification); ?></td>
                                    <td><?php echo e($teacher->experience); ?></td>
                                    <td><?php echo e($teacher->campus ? $teacher->campus->name : 'No Campus'); ?></td> <!-- Display the campus name -->
                                    <td>
                                        <!-- Check if the user has permission to view the teacher -->


                                        <!-- Check if the user has permission to edit the teacher -->
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('update', $teacher)): ?>
                                        <a href="<?php echo e(route('teacher.edit', $teacher->id)); ?>" class="btn btn-sm btn-warning">
                                            <i class="ri-edit-line"></i> Edit
                                        </a>
                                    <?php endif; ?>
                                    

                                        <!-- Check if the user has permission to delete the teacher -->
                                        
                                        <form id="delete-form-<?php echo e($teacher->id); ?>"
                                            action="<?php echo e(route('teacher.destroy', $teacher->id)); ?>" method="POST"
                                            style="display:inline;">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('DELETE'); ?>
                                            <button type="submit" class="btn btn-sm btn-danger"
                                                onclick="return confirm('Are you sure?')">
                                                <i class="ri-delete-bin-line"></i> Delete
                                            </button>
                                        </form>
                                        


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

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\Dar-e-Arqam\resources\views/teachers/index.blade.php ENDPATH**/ ?>