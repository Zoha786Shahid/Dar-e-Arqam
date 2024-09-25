<?php $__env->startSection('title'); ?>
<?php echo app('translator')->get('translation.dashboards'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('stylesheet'); ?>
<link href="<?php echo e(URL::asset('build/libs/jsvectormap/css/jsvectormap.min.css')); ?>" rel="stylesheet" type="text/css" />
<link href="<?php echo e(URL::asset('build/libs/swiper/swiper-bundle.min.css')); ?>" rel="stylesheet" type="text/css" />
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>

<div class="row">
    <div class="col">

        <div class="h-100">
            <div class="row mb-3 pb-1">
                <div class="col-12">
                    <div class="d-flex align-items-lg-center flex-lg-row flex-column">
                        <div class="flex-grow-1">
                            <h4 class="fs-16 mb-1">Good Morning, Anna!</h4>
                            <p class="text-muted mb-0">Here's what's happening with your store
                                today.</p>
                        </div>
                        <div class="mt-3 mt-lg-0">
                            <form action="javascript:void(0);">
                                <div class="row g-3 mb-0 align-items-center">
                                    <div class="col-sm-auto">
                                        <div class="input-group">
                                            <input type="text" class="form-control border-0 dash-filter-picker shadow" data-provider="flatpickr" data-range-date="true" data-date-format="d M, Y" data-deafult-date="01 Jan 2022 to 31 Jan 2022">
                                            <div class="input-group-text bg-primary border-primary text-white">
                                                <i class="ri-calendar-2-line"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <!--end col-->
                                    <div class="col-auto">
                                        <button type="button" class="btn btn-soft-success shadow-none"><i class="ri-add-circle-line align-middle me-1"></i>
                                            Add Product</button>
                                    </div>
                                    <!--end col-->
                                    <div class="col-auto">
                                        <button type="button" class="btn btn-soft-info btn-icon waves-effect waves-light layout-rightside-btn shadow-none"><i class="ri-pulse-line"></i></button>
                                    </div>
                                    <!--end col-->
                                </div>
                                <!--end row-->
                            </form>
                        </div>
                    </div><!-- end card header -->
                </div>
                <!--end col-->
            </div>
            <!--end row-->

            <div class="row">
                <div class="col">
                    <!-- card -->
                    <div class="card card-animate">
                        <div class="card-body pt-5 pb-5">
                            <div class="row">
                                <div class="col-lg-6 offset-lg-3">
                                    <form id="staticVersionForm"
                                        
                                        method="POST" enctype="multipart/form-data">
                                        <?php echo csrf_field(); ?>

                                        <div class="form-group">
                                            <div class="col-12 mb-2">
                                                <label for=""><?php echo e(__('Image*')); ?></label>
                                            </div>
                                            <div class="col-md-12 showImage mb-3">
                                                <img src="<?php echo e(isset($data->img)? asset('assets/front/img/hero_static/' . $data->img): asset('assets/admin/img/noimage.jpg')); ?>"
                                                    alt="..." class="img-thumbnail">
                                            </div>
                                            <input type="file" name="img" id="image" class="form-control image dropify">
                                            <?php if($errors->has('img')): ?>
                                                <p class="mt-2 mb-0 text-danger"><?php echo e($errors->first('img')); ?></p>
                                            <?php endif; ?>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label for=""><?php echo e(__('Title*')); ?></label>
                                                    <input type="text" class="form-control" name="title"
                                                        value="<?php echo e($data->title ?? ''); ?>"
                                                        placeholder="<?php echo e(__('Enter title')); ?>">
                                                    <?php if($errors->has('title')): ?>
                                                        <p class="mt-2 mb-0 text-danger"><?php echo e($errors->first('title')); ?></p>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label for=""><?php echo e(__('Subtitle*')); ?></label>
                                                    <input type="text" class="form-control" name="subtitle"
                                                        value="<?php echo e($data->subtitle ?? ''); ?>"
                                                        placeholder="<?php echo e(__('Enter subtitle')); ?>">
                                                    <?php if($errors->has('subtitle')): ?>
                                                        <p class="mt-2 mb-0 text-danger"><?php echo e($errors->first('subtitle')); ?></p>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label for=""><?php echo e(__('Hero text*')); ?></label>
                                                    <textarea class="form-control" name="hero_text"
                                                        placeholder="<?php echo e(__('Enter text')); ?>"><?php echo e($data->hero_text ?? ''); ?></textarea>
                                                    <?php if($errors->has('hero_text')): ?>
                                                        <p class="mt-2 mb-0 text-danger"><?php echo e($errors->first('hero_text')); ?>

                                                        </p>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label for="btn_name"><?php echo e(__('Button Name*')); ?></label>
                                                    <input type="text" class="form-control" name="btn_name"
                                                        value="<?php echo e($data->btn_name ?? ''); ?>"
                                                        placeholder="<?php echo e(__('Enter button name')); ?>">
                                                    <?php if($errors->has('btn_name')): ?>
                                                        <p class="mt-2 mb-0 text-danger"><?php echo e($errors->first('btn_name')); ?></p>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="url"><?php echo e(__('Button URL*')); ?></label>
                                            <input type="url" class="form-control ltr" name="btn_url"
                                                value="<?php echo e($data->btn_url ?? ''); ?>" placeholder="<?php echo e(__('Enter button url')); ?>">
                                            <?php if($errors->has('btn_url')): ?>
                                                <p class="mt-2 mb-0 text-danger"><?php echo e($errors->first('btn_url')); ?></p>
                                            <?php endif; ?>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div><!-- end card -->
                </div><!-- end col -->


            </div> <!-- end row-->


        </div> <!-- end .h-100-->

    </div> <!-- end col -->

</div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('script'); ?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>
<script>
    $('.dropify').dropify({
        messages: {
            'default': 'Drag and drop a file here or click',
            'replace': 'Drag and drop or click to replace',
            'remove': 'Remove',
            'error': 'Ooops, something wrong happended.'
        }
    });
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Work\tekinity\tekinity-business-old\resources\views/admin/pages/hero-section/hero-section.blade.php ENDPATH**/ ?>