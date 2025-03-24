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
                    <h4 class="card-title mb-0 flex-grow-1">Evaluation Report</h4>
    
                    <div class="d-flex align-items-center gap-2 ms-auto">
                        
                        <form method="GET" action="<?php echo e(route('evaluation.batchDownload')); ?>" class="d-flex align-items-center">
                            <?php if(auth()->user()->hasRole('Principal') || auth()->user()->hasRole('Owner')): ?>
                                <select name="campus_id" class="form-control me-2" id="campus_id" required>
                                    <option value="">Select Campus</option>
                                    <?php $__currentLoopData = $campuses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $campus): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($campus->id); ?>" <?php echo e(old('campus_id') == $campus->id ? 'selected' : ''); ?>>
                                            <?php echo e($campus->name); ?>

                                        </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                        
                                <select class="form-control me-2 classDropdown" name="class_ids[]">
                                    <option value="">Select Class</option>
                                    <?php $__currentLoopData = $classes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $class): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($class->id); ?>"><?php echo e($class->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                        
                                <select name="teacher_id" class="form-control me-2" id="teacher_id">
                                    <option value="">Select Teacher</option>
                                    <?php if(old('campus_id')): ?>
                                        <?php $__currentLoopData = $teachers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $teacher): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($teacher->id); ?>" <?php echo e(old('teacher_id') == $teacher->id ? 'selected' : ''); ?>>
                                                <?php echo e($teacher->first_name); ?> <?php echo e($teacher->last_name); ?>

                                            </option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>
                                </select>
                        
                                <select name="subject_id" class="form-control me-2">
                                    <option value="">Select Subject</option>
                                    <?php $__currentLoopData = $subjects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subject): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($subject->id); ?>" <?php echo e(request('subject_id') == $subject->id ? 'selected' : ''); ?>>
                                            <?php echo e($subject->name); ?>

                                        </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            <?php endif; ?>
                            <button type="submit" class="btn btn-primary">Download</button>
                        </form>
                        
                   
                        <form method="GET" action="<?php echo e(route('evaluation.index')); ?>" class="d-flex align-items-center">
                            <input type="text" name="search" class="form-control me-2" placeholder="Search by Teacher Name" value="<?php echo e(request('search')); ?>">
                            <button class="btn btn-primary" type="submit">Search</button>
                        </form>
    
                        <a href="<?php echo e(route('evaluation.create')); ?>" class="btn btn-primary">Create</a>
                    </div>
    
                </div><!-- end card header -->
    
                <div class="card-body">
                    <table class="table table-bordered table-nowrap">
                        <thead>
                            <tr>
                                <th scope="col">Teacher Name</th>
                                <th scope="col">Campus</th>
                                <th scope="col">Percentage</th>
                                <th scope="col">Created At</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $evaluations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $evaluation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($evaluation->teacher->first_name ?? 'N/A'); ?> <?php echo e($evaluation->teacher->last_name ?? 'N/A'); ?></td>
                                    <td><?php echo e($evaluation->campus->name ?? 'N/A'); ?></td>
                                    <td><?php echo e($evaluation->percentage); ?>%</td>
                                    <td><?php echo e($evaluation->created_at->format('Y-m-d')); ?></td>
                                    <td>
                                        <a href="<?php echo e(route('evaluation.edit', $evaluation->id)); ?>" class="btn btn-sm btn-warning"><i class="ri-edit-line"></i> Edit</a>
                                        <a href="<?php echo e(route('evaluation.download', $evaluation->id)); ?>" class="btn btn-sm btn-success"><i class="ri-download-line"></i> Download</a>
                                        <form id="delete-form-<?php echo e($evaluation->id); ?>" action="<?php echo e(route('evaluation.destroy', $evaluation->id)); ?>" method="POST" style="display:inline;">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('DELETE'); ?>
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">
                                                <i class="ri-delete-bin-line"></i> Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div><!-- end card body -->
            </div>
        </div>
    </div>
    
    
    <!-- end row -->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
<script>
    // Update the teacher dropdown based on the selected campus
    document.getElementById('campus_id').addEventListener('change', function () {
        var campusId = this.value;

        // Make an AJAX request to fetch teachers based on selected campus
        fetch(`/get-teachers/${campusId}`)
            .then(response => response.json())
            .then(data => {
                let teacherDropdown = document.getElementById('teacher_id');
                teacherDropdown.innerHTML = '<option value="">Select Teacher</option>'; // Reset teacher options

                // Add teachers to the dropdown
                data.forEach(teacher => {
                    let option = document.createElement('option');
                    option.value = teacher.id;
                    option.textContent = `${teacher.first_name} ${teacher.last_name}`;
                    teacherDropdown.appendChild(option);
                });
            })
            .catch(error => console.log('Error:', error));
    });
</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\wamp\www\Dar-e-Arqam\resources\views/evaluation/index.blade.php ENDPATH**/ ?>