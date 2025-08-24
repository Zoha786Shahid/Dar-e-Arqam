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
            Teacher Performance Report
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Teacher Evaluation Form for Class 1 to 7</h4>
                    <a href="{{ route('evaluation.index') }}" class="btn btn-primary ms-auto">Back</a>
                </div><!-- end card header -->
                <div class="card-body">
                    <form method="POST" action="{{ route('evaluation.store') }}">
                        @csrf
                        <div class="row gy-4">
                            <div class="col-xxl-4 col-md-6">
    <div>
        <label for="campus_id" class="form-label">Campus</label>
        <select class="form-select @error('campus_id') is-invalid @enderror" id="campus_id"
            name="campus_id" required {{ auth()->user()->hasRole('Principal') ? 'disabled' : '' }}>
            <option value="">Select Campus</option>
            @foreach ($campuses as $campus)
                <option value="{{ $campus->id }}"
                    {{ (auth()->user()->hasRole('Principal') && $campus->id == auth()->user()->campus_id) ? 'selected' : '' }}>
                    {{ $campus->name }}
                </option>
            @endforeach
        </select>
        @if(auth()->user()->hasRole('Principal'))
            <input type="hidden" name="campus_id" value="{{ auth()->user()->campus_id }}">
        @endif
        @error('campus_id')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>
                            
                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="teacher_id" class="form-label">Teacher's name</label>
                                    <select class="form-select @error('teacher_id') is-invalid @enderror" id="teacher_id"
                                        name="teacher_id" onchange="fetchClasses()" required>
                                        <option value="">Select Teacher</option>
                                    </select>
                                    @error('teacher_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="class_id" class="form-label">Class</label>
                                    <select class="form-select @error('class_id') is-invalid @enderror" id="class_id" 
                                        name="class_id" onchange="fetchSections()" required>
                                        <option value="">Select Class</option>
                                    </select>
                                    @error('class_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="section_id" class="form-label">Section</label>
                                    <select class="form-select @error('section_id') is-invalid @enderror" id="section_id" 
                                        name="section_id" onchange="fetchSubjects()" required>
                                        <option value="">Select Section</option>
                                    </select>
                                    @error('section_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="subject_id" class="form-label">Subject</label>
                                    <select class="form-select @error('subject_id') is-invalid @enderror" id="subject_id" 
                                        name="subject_id" required>
                                        <option value="">Select Subject</option>
                                    </select>
                                    @error('subject_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="observer_name" class="form-label">Observer Name</label>
                                    <input type="text" class="form-control @error('observer_name') is-invalid @enderror" 
                                        id="observer_name" name="observer_name" placeholder="Observer Name" required>
                                    @error('observer_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <!-- Date Field - Today's Date (Non-editable) -->
<div class="col-xxl-4 col-md-6">
    <div>
        <label for="evaluation_date" class="form-label">Evaluation Date</label>
        <input type="date" class="form-control" id="evaluation_date" name="evaluation_date"
            value="{{ date('Y-m-d') }}" readonly style="background-color: #e9ecef;">
    </div>
</div>
                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="total_students" class="form-label">Total Students</label>
                                    <input type="number" class="form-control @error('total_students') is-invalid @enderror" 
                                        id="total_students" name="total_students" placeholder="Total Students" required>
                                    @error('total_students')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Evaluation Fields with Radio Buttons -->
                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="appearance_dress_code" class="form-label">Appearance/Dress Code</label>
                                    <div class="rating-group d-flex gap-3 mt-2">
                                        @for($i = 1; $i <= 5; $i++)
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="appearance_dress_code" 
                                                    value="{{ $i }}" id="appearance_dress_code_{{ $i }}" onchange="calculateTotalAndPercentage()">
                                                <label class="form-check-label" for="appearance_dress_code_{{ $i }}">{{ $i }}</label>
                                            </div>
                                        @endfor
                                    </div>
                                </div>
                            </div>

                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="lesson_plan" class="form-label">Lesson Plan</label>
                                    <div class="rating-group d-flex gap-3 mt-2">
                                        @for($i = 1; $i <= 5; $i++)
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="lesson_plan" 
                                                    value="{{ $i }}" id="lesson_plan_{{ $i }}" onchange="calculateTotalAndPercentage()">
                                                <label class="form-check-label" for="lesson_plan_{{ $i }}">{{ $i }}</label>
                                            </div>
                                        @endfor
                                    </div>
                                </div>
                            </div>

                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="standard_of_lesson_plan" class="form-label">Standard of Lesson Plan</label>
                                    <div class="rating-group d-flex gap-3 mt-2">
                                        @for($i = 1; $i <= 5; $i++)
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="standard_of_lesson_plan" 
                                                    value="{{ $i }}" id="standard_of_lesson_plan_{{ $i }}" onchange="calculateTotalAndPercentage()">
                                                <label class="form-check-label" for="standard_of_lesson_plan_{{ $i }}">{{ $i }}</label>
                                            </div>
                                        @endfor
                                    </div>
                                </div>
                            </div>

                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="introduction_pk_testing" class="form-label">Introduction PK Testing</label>
                                    <div class="rating-group d-flex gap-3 mt-2">
                                        @for($i = 1; $i <= 5; $i++)
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="introduction_pk_testing" 
                                                    value="{{ $i }}" id="introduction_pk_testing_{{ $i }}" onchange="calculateTotalAndPercentage()">
                                                <label class="form-check-label" for="introduction_pk_testing_{{ $i }}">{{ $i }}</label>
                                            </div>
                                        @endfor
                                    </div>
                                </div>
                            </div>

                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="islamization" class="form-label">Islamization</label>
                                    <div class="rating-group d-flex gap-3 mt-2">
                                        @for($i = 1; $i <= 5; $i++)
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="islamization" 
                                                    value="{{ $i }}" id="islamization_{{ $i }}" onchange="calculateTotalAndPercentage()">
                                                <label class="form-check-label" for="islamization_{{ $i }}">{{ $i }}</label>
                                            </div>
                                        @endfor
                                    </div>
                                </div>
                            </div>

                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="gesture_tone_body_language" class="form-label">Gesture/Tone/Body Language</label>
                                    <div class="rating-group d-flex gap-3 mt-2">
                                        @for($i = 1; $i <= 5; $i++)
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="gesture_tone_body_language" 
                                                    value="{{ $i }}" id="gesture_tone_body_language_{{ $i }}" onchange="calculateTotalAndPercentage()">
                                                <label class="form-check-label" for="gesture_tone_body_language_{{ $i }}">{{ $i }}</label>
                                            </div>
                                        @endfor
                                    </div>
                                </div>
                            </div>

                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="communication_skill" class="form-label">Communication Skill</label>
                                    <div class="rating-group d-flex gap-3 mt-2">
                                        @for($i = 1; $i <= 5; $i++)
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="communication_skill" 
                                                    value="{{ $i }}" id="communication_skill_{{ $i }}" onchange="calculateTotalAndPercentage()">
                                                <label class="form-check-label" for="communication_skill_{{ $i }}">{{ $i }}</label>
                                            </div>
                                        @endfor
                                    </div>
                                </div>
                            </div>

                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="strategies_activities" class="form-label">Strategies/Activities</label>
                                    <div class="rating-group d-flex gap-3 mt-2">
                                        @for($i = 1; $i <= 5; $i++)
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="strategies_activities" 
                                                    value="{{ $i }}" id="strategies_activities_{{ $i }}" onchange="calculateTotalAndPercentage()">
                                                <label class="form-check-label" for="strategies_activities_{{ $i }}">{{ $i }}</label>
                                            </div>
                                        @endfor
                                    </div>
                                </div>
                            </div>

                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="discipline_class_control" class="form-label">Discipline/Class Control</label>
                                    <div class="rating-group d-flex gap-3 mt-2">
                                        @for($i = 1; $i <= 5; $i++)
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="discipline_class_control" 
                                                    value="{{ $i }}" id="discipline_class_control_{{ $i }}" onchange="calculateTotalAndPercentage()">
                                                <label class="form-check-label" for="discipline_class_control_{{ $i }}">{{ $i }}</label>
                                            </div>
                                        @endfor
                                    </div>
                                </div>
                            </div>

                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="tools_av_aids" class="form-label">Tools AV Aids</label>
                                    <div class="rating-group d-flex gap-3 mt-2">
                                        @for($i = 1; $i <= 5; $i++)
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="tools_av_aids" 
                                                    value="{{ $i }}" id="tools_av_aids_{{ $i }}" onchange="calculateTotalAndPercentage()">
                                                <label class="form-check-label" for="tools_av_aids_{{ $i }}">{{ $i }}</label>
                                            </div>
                                        @endfor
                                    </div>
                                </div>
                            </div>

                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="tools_illustrative_material" class="form-label">Tools Illustrative Material</label>
                                    <div class="rating-group d-flex gap-3 mt-2">
                                        @for($i = 1; $i <= 5; $i++)
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="tools_illustrative_material" 
                                                    value="{{ $i }}" id="tools_illustrative_material_{{ $i }}" onchange="calculateTotalAndPercentage()">
                                                <label class="form-check-label" for="tools_illustrative_material_{{ $i }}">{{ $i }}</label>
                                            </div>
                                        @endfor
                                    </div>
                                </div>
                            </div>

                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="tools_writing_board" class="form-label">Tools Writing Board</label>
                                    <div class="rating-group d-flex gap-3 mt-2">
                                        @for($i = 1; $i <= 5; $i++)
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="tools_writing_board" 
                                                    value="{{ $i }}" id="tools_writing_board_{{ $i }}" onchange="calculateTotalAndPercentage()">
                                                <label class="form-check-label" for="tools_writing_board_{{ $i }}">{{ $i }}</label>
                                            </div>
                                        @endfor
                                    </div>
                                </div>
                            </div>

                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="real_life_integration" class="form-label">Real Life Integration</label>
                                    <div class="rating-group d-flex gap-3 mt-2">
                                        @for($i = 1; $i <= 5; $i++)
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="real_life_integration" 
                                                    value="{{ $i }}" id="real_life_integration_{{ $i }}" onchange="calculateTotalAndPercentage()">
                                                <label class="form-check-label" for="real_life_integration_{{ $i }}">{{ $i }}</label>
                                            </div>
                                        @endfor
                                    </div>
                                </div>
                            </div>

                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="competency_command_on_subject" class="form-label">Competency Command on Subject</label>
                                    <div class="rating-group d-flex gap-3 mt-2">
                                        @for($i = 1; $i <= 5; $i++)
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="competency_command_on_subject" 
                                                    value="{{ $i }}" id="competency_command_on_subject_{{ $i }}" onchange="calculateTotalAndPercentage()">
                                                <label class="form-check-label" for="competency_command_on_subject_{{ $i }}">{{ $i }}</label>
                                            </div>
                                        @endfor
                                    </div>
                                </div>
                            </div>

                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="time_management" class="form-label">Time Management</label>
                                    <div class="rating-group d-flex gap-3 mt-2">
                                        @for($i = 1; $i <= 5; $i++)
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="time_management" 
                                                    value="{{ $i }}" id="time_management_{{ $i }}" onchange="calculateTotalAndPercentage()">
                                                <label class="form-check-label" for="time_management_{{ $i }}">{{ $i }}</label>
                                            </div>
                                        @endfor
                                    </div>
                                </div>
                            </div>

                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="evaluation_conclusion" class="form-label">Evaluation Conclusion</label>
                                    <div class="rating-group d-flex gap-3 mt-2">
                                        @for($i = 1; $i <= 5; $i++)
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="evaluation_conclusion" 
                                                    value="{{ $i }}" id="evaluation_conclusion_{{ $i }}" onchange="calculateTotalAndPercentage()">
                                                <label class="form-check-label" for="evaluation_conclusion_{{ $i }}">{{ $i }}</label>
                                            </div>
                                        @endfor
                                    </div>
                                </div>
                            </div>

                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="diary_hw_checking" class="form-label">Diary Homework Checking</label>
                                    <div class="rating-group d-flex gap-3 mt-2">
                                        @for($i = 1; $i <= 5; $i++)
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="diary_hw_checking" 
                                                    value="{{ $i }}" id="diary_hw_checking_{{ $i }}" onchange="calculateTotalAndPercentage()">
                                                <label class="form-check-label" for="diary_hw_checking_{{ $i }}">{{ $i }}</label>
                                            </div>
                                        @endfor
                                    </div>
                                </div>
                            </div>

                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="call_on_board" class="form-label">Call on Board</label>
                                    <div class="rating-group d-flex gap-3 mt-2">
                                        @for($i = 1; $i <= 5; $i++)
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="call_on_board" 
                                                    value="{{ $i }}" id="call_on_board_{{ $i }}" onchange="calculateTotalAndPercentage()">
                                                <label class="form-check-label" for="call_on_board_{{ $i }}">{{ $i }}</label>
                                            </div>
                                        @endfor
                                    </div>
                                </div>
                            </div>

                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="knowledge_gain" class="form-label">Knowledge Gain</label>
                                    <div class="rating-group d-flex gap-3 mt-2">
                                        @for($i = 1; $i <= 5; $i++)
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="knowledge_gain" 
                                                    value="{{ $i }}" id="knowledge_gain_{{ $i }}" onchange="calculateTotalAndPercentage()">
                                                <label class="form-check-label" for="knowledge_gain_{{ $i }}">{{ $i }}</label>
                                            </div>
                                        @endfor
                                    </div>
                                </div>
                            </div>

                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="skill_gain_spoken" class="form-label">Skill Gain (Spoken)</label>
                                    <div class="rating-group d-flex gap-3 mt-2">
                                        @for($i = 1; $i <= 5; $i++)
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="skill_gain_spoken" 
                                                    value="{{ $i }}" id="skill_gain_spoken_{{ $i }}" onchange="calculateTotalAndPercentage()">
                                                <label class="form-check-label" for="skill_gain_spoken_{{ $i }}">{{ $i }}</label>
                                            </div>
                                        @endfor
                                    </div>
                                </div>
                            </div>

                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="skill_gain_written" class="form-label">Skill Gain (Written)</label>
                                    <div class="rating-group d-flex gap-3 mt-2">
                                        @for($i = 1; $i <= 5; $i++)
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="skill_gain_written" 
                                                    value="{{ $i }}" id="skill_gain_written_{{ $i }}" onchange="calculateTotalAndPercentage()">
                                                <label class="form-check-label" for="skill_gain_written_{{ $i }}">{{ $i }}</label>
                                            </div>
                                        @endfor
                                    </div>
                                </div>
                            </div>

                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="personality_trait_confidence" class="form-label">Personality Trait Confidence</label>
                                    <div class="rating-group d-flex gap-3 mt-2">
                                        @for($i = 1; $i <= 5; $i++)
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="personality_trait_confidence" 
                                                    value="{{ $i }}" id="personality_trait_confidence_{{ $i }}" onchange="calculateTotalAndPercentage()">
                                                <label class="form-check-label" for="personality_trait_confidence_{{ $i }}">{{ $i }}</label>
                                            </div>
                                        @endfor
                                    </div>
                                </div>
                            </div>

                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="response_of_previous_knowledge" class="form-label">Response of Previous Knowledge</label>
                                    <div class="rating-group d-flex gap-3 mt-2">
                                        @for($i = 1; $i <= 5; $i++)
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="response_of_previous_knowledge" 
                                                    value="{{ $i }}" id="response_of_previous_knowledge_{{ $i }}" onchange="calculateTotalAndPercentage()">
                                                <label class="form-check-label" for="response_of_previous_knowledge_{{ $i }}">{{ $i }}</label>
                                            </div>
                                        @endfor
                                    </div>
                                </div>
                            </div>

                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="observer_signature" class="form-label">Observer Signature</label>
                                    <input type="text" class="form-control @error('observer_signature') is-invalid @enderror" 
                                        id="observer_signature" name="observer_signature" placeholder="Observer Signature" required>
                                    @error('observer_signature')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
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
                                    <textarea class="form-control @error('observer_guidance') is-invalid @enderror" 
                                        id="observer_guidance" name="observer_guidance" placeholder="Guidance by Observer" rows="3"></textarea>
                                    @error('observer_guidance')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-xxl-12">
                                <div>
                                    <label for="teacher_views" class="form-label">Teacher's Views</label>
                                    <textarea class="form-control @error('teacher_views') is-invalid @enderror" 
                                        id="teacher_views" name="teacher_views" placeholder="Teacher's Views" rows="3"></textarea>
                                    @error('teacher_views')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="mt-4">
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <a href="{{ route('evaluation.index') }}" class="btn btn-secondary">Cancel</a>
                        </div>
                    </form>
                </div>
                <!-- end card body -->
            </div>
        </div>
    </div>
    <!-- end row -->
@endsection

@section('script')
    <!-- Load jQuery before your script -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Your other script files -->
    <script src="{{ URL::asset('build/libs/prismjs/prism.js') }}"></script>
    <script src="{{ URL::asset('build/js/app.js') }}"></script>

    <script>
        $(document).ready(function() {
            // Function to load teachers based on campus
            function loadTeachers(campusId) {
                if (campusId) {
                    $.ajax({
                        url: '/get-teachers/' + campusId,
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            $('#teacher_id').empty();
                            $('#teacher_id').append('<option value="">Select Teacher</option>');

                            if (Array.isArray(data) && data.length > 0) {
                                $.each(data, function(index, teacher) {
                                    const teacherName = `${teacher.first_name} ${teacher.last_name}`;
                                    $('#teacher_id').append(
                                        `<option value="${teacher.id}">${teacherName}</option>`
                                    );
                                });
                            } else {
                                $('#teacher_id').append(
                                    '<option value="">No Teachers Available</option>'
                                );
                            }
                        },
                        error: function() {
                            $('#teacher_id').empty();
                            $('#teacher_id').append(
                                '<option value="">Error loading teachers</option>'
                            );
                        }
                    });
                } else {
                    $('#teacher_id').empty();
                    $('#teacher_id').append('<option value="">Select Teacher</option>');
                }
            }

            // Check if user is Principal and auto-load teachers
            @if(auth()->user()->hasRole('Principal'))
                // Auto-load teachers for Principal's campus on page load
                var principalCampusId = {{ auth()->user()->campus_id }};
                loadTeachers(principalCampusId);
            @endif

            // Handle campus change for Admin users
            $('#campus_id').on('change', function() {
                var campusId = $(this).val();
                loadTeachers(campusId);
                
                // Clear dependent dropdowns when campus changes
                $('#class_id').html('<option value="">Select Class</option>');
                $('#section_id').html('<option value="">Select Section</option>');
                $('#subject_id').html('<option value="">Select Subject</option>');
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            // List of all evaluation field names
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
                let count = fields.length; // Total number of fields (23)

                // Iterate through each field and sum up the values
                fields.forEach(function(field) {
                    const selectedRadio = document.querySelector(`input[name="${field}"]:checked`);
                    const fieldValue = selectedRadio ? parseInt(selectedRadio.value) : 0;
                    total += fieldValue;
                });

                // Set the total marks
                $('#total_marks').val(total);

                // Calculate percentage (max 5 per field × 23 fields = 115)
                let maxMarks = count * 5;
                let percentage = (total / maxMarks) * 100;

                // Set the calculated percentage
                $('#percentage').val(percentage.toFixed(2));
            }

            // Make the function globally available
            window.calculateTotalAndPercentage = calculateTotalAndPercentage;
        });
    </script>

    <script type="text/javascript">
        function fetchClasses() {
            let teacherId = document.getElementById('teacher_id').value;
            if (teacherId) {
                fetch(`/get-classes/${teacherId}`)
                    .then(response => response.json())
                    .then(data => {
                        let classDropdown = document.getElementById('class_id');
                        classDropdown.innerHTML = '<option value="">Select Class</option>';
                        data.forEach(classData => {
                            classDropdown.innerHTML += `<option value="${classData.id}">${classData.name}</option>`;
                        });
                        // Clear dependent dropdowns
                        document.getElementById('section_id').innerHTML = '<option value="">Select Section</option>';
                        document.getElementById('subject_id').innerHTML = '<option value="">Select Subject</option>';
                    })
                    .catch(error => console.error('Error fetching classes:', error));
            } else {
                document.getElementById('class_id').innerHTML = '<option value="">Select Class</option>';
                document.getElementById('section_id').innerHTML = '<option value="">Select Section</option>';
                document.getElementById('subject_id').innerHTML = '<option value="">Select Subject</option>';
            }
        }

        function fetchSections() {
            let classId = document.getElementById('class_id').value;
            if (classId) {
                fetch(`/get-sections-by-class?class_id=${classId}`)
                    .then(response => response.json())
                    .then(data => {
                        let sectionDropdown = document.getElementById('section_id');
                        sectionDropdown.innerHTML = '<option value="">Select Section</option>';
                        if (Array.isArray(data.sections) && data.sections.length > 0) {
                            data.sections.forEach(section => {
                                sectionDropdown.innerHTML += `<option value="${section.id}">${section.name}</option>`;
                            });
                        } else {
                            sectionDropdown.innerHTML = '<option value="">No Sections Available</option>';
                        }
                        // Clear subject dropdown
                        document.getElementById('subject_id').innerHTML = '<option value="">Select Subject</option>';
                    })
                    .catch(error => console.error('Error fetching sections:', error));
            } else {
                document.getElementById('section_id').innerHTML = '<option value="">Select Section</option>';
                document.getElementById('subject_id').innerHTML = '<option value="">Select Subject</option>';
            }
        }

        function fetchSubjects() {
            let sectionId = document.getElementById('section_id').value;
            if (sectionId) {
                fetch(`/get-subjects-by-section?section_id=${sectionId}`)
                    .then(response => response.json())
                    .then(data => {
                        let subjectDropdown = document.getElementById('subject_id');
                        subjectDropdown.innerHTML = '<option value="">Select Subject</option>';
                        if (Array.isArray(data.subjects) && data.subjects.length > 0) {
                            data.subjects.forEach(subject => {
                                subjectDropdown.innerHTML += `<option value="${subject.id}">${subject.name}</option>`;
                            });
                        } else {
                            subjectDropdown.innerHTML = '<option value="">No Subjects Available</option>';
                        }
                    })
                    .catch(error => console.error('Error fetching subjects:', error));
            } else {
                document.getElementById('subject_id').innerHTML = '<option value="">Select Subject</option>';
            }
        }
    </script>

    <style>
        .rating-group {
            flex-wrap: wrap;
        }

        .form-check {
            margin-right: 15px;
        }

        .form-check-input:checked {
            background-color: #007bff;
            border-color: #007bff;
        }

        .form-check-label {
            font-weight: 500;
            cursor: pointer;
        }

        #total_marks, #percentage {
            background-color: #e9ecef;
            font-weight: bold;
            color: #495057;
        }
    </style>
@endsection