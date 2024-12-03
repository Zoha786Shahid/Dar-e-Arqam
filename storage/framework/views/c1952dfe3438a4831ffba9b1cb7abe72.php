

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

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">SeniorEvaluation Form</h4>
                    <a href="<?php echo e(route('seniorevaluation.index')); ?>" class="btn btn-primary ms-auto">Back</a>
                </div><!-- end card header -->
                <div class="card-body">
                    <form method="POST" action="<?php echo e(route('seniorevaluation.update', $evaluation->id)); ?>">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('PUT'); ?>
                        <div class="row gy-4">

                            <!-- Campus Selection -->
                            <div class="col-xxl-4 col-md-6">
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
                                        <option value="">Select Campus</option>
                                        <?php $__currentLoopData = $campuses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $campus): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($campus->id); ?>"
                                                <?php echo e($evaluation->campus_id == $campus->id ? 'selected' : ''); ?>>
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

                            <!-- Teacher Selection -->
                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="teacher_id" class="form-label">Teacher’s name</label>
                                    <select class="form-select <?php $__errorArgs = ['teacher_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="teacher_id"
                                        name="teacher_id" required>
                                        <option value="">Select Teacher</option>
                                        <?php $__currentLoopData = $teachers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $teacher): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($teacher->id); ?>"
                                                <?php echo e($evaluation->teacher_id == $teacher->id ? 'selected' : ''); ?>>
                                                <?php echo e($teacher->first_name); ?> <?php echo e($teacher->last_name); ?>

                                            </option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                    <?php $__errorArgs = ['teacher_id'];
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

                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="observer_name" class="form-label">Observer Name</label>
                                    <input type="text" class="form-control" id="observer_name" name="observer_name"
                                        value="<?php echo e(old('observer_name', $evaluation->observer_name)); ?>"
                                        placeholder="Observer Name" required>
                                </div>
                            </div>

                            <!-- Evaluation Fields -->
                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="entrance_welcome_marks" class="form-label">Entrance Welcome Marks</label>
                                    <input type="number" class="form-control" id="entrance_welcome_marks"
                                        oninput="calculateTotal()" name="entrance_welcome_marks" min="0"
                                        max="10"
                                        value="<?php echo e(old('entrance_welcome_marks', $evaluation->entrance_welcome_marks)); ?>"
                                        required>
                                </div>
                            </div>

                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="appearance_dress_code_marks" class="form-label">Appearance & Dress Code
                                        Marks</label>
                                    <input type="number" class="form-control" id="appearance_dress_code_marks"
                                        oninput="calculateTotal()" name="appearance_dress_code_marks" min="0"
                                        max="10"
                                        value="<?php echo e(old('appearance_dress_code_marks', $evaluation->appearance_dress_code_marks)); ?>"
                                        required>
                                </div>
                            </div>

                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="seating_cleanliness_marks" class="form-label">Seating & Cleanliness
                                        Marks</label>
                                    <input type="number" class="form-control" id="seating_cleanliness_marks"
                                        oninput="calculateTotal()" name="seating_cleanliness_marks" min="0"
                                        max="10"
                                        value="<?php echo e(old('seating_cleanliness_marks', $evaluation->seating_cleanliness_marks)); ?>"
                                        required>
                                </div>
                            </div>

                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="writing_board_prep_marks" class="form-label">Writing Board Preparation
                                        Marks</label>
                                    <input type="number" class="form-control" id="writing_board_prep_marks"
                                        oninput="calculateTotal()" name="writing_board_prep_marks" min="0"
                                        max="10"
                                        value="<?php echo e(old('writing_board_prep_marks', $evaluation->writing_board_prep_marks)); ?>"
                                        required>
                                </div>
                            </div>

                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="writing_board_use_marks" class="form-label">Writing Board Use Marks</label>
                                    <input type="number" class="form-control" id="writing_board_use_marks"
                                        oninput="calculateTotal()" name="writing_board_use_marks" min="0"
                                        max="10"
                                        value="<?php echo e(old('writing_board_use_marks', $evaluation->writing_board_use_marks)); ?>"
                                        required>
                                </div>
                            </div>

                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="syllabus_division_marks" class="form-label">Syllabus Division Marks</label>
                                    <input type="number" class="form-control" id="syllabus_division_marks"
                                        oninput="calculateTotal()" name="syllabus_division_marks" min="0"
                                        max="10"
                                        value="<?php echo e(old('syllabus_division_marks', $evaluation->syllabus_division_marks)); ?>"
                                        required>
                                </div>
                            </div>

                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="assessment_start_marks" class="form-label">Assessment Start Marks</label>
                                    <input type="number" class="form-control" id="assessment_start_marks"
                                        oninput="calculateTotal()" name="assessment_start_marks" min="0"
                                        max="10"
                                        value="<?php echo e(old('assessment_start_marks', $evaluation->assessment_start_marks)); ?>"
                                        required>
                                </div>
                            </div>

                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="pk_testing_marks" class="form-label">PK Testing Marks</label>
                                    <input type="number" class="form-control" id="pk_testing_marks"
                                        oninput="calculateTotal()" name="pk_testing_marks"
                                        value="<?php echo e(old('pk_testing_marks', $evaluation->pk_testing_marks)); ?>"
                                        min="0" max="10" required>
                                </div>
                            </div>

                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="av_activities_marks" class="form-label">AV Activities Marks</label>
                                    <input type="number" class="form-control" id="av_activities_marks"
                                        oninput="calculateTotal()" name="av_activities_marks" min="0"
                                        max="10"
                                        value="<?php echo e(old('av_activities_marks', $evaluation->av_activities_marks)); ?>"
                                        required>
                                </div>
                            </div>

                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="teaching_methods_marks" class="form-label">Teaching Methods Marks</label>
                                    <input type="number" class="form-control" id="teaching_methods_marks"
                                        oninput="calculateTotal()" name="teaching_methods_marks" min="0"
                                        max="10"
                                        value="<?php echo e(old('teaching_methods_marks', $evaluation->teaching_methods_marks)); ?>"
                                        required>
                                </div>
                            </div>

                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="subject_command_marks" class="form-label">Subject Command Marks</label>
                                    <input type="number" class="form-control" id="subject_command_marks"
                                        oninput="calculateTotal()" name="subject_command_marks" min="0"
                                        max="10"
                                        value="<?php echo e(old('subject_command_marks', $evaluation->subject_command_marks)); ?>"
                                        required>
                                </div>
                            </div>

                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="student_clarity_marks" class="form-label">Student Clarity Marks</label>
                                    <input type="number" class="form-control" id="student_clarity_marks"
                                        oninput="calculateTotal()" name="student_clarity_marks" min="0"
                                        max="10"
                                        value="<?php echo e(old('student_clarity_marks', $evaluation->student_clarity_marks)); ?>"
                                        required>
                                </div>
                            </div>

                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="student_involvement_marks" class="form-label">Student Involvement
                                        Marks</label>
                                    <input type="number" class="form-control" id="student_involvement_marks"
                                        oninput="calculateTotal()" name="student_involvement_marks" min="0"
                                        max="10"
                                        value="<?php echo e(old('student_involvement_marks', $evaluation->student_involvement_marks)); ?>"
                                        required>
                                </div>
                            </div>

                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="individual_attention_marks" class="form-label">Individual Attention
                                        Marks</label>
                                    <input type="number" class="form-control" id="individual_attention_marks"
                                        oninput="calculateTotal()" name="individual_attention_marks" min="0"
                                        max="10"
                                        value="<?php echo e(old('individual_attention_marks', $evaluation->individual_attention_marks)); ?>"
                                        required>
                                </div>
                            </div>

                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="copy_work_marks" class="form-label">Copy Work Marks</label>
                                    <input type="number" class="form-control" id="copy_work_marks"
                                        oninput="calculateTotal()" name="copy_work_marks" min="0" max="10"
                                        value="<?php echo e(old('copy_work_marks', $evaluation->copy_work_marks)); ?>" required>
                                </div>
                            </div>

                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="moral_training_marks" class="form-label">Moral Training Marks</label>
                                    <input type="number" class="form-control" id="moral_training_marks"
                                        oninput="calculateTotal()" name="moral_training_marks" min="0"
                                        max="10"
                                        value="<?php echo e(old('moral_training_marks', $evaluation->moral_training_marks)); ?>"
                                        required>
                                </div>
                            </div>

                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="reading_marking_objective_marks" class="form-label">Reading/Marking
                                        Objective Marks</label>
                                    <input type="number" class="form-control" id="reading_marking_objective_marks"
                                        oninput="calculateTotal()" name="reading_marking_objective_marks" min="0"
                                        max="10"
                                        value="<?php echo e(old('reading_marking_objective_marks', $evaluation->reading_marking_objective_marks)); ?>"
                                        required>
                                </div>
                            </div>

                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="lecture_planning_marks" class="form-label">Lecture Planning Marks</label>
                                    <input type="number" class="form-control" id="lecture_planning_marks"
                                        oninput="calculateTotal()" name="lecture_planning_marks" min="0"
                                        max="10"
                                        value="<?php echo e(old('lecture_planning_marks', $evaluation->lecture_planning_marks)); ?>"
                                        required>
                                </div>
                            </div>

                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="time_management_marks" class="form-label">Time Management Marks</label>
                                    <input type="number" class="form-control" id="time_management_marks"
                                        oninput="calculateTotal()" name="time_management_marks" min="0"
                                        max="10"
                                        value="<?php echo e(old('time_management_marks', $evaluation->time_management_marks)); ?>"
                                        required>
                                </div>
                            </div>

                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="spoken_english_marks" class="form-label">Spoken English Marks</label>
                                    <input type="number" class="form-control" id="spoken_english_marks"
                                        oninput="calculateTotal()" name="spoken_english_marks" min="0"
                                        max="10"
                                        value="<?php echo e(old('spoken_english_marks', $evaluation->spoken_english_marks)); ?>"
                                        required>
                                </div>
                            </div>

                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="evaluation_marks" class="form-label">Evaluation Marks</label>
                                    <input type="number" class="form-control" id="evaluation_marks"
                                        oninput="calculateTotal()" name="evaluation_marks" min="0" max="10"
                                        value="<?php echo e(old('evaluation_marks', $evaluation->evaluation_marks)); ?>" required>
                                </div>
                            </div>

                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="home_task_checking_marks" class="form-label">Home Task Checking
                                        Marks</label>
                                    <input type="number" class="form-control" id="home_task_checking_marks"
                                        oninput="calculateTotal()" name="home_task_checking_marks" min="0"
                                        max="10"
                                        value="<?php echo e(old('home_task_checking_marks', $evaluation->home_task_checking_marks)); ?>"
                                        required>
                                </div>
                            </div>

                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="class_discipline_marks" class="form-label">Class Discipline Marks</label>
                                    <input type="number" class="form-control" id="class_discipline_marks"
                                        oninput="calculateTotal()" name="class_discipline_marks" min="0"
                                        value="<?php echo e(old('class_discipline_marks', $evaluation->class_discipline_marks)); ?>"
                                        max="10" required>
                                </div>
                            </div>

                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="total_marks" class="form-label">Total Marks</label>
                                    <input type="number" class="form-control" id="total_marks" name="total_marks"
                                        value="<?php echo e(old('total_marks', $evaluation->total_marks)); ?>"
                                        placeholder="Total Marks" readonly>
                                </div>
                            </div>

                            <div class="col-xxl-12">
                                <div>
                                    <label for="observer_guidance" class="form-label">Guidance by Observer</label>
                                    <textarea class="form-control" id="observer_guidance" name="observer_guidance" placeholder="Guidance by Observer"
                                        rows="3"><?php echo e(old('observer_guidance', $evaluation->observer_guidance)); ?></textarea>
                                </div>
                            </div>

                            <!-- Teacher’s Views -->
                            <div class="col-xxl-12">
                                <div>
                                    <label for="teacher_views" class="form-label">Teacher’s Views</label>
                                    <textarea class="form-control" id="teacher_views" name="teacher_views" placeholder="Teacher’s Views"
                                        rows="3"><?php echo e(old('teacher_views', $evaluation->teacher_views)); ?></textarea>
                                </div>
                            </div>

                        </div>

                        <div class="mt-4">
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <a href="<?php echo e(route('seniorevaluation.index')); ?>" class="btn btn-secondary">Cancel</a>
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Store the initially selected teacher ID (for edit view)
            const selectedTeacherId = "<?php echo e($evaluation->teacher_id); ?>";

            $('#campus_id').on('change', function() {
                const campusId = $(this).val();
                if (campusId) {
                    $.ajax({
                        url: '/get-teachers/' + campusId, // API endpoint for fetching teachers
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            $('#teacher_id').empty(); // Clear the dropdown
                            $('#teacher_id').append(
                                '<option value="">Select Teacher</option>'); // Default option

                            if (Array.isArray(data) && data.length > 0) {
                                $.each(data, function(index, teacher) {
                                    const isSelected = selectedTeacherId == teacher.id ?
                                        'selected' : ''; // Retain selected teacher
                                    const teacherName =
                                        `${teacher.first_name} ${teacher.last_name}`;
                                    $('#teacher_id').append(
                                        `<option value="${teacher.id}" ${isSelected}>${teacherName}</option>`
                                    );
                                });
                            } else {
                                $('#teacher_id').append(
                                    '<option value="">No Teachers Available</option>');
                            }
                        },
                        error: function() {
                            $('#teacher_id').empty();
                            $('#teacher_id').append(
                                '<option value="">Error loading teachers</option>');
                        },
                    });
                } else {
                    $('#teacher_id').empty();
                    $('#teacher_id').append('<option value="">Select Teacher</option>');
                }
            });

            // Trigger change event on page load if a campus is already selected
            if ($('#campus_id').val()) {
                $('#campus_id').trigger('change');
            }
        });
    </script>


<?php $__env->startSection('script'); ?>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        function calculateTotal() {
            let total = 0;

            // List of field IDs
            const fields = [
                'entrance_welcome_marks',
                'appearance_dress_code_marks',
                'seating_cleanliness_marks',
                'writing_board_prep_marks',
                'writing_board_use_marks',
                'syllabus_division_marks',
                'assessment_start_marks',
                'pk_testing_marks',
                'av_activities_marks',
                'teaching_methods_marks',
                'subject_command_marks',
                'student_clarity_marks',
                'student_involvement_marks',
                'individual_attention_marks',
                'copy_work_marks',
                'moral_training_marks',
                'reading_marking_objective_marks',
                'lecture_planning_marks',
                'time_management_marks',
                'spoken_english_marks',
                'evaluation_marks',
                'home_task_checking_marks',
                'class_discipline_marks'
            ];

            // Loop through each field and add its value to the total
            fields.forEach(function(field) {
                const value = parseInt(document.getElementById(field).value) || 0; // Use 0 if the field is empty
                total += value;
            });

            // Display the total in the total_marks field
            document.getElementById('total_marks').value = total;
        }
    </script>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\wamp\www\Dar-e-Arqam\resources\views/seniorEvaluation/edit.blade.php ENDPATH**/ ?>