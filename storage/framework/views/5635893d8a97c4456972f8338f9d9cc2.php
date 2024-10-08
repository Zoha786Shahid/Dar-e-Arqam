

<?php $__env->startSection('title'); ?>
    <?php echo app('translator')->get('translation.campus-form'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <?php $__env->startComponent('components.breadcrumb'); ?>
        <?php $__env->slot('li_1'); ?>
            Forms
        <?php $__env->endSlot(); ?>
        <?php $__env->slot('title'); ?>
            Edit Teacher
        <?php $__env->endSlot(); ?>
    <?php echo $__env->renderComponent(); ?>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Edit Teacher</h4>
                    <a href="<?php echo e(route('teacher.index')); ?>" class="btn btn-primary ms-auto">Back</a>
                </div><!-- end card header -->
                <div class="card-body">
                    <!-- Form for editing Teacher -->

                    <form action="<?php echo e(route('teacher.update', $teacher->id)); ?>" method="POST" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('PUT'); ?> <!-- or <?php echo method_field('PATCH'); ?> for partial updates -->

                        <div class="row gy-4">
                            <!-- First Name -->
                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="first_name" class="form-label">First Name</label>
                                    <input type="text" class="form-control" id="first_name" name="first_name"
                                        value="<?php echo e(old('first_name', $teacher->first_name)); ?>" required>
                                </div>
                            </div>
                            <!--end col-->

                            <!-- Last Name -->
                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="last_name" class="form-label">Last Name</label>
                                    <input type="text" class="form-control" id="last_name" name="last_name"
                                        value="<?php echo e(old('last_name', $teacher->last_name)); ?>" required>
                                </div>
                            </div>
                            <!--end col-->

                            <!-- Date of Birth -->
                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="date_of_birth" class="form-label">Date of Birth</label>
                                    <input type="date" class="form-control" id="date_of_birth" name="date_of_birth"
                                        value="<?php echo e(old('date_of_birth', $teacher->date_of_birth)); ?>" required>
                                </div>
                            </div>
                            <!--end col-->

                            <!-- Gender -->
                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="gender" class="form-label">Gender</label>
                                    <select class="form-select" id="gender" name="gender" required>
                                        <option value="male"
                                            <?php echo e(old('gender', $teacher->gender) == 'male' ? 'selected' : ''); ?>>Male</option>
                                        <option value="female"
                                            <?php echo e(old('gender', $teacher->gender) == 'female' ? 'selected' : ''); ?>>Female
                                        </option>
                                        <option value="other"
                                            <?php echo e(old('gender', $teacher->gender) == 'other' ? 'selected' : ''); ?>>Other
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <!--end col-->

                            <!-- Phone Number -->
                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="phone_number" class="form-label">Phone Number</label>
                                    <input type="text" class="form-control" id="phone_number" name="phone_number"
                                        value="<?php echo e(old('phone_number', $teacher->phone_number)); ?>" required>
                                </div>
                            </div>
                            <!--end col-->

                            <!-- Email -->
                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" name="email"
                                        value="<?php echo e(old('email', $teacher->email)); ?>" required>
                                </div>
                            </div>
                            <!--end col-->

                            <!-- Address -->
                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="address" class="form-label">Address</label>
                                    <input type="text" class="form-control" id="address" name="address"
                                        value="<?php echo e(old('address', $teacher->address)); ?>" required>
                                </div>
                            </div>
                            <!--end col-->

                            <!-- Employee ID -->
                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="employee_id" class="form-label">Employee ID</label>
                                    <input type="text" class="form-control" id="employee_id" name="employee_id"
                                        value="<?php echo e(old('employee_id', $teacher->employee_id)); ?>" required>
                                </div>
                            </div>
                            <!--end col-->

                            <!-- Hire Date -->
                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="hire_date" class="form-label">Hire Date</label>
                                    <input type="date" class="form-control" id="hire_date" name="hire_date"
                                        value="<?php echo e(old('hire_date', $teacher->hire_date)); ?>" required>
                                </div>
                            </div>
                            <!--end col-->

                            <!-- Subjects -->
                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="subjects" class="form-label">Subjects</label>
                                    <input type="text" class="form-control" id="subjects" name="subjects"
                                        value="<?php echo e(old('subjects', $teacher->subjects)); ?>" required>
                                </div>
                            </div>
                            <!--end col-->

                            <!-- Qualification -->
                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="qualification" class="form-label">Qualification</label>
                                    <input type="text" class="form-control" id="qualification" name="qualification"
                                        value="<?php echo e(old('qualification', $teacher->qualification)); ?>" required>
                                </div>
                            </div>
                            <!--end col-->

                            <!-- Experience -->
                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="experience" class="form-label">Experience</label>
                                    <input type="text" class="form-control" id="experience" name="experience"
                                        value="<?php echo e(old('experience', $teacher->experience)); ?>" required>
                                </div>
                            </div>
                            <!--end col-->

                            <!-- Campus -->
                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="campus_id" class="form-label">Campus</label>
                                    <select class="form-select" id="campus_id" name="campus_id" required>
                                        <?php $__currentLoopData = $campuses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $campus): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($campus->id); ?>"
                                                <?php echo e(old('campus_id', $teacher->campus_id) == $campus->id ? 'selected' : ''); ?>>
                                                <?php echo e($campus->name); ?>

                                            </option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                            </div>
                            <!--end col-->
                        </div>
                        <!--end row-->

                        <div class="mt-4">
                            <button type="submit" class="btn btn-primary">Update</button>
                            <a href="<?php echo e(route('teacher.index')); ?>" class="btn btn-secondary">Cancel</a>
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

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\wamp\www\Dar-e-Arqam\resources\views/teachers/edit.blade.php ENDPATH**/ ?>