

<?php $__env->startSection('title'); ?>
    <?php echo app('translator')->get('translation.campus-form'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <?php $__env->startComponent('components.breadcrumb'); ?>
        <?php $__env->slot('li_1'); ?>
            Forms
        <?php $__env->endSlot(); ?>
        <?php $__env->slot('title'); ?>
            Edit  Teacher Performance Report
        <?php $__env->endSlot(); ?>
    <?php echo $__env->renderComponent(); ?>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Edit  Teacher Performance Report</h4>
                    <a href="<?php echo e(route('evaluation.index')); ?>" class="btn btn-primary ms-auto">Back</a>
                </div><!-- end card header -->
                <div class="card-body">
                    <!-- Form for editing campus -->
                    <form method="POST" action="<?php echo e(route('evaluation.update', $evaluation->id)); ?>">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('PUT'); ?>
                        <div class="row gy-4">
                    
                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="teacher_name" class="form-label">Teacher’s name</label>
                                    <input type="text" class="form-control" id="teacher_name" name="teacher_name"
                                        value="<?php echo e(old('teacher_name', $evaluation->teacher_name)); ?>" required>
                                </div>
                            </div>
                    
                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="qualification" class="form-label">Qualification</label>
                                    <input type="text" class="form-control" id="qualification" name="qualification"
                                        value="<?php echo e(old('qualification', $evaluation->qualification)); ?>" required>
                                </div>
                            </div>
                    
                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="joining_date" class="form-label">Joining Date</label>
                                    <input type="date" class="form-control" id="joining_date" name="joining_date"
                                        value="<?php echo e(old('joining_date', $evaluation->joining_date)); ?>" required>
                                </div>
                            </div>
                    
                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="class_section" class="form-label">Class/Sec</label>
                                    <input type="text" class="form-control" id="class_section" name="class_section"
                                        value="<?php echo e(old('class_section', $evaluation->class_section)); ?>" required>
                                </div>
                            </div>
                    
                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="subject" class="form-label">Subject</label>
                                    <input type="text" class="form-control" id="subject" name="subject"
                                        value="<?php echo e(old('subject', $evaluation->subject)); ?>" required>
                                </div>
                            </div>
                    
                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="topic" class="form-label">Topic</label>
                                    <input type="text" class="form-control" id="topic" name="topic"
                                        value="<?php echo e(old('topic', $evaluation->topic)); ?>">
                                </div>
                            </div>
                    
                            <!-- Campus -->
                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="campus_id" class="form-label">Campus</label>
                                    <select class="form-select" id="campus_id" name="campus_id" required>
                                        <?php $__currentLoopData = $campuses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $campus): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($campus->id); ?>"
                                                <?php echo e(old('campus_id', $evaluation->campus_id) == $campus->id ? 'selected' : ''); ?>>
                                                <?php echo e($campus->name); ?>

                                            </option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                            </div>
                            <!--end col-->
                    
                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="total_students" class="form-label">Total Students</label>
                                    <input type="number" class="form-control" id="total_students" name="total_students"
                                        value="<?php echo e(old('total_students', $evaluation->total_students)); ?>" required>
                                </div>
                            </div>
                    
                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="date" class="form-label">Date</label>
                                    <input type="date" class="form-control" id="date" name="date"
                                        value="<?php echo e(old('date', $evaluation->date)); ?>" required>
                                </div>
                            </div>
                    
                            <!-- Marks fields for evaluation sections -->
                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="appearance_dress_code" class="form-label">Appearance/Dress code</label>
                                    <input type="number" class="form-control" id="appearance_dress_code" name="appearance_dress_code"
                                        value="<?php echo e(old('appearance_dress_code', $evaluation->appearance_dress_code)); ?>" required>
                                </div>
                            </div>
                    
                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="lesson_plan" class="form-label">Lesson Plan Marks</label>
                                    <input type="number" class="form-control" id="lesson_plan" name="lesson_plan"
                                        value="<?php echo e(old('lesson_plan', $evaluation->lesson_plan)); ?>" required>
                                </div>
                            </div>
                    
                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="assessment" class="form-label">Assessment</label>
                                    <input type="number" class="form-control" id="assessment" name="assessment"
                                        value="<?php echo e(old('assessment', $evaluation->assessment)); ?>">
                                </div>
                            </div>
                    
                            <!-- Repeat similar structure for other evaluation criteria fields -->
                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="observer_name" class="form-label">Observer Name</label>
                                    <input type="text" class="form-control" id="observer_name" name="observer_name"
                                        value="<?php echo e(old('observer_name', $evaluation->observer_name)); ?>" required>
                                </div>
                            </div>
                    
                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="observer_signature" class="form-label">Observer Signature</label>
                                    <input type="text" class="form-control" id="observer_signature" name="observer_signature"
                                        value="<?php echo e(old('observer_signature', $evaluation->observer_signature)); ?>" required>
                                </div>
                            </div>
                    
                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="standard_of_lesson_plan" class="form-label">Standard of Lesson Plan</label>
                                    <input type="number" class="form-control" id="standard_of_lesson_plan" name="standard_of_lesson_plan"
                                        value="<?php echo e(old('standard_of_lesson_plan', $evaluation->standard_of_lesson_plan)); ?>" required>
                                </div>
                            </div>
                    
                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="introduction_pk_testing" class="form-label">Introduction PK Testing</label>
                                    <input type="number" class="form-control" id="introduction_pk_testing" name="introduction_pk_testing"
                                        value="<?php echo e(old('introduction_pk_testing', $evaluation->introduction_pk_testing)); ?>" required>
                                </div>
                            </div>
                    
                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="islamization" class="form-label">Islamization</label>
                                    <input type="number" class="form-control" id="islamization" name="islamization"
                                        value="<?php echo e(old('islamization', $evaluation->islamization)); ?>" required>
                                </div>
                            </div>
                    
                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="gesture_tone_body_language" class="form-label">Gesture/Tone/Body Language</label>
                                    <input type="number" class="form-control" id="gesture_tone_body_language" name="gesture_tone_body_language"
                                        value="<?php echo e(old('gesture_tone_body_language', $evaluation->gesture_tone_body_language)); ?>" required>
                                </div>
                            </div>
                    
                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="communication_skill" class="form-label">Communication Skill</label>
                                    <input type="number" class="form-control" id="communication_skill" name="communication_skill"
                                        value="<?php echo e(old('communication_skill', $evaluation->communication_skill)); ?>" required>
                                </div>
                            </div>
                    
                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="strategies_activities" class="form-label">Strategies/Activities</label>
                                    <input type="number" class="form-control" id="strategies_activities" name="strategies_activities"
                                        value="<?php echo e(old('strategies_activities', $evaluation->strategies_activities)); ?>" required>
                                </div>
                            </div>
                    
                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="discipline_class_control" class="form-label">Discipline/Class Control</label>
                                    <input type="number" class="form-control" id="discipline_class_control" name="discipline_class_control"
                                        value="<?php echo e(old('discipline_class_control', $evaluation->discipline_class_control)); ?>" required>
                                </div>
                            </div>
                    
                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="tools_av_aids" class="form-label">Tools AV Aids</label>
                                    <input type="number" class="form-control" id="tools_av_aids" name="tools_av_aids"
                                        value="<?php echo e(old('tools_av_aids', $evaluation->tools_av_aids)); ?>" required>
                                </div>
                            </div>
                    
                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="tools_illustrative_material" class="form-label">Tools Illustrative Material</label>
                                    <input type="number" class="form-control" id="tools_illustrative_material" name="tools_illustrative_material"
                                        value="<?php echo e(old('tools_illustrative_material', $evaluation->tools_illustrative_material)); ?>" required>
                                </div>
                            </div>
                    
                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="tools_writing_board" class="form-label">Tools Writing Board</label>
                                    <input type="number" class="form-control" id="tools_writing_board" name="tools_writing_board"
                                        value="<?php echo e(old('tools_writing_board', $evaluation->tools_writing_board)); ?>" required>
                                </div>
                            </div>
                    
                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="real_life_integration" class="form-label">Real Life Integration</label>
                                    <input type="number" class="form-control" id="real_life_integration" name="real_life_integration"
                                        value="<?php echo e(old('real_life_integration', $evaluation->real_life_integration)); ?>" required>
                                </div>
                            </div>
                    
                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="competency_command_on_subject" class="form-label">Competency Command on Subject</label>
                                    <input type="number" class="form-control" id="competency_command_on_subject" name="competency_command_on_subject"
                                        value="<?php echo e(old('competency_command_on_subject', $evaluation->competency_command_on_subject)); ?>" required>
                                </div>
                            </div>
                    
                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="time_management" class="form-label">Time Management</label>
                                    <input type="number" class="form-control" id="time_management" name="time_management"
                                        value="<?php echo e(old('time_management', $evaluation->time_management)); ?>" required>
                                </div>
                            </div>
                    
                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="evaluation_conclusion" class="form-label">Evaluation Conclusion</label>
                                    <input type="number" class="form-control" id="evaluation_conclusion" name="evaluation_conclusion"
                                        value="<?php echo e(old('evaluation_conclusion', $evaluation->evaluation_conclusion)); ?>" required>
                                </div>
                            </div>
                    
                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="diary_hw_checking" class="form-label">Diary Homework Checking</label>
                                    <input type="number" class="form-control" id="diary_hw_checking" name="diary_hw_checking"
                                        value="<?php echo e(old('diary_hw_checking', $evaluation->diary_hw_checking)); ?>" required>
                                </div>
                            </div>
                    
                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="class_participation" class="form-label">Class Participation</label>
                                    <input type="number" class="form-control" id="class_participation" name="class_participation"
                                        value="<?php echo e(old('class_participation', $evaluation->class_participation)); ?>" required>
                                </div>
                            </div>
                    
                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="call_on_board" class="form-label">Call on Board</label>
                                    <input type="number" class="form-control" id="call_on_board" name="call_on_board"
                                        value="<?php echo e(old('call_on_board', $evaluation->call_on_board)); ?>" required>
                                </div>
                            </div>
                    
                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="knowledge_gain" class="form-label">Knowledge Gain</label>
                                    <input type="number" class="form-control" id="knowledge_gain" name="knowledge_gain"
                                        value="<?php echo e(old('knowledge_gain', $evaluation->knowledge_gain)); ?>" required>
                                </div>
                            </div>
                    
                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="skill_gain_spoken" class="form-label">Skill Gain (Spoken)</label>
                                    <input type="number" class="form-control" id="skill_gain_spoken" name="skill_gain_spoken"
                                        value="<?php echo e(old('skill_gain_spoken', $evaluation->skill_gain_spoken)); ?>" required>
                                </div>
                            </div>
                    
                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="skill_gain_written" class="form-label">Skill Gain (Written)</label>
                                    <input type="number" class="form-control" id="skill_gain_written" name="skill_gain_written"
                                        value="<?php echo e(old('skill_gain_written', $evaluation->skill_gain_written)); ?>" required>
                                </div>
                            </div>
                    
                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="personality_trait_confidence" class="form-label">Personality Trait Confidence</label>
                                    <input type="number" class="form-control" id="personality_trait_confidence" name="personality_trait_confidence"
                                        value="<?php echo e(old('personality_trait_confidence', $evaluation->personality_trait_confidence)); ?>" required>
                                </div>
                            </div>
                    
                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="response_of_previous_knowledge" class="form-label">Response of Previous Knowledge</label>
                                    <input type="number" class="form-control" id="response_of_previous_knowledge" name="response_of_previous_knowledge"
                                        value="<?php echo e(old('response_of_previous_knowledge', $evaluation->response_of_previous_knowledge)); ?>" required>
                                </div>
                            </div>
                    
                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="total_marks" class="form-label">Total Marks</label>
                                    <input type="number" class="form-control" id="total_marks" name="total_marks"
                                        value="<?php echo e(old('total_marks', $evaluation->total_marks)); ?>" required>
                                </div>
                            </div>
                    
                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="percentage" class="form-label">Percentage</label>
                                    <input type="number" class="form-control" id="percentage" name="percentage"
                                        value="<?php echo e(old('percentage', $evaluation->percentage)); ?>" required>
                                </div>
                            </div>
                    
                            <div class="col-xxl-12">
                                <div>
                                    <label for="observer_guidance" class="form-label">Guidance by Observer</label>
                                    <textarea class="form-control" id="observer_guidance" name="observer_guidance"
                                        rows="3"><?php echo e(old('observer_guidance', $evaluation->observer_guidance)); ?></textarea>
                                </div>
                            </div>
                    
                            <div class="col-xxl-12">
                                <div>
                                    <label for="teacher_views" class="form-label">Teacher’s Views</label>
                                    <textarea class="form-control" id="teacher_views" name="teacher_views"
                                        rows="3"><?php echo e(old('teacher_views', $evaluation->teacher_views)); ?></textarea>
                                </div>
                            </div>
                    
                            <div class="col-xxl-12">
                                <div>
                                    <label for="teacher_signature" class="form-label">Teacher’s Signature</label>
                                    <input type="text" class="form-control" id="teacher_signature" name="teacher_signature"
                                        value="<?php echo e(old('teacher_signature', $evaluation->teacher_signature)); ?>" required>
                                </div>
                            </div>
                    
                        </div>
                    
                        <div class="mt-4">
                            <button type="submit" class="btn btn-primary">Update</button>
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
    <script src="<?php echo e(URL::asset('build/libs/prismjs/prism.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('build/js/app.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\wamp\www\Dar-e-Arqam\resources\views/evaluation/edit.blade.php ENDPATH**/ ?>