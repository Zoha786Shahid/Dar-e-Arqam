

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

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Campus Form</h4>
                    <a href="<?php echo e(route('evaluation.index')); ?>" class="btn btn-primary ms-auto">Back</a>
                </div><!-- end card header -->
                <div class="card-body">
                    <form method="POST" action="<?php echo e(route('evaluation.store')); ?>">
                        <?php echo csrf_field(); ?>
                        <div class="row gy-4">

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
                                            <option value="<?php echo e($campus->id); ?>"><?php echo e($campus->name); ?></option>
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
                                        placeholder="Observer Name" required>
                                </div>
                            </div>
                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="total_students" class="form-label">Total Students</label>
                                    <input type="number" class="form-control" id="total_students" name="total_students"
                                        placeholder="Total Students" required>
                                </div>
                            </div>


                            <!-- Marks fields for evaluation sections -->
                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="appearance_dress_code" class="form-label">Appearance/Dress code</label>
                                    <input type="number" class="form-control" id="appearance_dress_code"
                                        name="appearance_dress_code" placeholder="Appearance/Dress code" required>
                                </div>
                            </div>

                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="lesson_plan" class="form-label">Lesson Plan Marks</label>
                                    <input type="number" class="form-control" id="lesson_plan" name="lesson_plan"
                                        placeholder="Lesson Plan Marks" required>
                                </div>
                            </div>


                            <!-- Repeat similar structure for other evaluation criteria fields -->



                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="observer_signature" class="form-label">Observer Signature</label>
                                    <input type="text" class="form-control" id="observer_signature"
                                        name="observer_signature" placeholder="Observer Signature" required>
                                </div>
                            </div>
                            
                            <!-- Add the following fields to your form -->

                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="standard_of_lesson_plan" class="form-label">Standard of Lesson
                                        Plan</label>
                                    <input type="number" class="form-control" id="standard_of_lesson_plan"
                                        name="standard_of_lesson_plan" placeholder="Standard of Lesson Plan" required>
                                </div>
                            </div>

                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="introduction_pk_testing" class="form-label">Introduction PK
                                        Testing</label>
                                    <input type="number" class="form-control" id="introduction_pk_testing"
                                        name="introduction_pk_testing" placeholder="Introduction PK Testing" required>
                                </div>
                            </div>

                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="islamization" class="form-label">Islamization</label>
                                    <input type="number" class="form-control" id="islamization" name="islamization"
                                        placeholder="Islamization" required>
                                </div>
                            </div>

                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="gesture_tone_body_language" class="form-label">Gesture/Tone/Body
                                        Language</label>
                                    <input type="number" class="form-control" id="gesture_tone_body_language"
                                        name="gesture_tone_body_language" placeholder="Gesture/Tone/Body Language" required>
                                </div>
                            </div>

                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="communication_skill" class="form-label">Communication Skill</label>
                                    <input type="number" class="form-control" id="communication_skill"
                                        name="communication_skill" placeholder="Communication Skill" required>
                                </div>
                            </div>

                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="strategies_activities" class="form-label">Strategies/Activities</label>
                                    <input type="number" class="form-control" id="strategies_activities"
                                        name="strategies_activities" placeholder="Strategies/Activities" required>
                                </div>
                            </div>

                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="discipline_class_control" class="form-label">Discipline/Class
                                        Control</label>
                                    <input type="number" class="form-control" id="discipline_class_control"
                                        name="discipline_class_control" placeholder="Discipline/Class Control" required>
                                </div>
                            </div>

                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="tools_av_aids" class="form-label">Tools AV Aids</label>
                                    <input type="number" class="form-control" id="tools_av_aids" name="tools_av_aids"
                                        placeholder="Tools AV Aids" required>
                                </div>
                            </div>

                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="tools_illustrative_material" class="form-label">Tools Illustrative
                                        Material</label>
                                    <input type="number" class="form-control" id="tools_illustrative_material"
                                        name="tools_illustrative_material" placeholder="Tools Illustrative Material"
                                        required>
                                </div>
                            </div>

                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="tools_writing_board" class="form-label">Tools Writing Board</label>
                                    <input type="number" class="form-control" id="tools_writing_board"
                                        name="tools_writing_board" placeholder="Tools Writing Board" required>
                                </div>
                            </div>

                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="real_life_integration" class="form-label">Real Life Integration</label>
                                    <input type="number" class="form-control" id="real_life_integration"
                                        name="real_life_integration" placeholder="Real Life Integration" required>
                                </div>
                            </div>

                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="competency_command_on_subject" class="form-label">Competency Command on
                                        Subject</label>
                                    <input type="number" class="form-control" id="competency_command_on_subject"
                                        name="competency_command_on_subject" placeholder="Competency Command on Subject"
                                        required>
                                </div>
                            </div>

                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="time_management" class="form-label">Time Management</label>
                                    <input type="number" class="form-control" id="time_management"
                                        name="time_management" placeholder="Time Management" required>
                                </div>
                            </div>

                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="evaluation_conclusion" class="form-label">Evaluation Conclusion</label>
                                    <input type="number" class="form-control" id="evaluation_conclusion"
                                        name="evaluation_conclusion" placeholder="Evaluation Conclusion" required>
                                </div>
                            </div>

                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="diary_hw_checking" class="form-label">Diary Homework Checking</label>
                                    <input type="number" class="form-control" id="diary_hw_checking"
                                        name="diary_hw_checking" placeholder="Diary Homework Checking" required>
                                </div>
                            </div>
                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="call_on_board" class="form-label">Call on Board</label>
                                    <input type="number" class="form-control" id="call_on_board" name="call_on_board"
                                        placeholder="Call on Board" required>
                                </div>
                            </div>

                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="knowledge_gain" class="form-label">Knowledge Gain</label>
                                    <input type="number" class="form-control" id="knowledge_gain" name="knowledge_gain"
                                        placeholder="Knowledge Gain" required>
                                </div>
                            </div>

                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="skill_gain_spoken" class="form-label">Skill Gain (Spoken)</label>
                                    <input type="number" class="form-control" id="skill_gain_spoken"
                                        name="skill_gain_spoken" placeholder="Skill Gain (Spoken)" required>
                                </div>
                            </div>

                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="skill_gain_written" class="form-label">Skill Gain (Written)</label>
                                    <input type="number" class="form-control" id="skill_gain_written"
                                        name="skill_gain_written" placeholder="Skill Gain (Written)" required>
                                </div>
                            </div>

                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="personality_trait_confidence" class="form-label">Personality Trait
                                        Confidence</label>
                                    <input type="number" class="form-control" id="personality_trait_confidence"
                                        name="personality_trait_confidence" placeholder="Personality Trait Confidence"
                                        required>
                                </div>
                            </div>

                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="response_of_previous_knowledge" class="form-label">Response of Previous
                                        Knowledge</label>
                                    <input type="number" class="form-control" id="response_of_previous_knowledge"
                                        name="response_of_previous_knowledge" placeholder="Response of Previous Knowledge"
                                        required>
                                </div>
                            </div>

                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="total_marks" class="form-label">Total Marks</label>
                                    <input type="number" class="form-control" id="total_marks" name="total_marks"
                                        placeholder="Total Marks" readonly>
                                </div>
                            </div>

                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="percentage" class="form-label">Percentage</label>
                                    <input type="number" class="form-control" id="percentage" name="percentage"
                                        placeholder="Percentage" readonly>
                                </div>
                            </div>

                            <div class="col-xxl-12">
                                <div>
                                    <label for="observer_guidance" class="form-label">Guidance by Observer</label>
                                    <textarea class="form-control" id="observer_guidance" name="observer_guidance" placeholder="Guidance by Observer"
                                        rows="3"></textarea>
                                </div>
                            </div>

                            <div class="col-xxl-12">
                                <div>
                                    <label for="teacher_views" class="form-label">Teacher’s Views</label>
                                    <textarea class="form-control" id="teacher_views" name="teacher_views" placeholder="Teacher’s Views"
                                        rows="3"></textarea>
                                </div>
                            </div>



                        </div>

                        <div class="mt-4">
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <a href="<?php echo e(route('evaluation.index')); ?>" class="btn btn-secondary">Cancel</a>
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
    <!-- Load jQuery before your script -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Your other script files -->
    <script src="<?php echo e(URL::asset('build/libs/prismjs/prism.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('build/js/app.js')); ?>"></script>

    <script>
        $(document).ready(function() {
            $('#campus_id').on('change', function() {
                var campusId = $(this).val(); // Get the selected campus ID
                if (campusId) {
                    $.ajax({
                        url: '/get-teachers/' + campusId, // Correct route for fetching teachers
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            $('#teacher_id').empty(); // Clear the dropdown
                            $('#teacher_id').append(
                                '<option value="">Select Teacher</option>'); // Default option

                            if (Array.isArray(data) && data.length > 0) {
                                $.each(data, function(index, teacher) {
                                    // Combine only the teacher's first and last name
                                    const teacherName =
                                        `${teacher.first_name} ${teacher.last_name}`;
                                    $('#teacher_id').append(
                                        `<option value="${teacher.id}">${teacherName}</option>`
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
                        }
                    });
                } else {
                    $('#teacher_id').empty();
                    $('#teacher_id').append('<option value="">Select Teacher</option>');
                }
            });
        });
    </script>



<?php $__env->startSection('script'); ?>
    

    <script>
        $(document).ready(function() {
            // List of all input field IDs
            const fields = [
                'appearance_dress_code',
                'lesson_plan',
                'standard_of_lesson_plan',
                'introduction_pk_testing',
                'islamization',
                'gesture_tone_body_language',
                'communication_skill',
                'strategies_activities',
                'discipline_class_control',
                'tools_av_aids',
                'tools_illustrative_material',
                'tools_writing_board',
                'real_life_integration',
                'competency_command_on_subject',
                'time_management',
                'evaluation_conclusion',
                'diary_hw_checking',
                'call_on_board',
                'knowledge_gain',
                'skill_gain_spoken',
                'skill_gain_written',
                'personality_trait_confidence',
                'response_of_previous_knowledge'
            ];

            function calculateTotalAndPercentage() {
                let total = 0;
                let count = fields.length; // The total number of fields

                // Iterate through each field and sum up the values
                fields.forEach(function(field) {
                    const fieldValue = parseInt($(`#${field}`).val()) || 0; // Default to 0 if empty
                    total += fieldValue;
                });

                // Set the total marks in the total_marks field
                $('#total_marks').val(total);

                // Calculate percentage (assuming max value for each field is 10)
                let maxMarks = count * 10; // Maximum marks for all fields (23 fields with max 10 each)
                let percentage = (total / maxMarks) * 100;

                // Set the calculated percentage in the percentage field
                $('#percentage').val(percentage.toFixed(2)); // Round to 2 decimal places
            }

            // Attach an event listener to all the fields to trigger the calculation when values change
            fields.forEach(function(field) {
                $(`#${field}`).on('input', function() {
                    calculateTotalAndPercentage();
                });
            });
        });
    </script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\wamp\www\Dar-e-Arqam\resources\views/evaluation/create.blade.php ENDPATH**/ ?>