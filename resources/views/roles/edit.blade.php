@extends('layouts.master')

@section('title')
    @lang('translation.evaluation-form')
@endsection

@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            Forms
        @endslot
        @slot('title')
            Edit Teacher Performance Report
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Campus Form</h4>
                    <a href="{{ route('evaluation.index') }}" class="btn btn-primary ms-auto">Back</a>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('evaluation.update', $evaluation->id) }}">
                        @csrf
                        @method('PUT') <!-- Specify PUT for updating -->
                        <div class="row gy-4">

                            <!-- Campus Selection -->
                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="campus_id" class="form-label">Campus</label>
                                    <select class="form-select @error('campus_id') is-invalid @enderror" id="campus_id"
                                        name="campus_id" required>
                                        <option value="">Select Campus</option>
                                        @foreach ($campuses as $campus)
                                            <option value="{{ $campus->id }}"
                                                {{ $evaluation->campus_id == $campus->id ? 'selected' : '' }}>
                                                {{ $campus->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('campus_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Teacher Selection -->
                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="teacher_id" class="form-label">Teacher’s name</label>
                                    <select class="form-select @error('teacher_id') is-invalid @enderror" id="teacher_id"
                                        name="teacher_id" required>
                                        <option value="">Select Teacher</option>
                                        @foreach ($teachers as $teacher)
                                            <option value="{{ $teacher->id }}"
                                                {{ $evaluation->teacher_id == $teacher->id ? 'selected' : '' }}>
                                                {{ $teacher->first_name }} {{ $teacher->last_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('teacher_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Observer Name -->
                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="observer_name" class="form-label">Observer Name</label>
                                    <input type="text" class="form-control" id="observer_name" name="observer_name"
                                        value="{{ old('observer_name', $evaluation->observer_name) }}"
                                        placeholder="Observer Name" required>
                                </div>
                            </div>

                            <!-- Total Students -->
                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="total_students" class="form-label">Total Students</label>
                                    <input type="number" class="form-control" id="total_students" name="total_students"
                                        value="{{ old('total_students', $evaluation->total_students) }}"
                                        placeholder="Total Students" required>
                                </div>
                            </div>

                            <!-- Marks fields for evaluation sections -->
                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="appearance_dress_code" class="form-label">Appearance/Dress Code</label>
                                    <input type="number" class="form-control" id="appearance_dress_code"
                                        name="appearance_dress_code"
                                        value="{{ old('appearance_dress_code', $evaluation->appearance_dress_code) }}"
                                        placeholder="Appearance/Dress Code" required>
                                </div>
                            </div>

                            <!-- Lesson Plan -->
                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="lesson_plan" class="form-label">Lesson Plan Marks</label>
                                    <input type="number" class="form-control" id="lesson_plan" name="lesson_plan"
                                        value="{{ old('lesson_plan', $evaluation->lesson_plan) }}"
                                        placeholder="Lesson Plan Marks" required>
                                </div>
                            </div>

                            <!-- Observer Signature -->
                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="observer_signature" class="form-label">Observer Signature</label>
                                    <input type="text" class="form-control" id="observer_signature"
                                        name="observer_signature"
                                        value="{{ old('observer_signature', $evaluation->observer_signature) }}"
                                        placeholder="Observer Signature" required>
                                </div>
                            </div>

                            <!-- Standard of Lesson Plan -->
                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="standard_of_lesson_plan" class="form-label">Standard of Lesson Plan</label>
                                    <input type="number" class="form-control" id="standard_of_lesson_plan"
                                        name="standard_of_lesson_plan"
                                        value="{{ old('standard_of_lesson_plan', $evaluation->standard_of_lesson_plan) }}"
                                        placeholder="Standard of Lesson Plan" required>
                                </div>
                            </div>

                            <!-- Introduction PK Testing -->
                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="introduction_pk_testing" class="form-label">Introduction PK Testing</label>
                                    <input type="number" class="form-control" id="introduction_pk_testing"
                                        name="introduction_pk_testing"
                                        value="{{ old('introduction_pk_testing', $evaluation->introduction_pk_testing) }}"
                                        placeholder="Introduction PK Testing" required>
                                </div>
                            </div>

                            <!-- Islamization -->
                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="islamization" class="form-label">Islamization</label>
                                    <input type="number" class="form-control" id="islamization" name="islamization"
                                        value="{{ old('islamization', $evaluation->islamization) }}"
                                        placeholder="Islamization" required>
                                </div>
                            </div>

                            <!-- Gesture/Tone/Body Language -->
                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="gesture_tone_body_language" class="form-label">Gesture/Tone/Body
                                        Language</label>
                                    <input type="number" class="form-control" id="gesture_tone_body_language"
                                        name="gesture_tone_body_language"
                                        value="{{ old('gesture_tone_body_language', $evaluation->gesture_tone_body_language) }}"
                                        placeholder="Gesture/Tone/Body Language" required>
                                </div>
                            </div>

                            <!-- Communication Skill -->
                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="communication_skill" class="form-label">Communication Skill</label>
                                    <input type="number" class="form-control" id="communication_skill"
                                        name="communication_skill"
                                        value="{{ old('communication_skill', $evaluation->communication_skill) }}"
                                        placeholder="Communication Skill" required>
                                </div>
                            </div>

                            <!-- Strategies/Activities -->
                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="strategies_activities" class="form-label">Strategies/Activities</label>
                                    <input type="number" class="form-control" id="strategies_activities"
                                        name="strategies_activities"
                                        value="{{ old('strategies_activities', $evaluation->strategies_activities) }}"
                                        placeholder="Strategies/Activities" required>
                                </div>
                            </div>

                            <!-- Discipline/Class Control -->
                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="discipline_class_control" class="form-label">Discipline/Class
                                        Control</label>
                                    <input type="number" class="form-control" id="discipline_class_control"
                                        name="discipline_class_control"
                                        value="{{ old('discipline_class_control', $evaluation->discipline_class_control) }}"
                                        placeholder="Discipline/Class Control" required>
                                </div>
                            </div>
                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="tools_av_aids" class="form-label">Tools AV Aids</label>
                                    <input type="number" class="form-control" id="tools_av_aids" name="tools_av_aids"
                                        value="{{ old('tools_av_aids', $evaluation->tools_av_aids) }}"
                                        placeholder="Tools AV Aids" required>
                                </div>
                            </div>

                            <!-- Tools Illustrative Material -->
                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="tools_illustrative_material" class="form-label">Tools Illustrative
                                        Material</label>
                                    <input type="number" class="form-control" id="tools_illustrative_material"
                                        name="tools_illustrative_material"
                                        value="{{ old('tools_illustrative_material', $evaluation->tools_illustrative_material) }}"
                                        placeholder="Tools Illustrative Material" required>
                                </div>
                            </div>

                            <!-- Tools Writing Board -->
                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="tools_writing_board" class="form-label">Tools Writing Board</label>
                                    <input type="number" class="form-control" id="tools_writing_board"
                                        name="tools_writing_board"
                                        value="{{ old('tools_writing_board', $evaluation->tools_writing_board) }}"
                                        placeholder="Tools Writing Board" required>
                                </div>
                            </div>

                            <!-- Real Life Integration -->
                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="real_life_integration" class="form-label">Real Life Integration</label>
                                    <input type="number" class="form-control" id="real_life_integration"
                                        name="real_life_integration"
                                        value="{{ old('real_life_integration', $evaluation->real_life_integration) }}"
                                        placeholder="Real Life Integration" required>
                                </div>
                            </div>

                            <!-- Competency Command on Subject -->
                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="competency_command_on_subject" class="form-label">Competency Command on
                                        Subject</label>
                                    <input type="number" class="form-control" id="competency_command_on_subject"
                                        name="competency_command_on_subject"
                                        value="{{ old('competency_command_on_subject', $evaluation->competency_command_on_subject) }}"
                                        placeholder="Competency Command on Subject" required>
                                </div>
                            </div>

                            <!-- Time Management -->
                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="time_management" class="form-label">Time Management</label>
                                    <input type="number" class="form-control" id="time_management"
                                        name="time_management"
                                        value="{{ old('time_management', $evaluation->time_management) }}"
                                        placeholder="Time Management" required>
                                </div>
                            </div>

                            <!-- Evaluation Conclusion -->
                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="evaluation_conclusion" class="form-label">Evaluation Conclusion</label>
                                    <input type="number" class="form-control" id="evaluation_conclusion"
                                        name="evaluation_conclusion"
                                        value="{{ old('evaluation_conclusion', $evaluation->evaluation_conclusion) }}"
                                        placeholder="Evaluation Conclusion" required>
                                </div>
                            </div>

                            <!-- Diary Homework Checking -->
                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="diary_hw_checking" class="form-label">Diary Homework Checking</label>
                                    <input type="number" class="form-control" id="diary_hw_checking"
                                        name="diary_hw_checking"
                                        value="{{ old('diary_hw_checking', $evaluation->diary_hw_checking) }}"
                                        placeholder="Diary Homework Checking" required>
                                </div>
                            </div>

                            <!-- Call on Board -->
                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="call_on_board" class="form-label">Call on Board</label>
                                    <input type="number" class="form-control" id="call_on_board" name="call_on_board"
                                        value="{{ old('call_on_board', $evaluation->call_on_board) }}"
                                        placeholder="Call on Board" required>
                                </div>
                            </div>

                            <!-- Knowledge Gain -->
                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="knowledge_gain" class="form-label">Knowledge Gain</label>
                                    <input type="number" class="form-control" id="knowledge_gain" name="knowledge_gain"
                                        value="{{ old('knowledge_gain', $evaluation->knowledge_gain) }}"
                                        placeholder="Knowledge Gain" required>
                                </div>
                            </div>

                            <!-- Skill Gain (Spoken) -->
                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="skill_gain_spoken" class="form-label">Skill Gain (Spoken)</label>
                                    <input type="number" class="form-control" id="skill_gain_spoken"
                                        name="skill_gain_spoken"
                                        value="{{ old('skill_gain_spoken', $evaluation->skill_gain_spoken) }}"
                                        placeholder="Skill Gain (Spoken)" required>
                                </div>
                            </div>

                            <!-- Skill Gain (Written) -->
                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="skill_gain_written" class="form-label">Skill Gain (Written)</label>
                                    <input type="number" class="form-control" id="skill_gain_written"
                                        name="skill_gain_written"
                                        value="{{ old('skill_gain_written', $evaluation->skill_gain_written) }}"
                                        placeholder="Skill Gain (Written)" required>
                                </div>
                            </div>

                            <!-- Personality Trait Confidence -->
                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="personality_trait_confidence" class="form-label">Personality Trait
                                        Confidence</label>
                                    <input type="number" class="form-control" id="personality_trait_confidence"
                                        name="personality_trait_confidence"
                                        value="{{ old('personality_trait_confidence', $evaluation->personality_trait_confidence) }}"
                                        placeholder="Personality Trait Confidence" required>
                                </div>
                            </div>

                            <!-- Response of Previous Knowledge -->
                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="response_of_previous_knowledge" class="form-label">Response of Previous
                                        Knowledge</label>
                                    <input type="number" class="form-control" id="response_of_previous_knowledge"
                                        name="response_of_previous_knowledge"
                                        value="{{ old('response_of_previous_knowledge', $evaluation->response_of_previous_knowledge) }}"
                                        placeholder="Response of Previous Knowledge" required>
                                </div>
                            </div>

                            <!-- Total Marks and Percentage -->
                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="total_marks" class="form-label">Total Marks</label>
                                    <input type="number" class="form-control" id="total_marks" name="total_marks"
                                        value="{{ old('total_marks', $evaluation->total_marks) }}"
                                        placeholder="Total Marks" readonly>
                                </div>
                            </div>

                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="percentage" class="form-label">Percentage</label>
                                    <input type="number" class="form-control" id="percentage" name="percentage"
                                        value="{{ old('percentage', $evaluation->percentage) }}" placeholder="Percentage"
                                        readonly>
                                </div>
                            </div>

                            <!-- Observer Guidance -->
                            <div class="col-xxl-12">
                                <div>
                                    <label for="observer_guidance" class="form-label">Guidance by Observer</label>
                                    <textarea class="form-control" id="observer_guidance" name="observer_guidance" placeholder="Guidance by Observer"
                                        rows="3">{{ old('observer_guidance', $evaluation->observer_guidance) }}</textarea>
                                </div>
                            </div>

                            <!-- Teacher’s Views -->
                            <div class="col-xxl-12">
                                <div>
                                    <label for="teacher_views" class="form-label">Teacher’s Views</label>
                                    <textarea class="form-control" id="teacher_views" name="teacher_views" placeholder="Teacher’s Views"
                                        rows="3">{{ old('teacher_views', $evaluation->teacher_views) }}</textarea>
                                </div>
                            </div>

                        </div>

                        <div class="mt-4">
                            <button type="submit" class="btn btn-primary">Update</button>
                            <a href="{{ route('evaluation.index') }}" class="btn btn-secondary">Cancel</a>
                        </div>
                    </form>



                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#campus_id').on('change', function() {
                var campusId = $(this).val();
                if (campusId) {
                    $.ajax({
                        url: '/get-teachers/' + campusId,
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            $('#teacher_id').empty();
                            $('#teacher_id').append('<option value="">Select Teacher</option>');
                            if (Array.isArray(data) && data.length > 0) {
                                $.each(data, function(key, value) {
                                    $('#teacher_id').append('<option value="' + value
                                        .id + '">' + value.name + '</option>');
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

                // Log total marks to verify the calculation
                console.log("Total Marks:", total);

                // Set the total marks in the total_marks field
                $('#total_marks').val(total);

                // Calculate percentage (assuming max value for each field is 10, not 100)
                let maxMarks = count * 10; // Each field has a max value of 10
                let percentage = (total / maxMarks) * 100;

                // Log percentage to verify the calculation
                console.log("Percentage:", percentage.toFixed(2));

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
@endsection