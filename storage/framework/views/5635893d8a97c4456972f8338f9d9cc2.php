

<?php $__env->startSection('title'); ?>
    <?php echo app('translator')->get('translation.edit-teacher'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <?php $__env->startComponent('components.breadcrumb'); ?>
        <?php $__env->slot('li_1'); ?>
            Forms
        <?php $__env->endSlot(); ?>
        <?php $__env->slot('title'); ?>
            Edit Teacher Form
        <?php $__env->endSlot(); ?>
    <?php echo $__env->renderComponent(); ?>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1"> Edit Teacher Form </h4>
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $erros): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($erros); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <a href="<?php echo e(route('teacher.index')); ?>" class="btn btn-primary ms-auto">Back</a>
                </div>
                <div class="card-body">
                    <form method="POST" action="<?php echo e(route('teacher.update', $teacher->id)); ?>" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('PUT'); ?>
                        <div class="row gy-4">
                            <?php
                                $fields = [
                                    'first_name' => 'First Name',
                                    'last_name' => 'Last Name',
                                    'date_of_birth' => 'Date of Birth',
                                    'phone_number' => 'Phone Number',
                                    'email' => 'Email',
                                    'employee_id' => 'Employee ID',
                                    'qualification' => 'Qualification',
                                    'experience' => 'Experience (Years)',
                                    'hire_date' => 'Hire Date',
                                    'address' => 'Address',
                                ];
                            ?>
                            <?php $__currentLoopData = $fields; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $field => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="col-xxl-3 col-md-6">
                                    <div>
                                        <label for="<?php echo e($field); ?>" class="form-label"><?php echo e($label); ?></label>
                                        <input
                                            type="<?php echo e(in_array($field, ['date_of_birth', 'hire_date']) ? 'date' : 'text'); ?>"
                                            class="form-control <?php $__errorArgs = [$field];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                            id="<?php echo e($field); ?>" name="<?php echo e($field); ?>"
                                            value="<?php echo e(old($field, $teacher->$field)); ?>" required>
                                        <?php $__errorArgs = [$field];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <div class="invalid-feedback"><?php echo e($message); ?></div>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            <div class="col-xxl-3 col-md-6">
                                <div>
                                    <label for="gender" class="form-label">Gender</label>
                                    <select class="form-select <?php $__errorArgs = ['gender'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="gender"
                                        name="gender" required>
                                        <option value="male" <?php echo e($teacher->gender === 'male' ? 'selected' : ''); ?>>Male
                                        </option>
                                        <option value="female" <?php echo e($teacher->gender === 'female' ? 'selected' : ''); ?>>Female
                                        </option>
                                        <option value="other" <?php echo e($teacher->gender === 'other' ? 'selected' : ''); ?>>Other
                                        </option>
                                    </select>
                                    <?php $__errorArgs = ['gender'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <div class="invalid-feedback"><?php echo e($message); ?></div>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                            </div>

                            <div class="col-xxl-3 col-md-6">
                                <div>
                                    <label for="campus_id" class="form-label">Campus</label>
                                    <select class="form-select <?php $__errorArgs = ['campus_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="campus_id"
                                        name="campus_id" required>
                                        <?php $__currentLoopData = $campuses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $campus): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($campus->id); ?>"
                                                <?php echo e($teacher->campus_id == $campus->id ? 'selected' : ''); ?>>
                                                <?php echo e($campus->name); ?>

                                            </option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                    <?php $__errorArgs = ['campus_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <div class="invalid-feedback"><?php echo e($message); ?></div>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                            </div>
                            <div class="col-xxl-12">
                                <div id="subjectClassSectionContainer">
                                    <?php $__currentLoopData = $teacher->teacherSectionSubjects ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $assignment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="row gy-3 subject-class-section-group">
                                            <!-- Hidden field for existing assignment ID -->
                                            <input type="hidden" name="assignment_ids[]" value="<?php echo e($assignment->id); ?>">

                                            <!-- Assign Subjects -->
                                            <div class="col-xxl-3 col-md-6">
                                                <label class="form-label">Assign Subjects</label>
                                                <select class="form-control js-example-disabled-multi" name="subject_ids[]"
                                                    required>
                                                    <?php $__currentLoopData = $subjects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subject): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e($subject->id); ?>"
                                                            <?php echo e(in_array($subject->id, [$assignment->subject_id]) ? 'selected' : ''); ?>>
                                                            <?php echo e($subject->name); ?>

                                                        </option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                            </div>

                                            <!-- Class Dropdown -->
                                            <div class="col-xxl-3 col-md-6">
                                                <label class="form-label">Class</label>
                                                <select class="form-select classDropdown" name="class_ids[]" required>
                                                    <?php $__currentLoopData = $classes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $class): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e($class->id); ?>"
                                                            <?php echo e($assignment->class_id == $class->id ? 'selected' : ''); ?>>
                                                            <?php echo e($class->name); ?>

                                                        </option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                            </div>

                                            <!-- Section Dropdown -->
                                            <div class="col-xxl-3 col-md-6">
                                                <label class="form-label">Section</label>
                                                <select class="form-select sectionDropdown" name="section_ids[]" required>
                                                    <?php $__currentLoopData = $sections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e($section->id); ?>"
                                                            <?php echo e($assignment->section_id == $section->id ? 'selected' : ''); ?>>
                                                            <?php echo e($section->name); ?>

                                                        </option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                            </div>
                                            <div class="col-xxl-3 col-md-2">
                                                <!-- Add More Button -->
                                                <button type="button" class="btn btn-secondary mt-4 add-more-btn">Add
                                                    More</button>
                                            </div>
                                            <!-- Remove Button -->

                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>

                            </div>

                        </div>

                        <div class="mt-4">
                            <button type="submit" class="btn btn-primary">Update</button>
                            <a href="<?php echo e(route('teacher.index')); ?>" class="btn btn-secondary">Cancel</a>
                        </div>


                    </form>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <script>
        $(document).on('click', '.add-more-btn', function() {
            let newGroup = $('.subject-class-section-group:first').clone();

            // Reset all values in the cloned group
            newGroup.find('select').each(function() {
                $(this).val(null).trigger('change'); // Reset select values
                $(this).removeAttr('data-select2-id'); // Remove Select2 ID
            });

            // Remove existing Select2 containers in the cloned group
            newGroup.find('.select2-container').remove();

            // Reinitialize Select2 for the new group
            newGroup.find('.js-example-disabled-multi').select2({
                placeholder: "Select Subject",
                allowClear: true
            });

            // Clear input values in the cloned group
            newGroup.find('input').val('');

            // Replace "Add More" button with "Remove" button in the cloned group
            newGroup.find('.add-more-btn').replaceWith(
                '<button type="button" class="btn btn-danger remove-btn mt-4">Remove</button>'
            );

            // Append the new group to the container
            $('#subjectClassSectionContainer').append(newGroup);

            // Reinitialize Select2 for the container to ensure all rows are initialized
            $('#subjectClassSectionContainer .js-example-disabled-multi').select2({
                placeholder: "Select Subject",
                allowClear: true
            });
        });

        // Remove Button Functionality
        $(document).on('click', '.remove-btn', function() {
            $(this).closest('.subject-class-section-group').remove(); // Removes the closest group
        });


        $(document).on('change', '.classDropdown', function() {
            var classId = $(this).val();
            var sectionDropdown = $(this).closest('.subject-class-section-group').find('.sectionDropdown');

            if (classId) {
                $.ajax({
                    url: '<?php echo e(route('get.sections.by.class')); ?>',
                    type: 'GET',
                    data: {
                        class_id: classId
                    },
                    success: function(data) {
                        sectionDropdown.empty().append('<option value="">Select Section</option>');
                        $.each(data.sections, function(key, section) {
                            sectionDropdown.append('<option value="' + section.id + '">' +
                                section.name + '</option>');
                        });
                    }
                });
            } else {
                sectionDropdown.empty().append('<option value="">Select Section</option>');
            }
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\wamp\www\Dar-e-Arqam\resources\views/teachers/edit.blade.php ENDPATH**/ ?>