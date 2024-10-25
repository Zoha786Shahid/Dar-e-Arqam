

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
                                <th scope="col">Subjects</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><?php echo e($teacher->name); ?></td>
                                <td><?php echo e($teacher->employee_id); ?></td>
                                <td><?php echo e($teacher->qualification); ?></td>
                                <td><?php echo e($teacher->experience); ?></td>
                                <td><?php echo e($teacher->subjects); ?></td>
                            </tr>
                        </tbody>
                    </table>
                
                    <a href="<?php echo e(route('teachers.index')); ?>" class="btn btn-primary mt-3">Back to List</a>
                </div>

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

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\wamp\www\Dar-e-Arqam\resources\views/teachers/show.blade.php ENDPATH**/ ?>