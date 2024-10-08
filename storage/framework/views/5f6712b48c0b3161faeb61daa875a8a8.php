<?php $__env->startSection('title'); ?>
    <?php echo app('translator')->get('translation.campus-form'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <?php $__env->startComponent('components.breadcrumb'); ?>
        <?php $__env->slot('li_1'); ?>
            Forms
        <?php $__env->endSlot(); ?>
        <?php $__env->slot('title'); ?>
            Campus Form
        <?php $__env->endSlot(); ?>
    <?php echo $__env->renderComponent(); ?>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Campus Form</h4>
                    <a href="<?php echo e(route('campus.index')); ?>" class="btn btn-primary ms-auto">Back</a>
                </div><!-- end card header -->
                <div class="card-body">
                    <form method="POST" action="<?php echo e(route('campus.store')); ?>">
                        <?php echo csrf_field(); ?>
                        <div class="row gy-4">
                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" class="form-control" id="name" name="name" required>
                                </div>
                            </div>
                            <!--end col-->

                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="address" class="form-label">Address</label>
                                    <input type="text" class="form-control" id="address" name="address" required>
                                </div>
                            </div>
                            <!--end col-->

                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="city" class="form-label">City</label>
                                    <input type="text" class="form-control" id="city" name="city" required>
                                </div>
                            </div>
                            <!--end col-->

                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="state" class="form-label">State</label>
                                    <input type="text" class="form-control" id="state" name="state" required>
                                </div>
                            </div>
                            <!--end col-->

                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="country" class="form-label">Country</label>
                                    <input type="text" class="form-control" id="country" name="country" required>
                                </div>
                            </div>
                            <!--end col-->

                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="postal_code" class="form-label">Postal Code</label>
                                    <input type="text" class="form-control" id="postal_code" name="postal_code" required>
                                </div>
                            </div>
                            <!--end col-->

                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="phone_number" class="form-label">Phone Number</label>
                                    <input type="text" class="form-control" id="phone_number" name="phone_number"
                                        required>
                                </div>
                            </div>
                            <!--end col-->

                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" required>
                                </div>
                            </div>
                            <!--end col-->

                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="website" class="form-label">Website</label>
                                    <input type="url" class="form-control" id="website" name="website">
                                </div>
                            </div>
                            <!--end col-->

                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="principal_name" class="form-label">Principal Name</label>
                                    <input type="text" class="form-control" id="principal_name" name="principal_name">
                                </div>
                            </div>
                            <!--end col-->

                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="principal_email" class="form-label">Principal Email</label>
                                    <input type="email" class="form-control" id="principal_email" name="principal_email">
                                </div>
                            </div>
                            <!--end col-->

                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="principal_phone" class="form-label">Principal Phone</label>
                                    <input type="text" class="form-control" id="principal_phone" name="principal_phone">
                                </div>
                            </div>
                            <!--end col-->

                            <div class="col-xxl-6 col-md-6">
                                <div>
                                    <label for="capacity" class="form-label">Capacity</label>
                                    <input type="number" class="form-control" id="capacity" name="capacity">
                                </div>
                            </div>
                            <!--end col-->

                            <div class="col-xxl-6 col-md-6">
                                <div>
                                    <label for="status" class="form-label">Status</label>
                                    <select class="form-select mb-3" aria-label="Default select example" name="status">
                                        <option value="active">Active</option>
                                        <option value="inactive">Inactive</option>

                                    </select>
                                </div>
                            </div>
                            <!--end col-->

                            <div class="col-xxl-12">
                                <div>
                                    <label for="description" class="form-label">Description</label>
                                    <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                                </div>
                            </div>
                            <!--end col-->

                        </div>
                        <!--end row-->

                        <div class="mt-4">
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <a href="<?php echo e(route('campus.index')); ?>" class="btn btn-secondary">Cancel</a>
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

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\DareArqam\Dar-e-Arqam\resources\views/campus/create.blade.php ENDPATH**/ ?>