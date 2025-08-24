@extends('layouts.master')

@section('title')
    @lang('translation.seniorevaluation-form')
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
                    <h4 class="card-title mb-0 flex-grow-1">Edit Senior Evaluation Form</h4>
                    <a href="{{ route('seniorevaluation.index') }}" class="btn btn-primary ms-auto">Back</a>
                </div><!-- end card header -->
                <div class="card-body">
                    <form method="POST" action="{{ route('seniorevaluation.update', $evaluation->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="row gy-4">

                            <!-- Campus Selection -->
                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="campus_id" class="form-label">Campus</label>
                                    <select class="form-select @error('campus_id') is-invalid @enderror" id="campus_id"
                                        name="campus_id" required {{ auth()->user()->hasRole('Principal') ? 'disabled' : '' }}>
                                        @foreach ($campuses as $campus)
                                            <option value="{{ $campus->id }}"
                                                {{ $evaluation->campus_id == $campus->id ? 'selected' : '' }}>
                                                {{ $campus->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @if(auth()->user()->hasRole('Principal'))
                                        <input type="hidden" name="campus_id" value="{{ $evaluation->campus_id }}">
                                    @endif
                                    @error('campus_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <!-- Teacher Selection -->
                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="teacher_id" class="form-label">Teacher's name</label>
                                    <select class="form-select @error('teacher_id') is-invalid @enderror" id="teacher_id"
                                        name="teacher_id" onchange="fetchClasses()" required>
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

                            <!-- Class Dropdown -->
                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="class_id" class="form-label">Class</label>
                                    <select class="form-select @error('class_id') is-invalid @enderror" id="class_id" 
                                        name="class_id" onchange="fetchSections()" required>
                                        <option value="">Select Class</option>
                                        @foreach ($classes as $class)
                                            <option value="{{ $class->id }}" {{ $evaluation->class_id == $class->id ? 'selected' : '' }}>
                                                {{ $class->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('class_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <!-- Section Dropdown -->
                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="section_id" class="form-label">Section</label>
                                    <select class="form-select @error('section_id') is-invalid @enderror" id="section_id" 
                                        name="section_id" onchange="fetchSubjects()" required>
                                        <option value="">Select Section</option>
                                        @foreach ($sections as $section)
                                            <option value="{{ $section->id }}" {{ $evaluation->section_id == $section->id ? 'selected' : '' }}>
                                                {{ $section->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('section_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <!-- Subject Dropdown -->
                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="subject_id" class="form-label">Subject</label>
                                    <select class="form-select @error('subject_id') is-invalid @enderror" id="subject_id" 
                                        name="subject_id" required>
                                        <option value="">Select Subject</option>
                                        @foreach ($subjects as $subject)
                                            <option value="{{ $subject->id }}" {{ $evaluation->subject_id == $subject->id ? 'selected' : '' }}>
                                                {{ $subject->name }}
                                            </option>
                                        @endforeach
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
                                        id="observer_name" name="observer_name"
                                        value="{{ old('observer_name', $evaluation->observer_name) }}"
                                        placeholder="Observer Name" required>
                                    @error('observer_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
<!-- Date Field - Original Date (Non-editable) -->
<div class="col-xxl-4 col-md-6">
    <div>
        <label for="evaluation_date" class="form-label">Evaluation Date</label>
        <input type="date" class="form-control" id="evaluation_date" name="evaluation_date"
            value="{{ old('evaluation_date', $evaluation->evaluation_date) }}" 
            readonly disabled style="background-color: #e9ecef;">
    </div>
</div>
                            <!-- Evaluation Fields with Radio Buttons -->
                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="entrance_welcome_marks" class="form-label">Entrance Welcome</label>
                                    <div class="rating-group d-flex gap-3 mt-2">
                                        @for($i = 1; $i <= 5; $i++)
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="entrance_welcome_marks" 
                                                    value="{{ $i }}" id="entrance_welcome_marks_{{ $i }}" 
                                                    {{ old('entrance_welcome_marks', $evaluation->entrance_welcome_marks) == $i ? 'checked' : '' }}
                                                    onchange="calculateTotal()">
                                                <label class="form-check-label" for="entrance_welcome_marks_{{ $i }}">{{ $i }}</label>
                                            </div>
                                        @endfor
                                    </div>
                                </div>
                            </div>

                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="appearance_dress_code_marks" class="form-label">Appearance & Dress Code</label>
                                    <div class="rating-group d-flex gap-3 mt-2">
                                        @for($i = 1; $i <= 5; $i++)
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="appearance_dress_code_marks" 
                                                    value="{{ $i }}" id="appearance_dress_code_marks_{{ $i }}" 
                                                    {{ old('appearance_dress_code_marks', $evaluation->appearance_dress_code_marks) == $i ? 'checked' : '' }}
                                                    onchange="calculateTotal()">
                                                <label class="form-check-label" for="appearance_dress_code_marks_{{ $i }}">{{ $i }}</label>
                                            </div>
                                        @endfor
                                    </div>
                                </div>
                            </div>

                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="seating_cleanliness_marks" class="form-label">Seating & Cleanliness</label>
                                    <div class="rating-group d-flex gap-3 mt-2">
                                        @for($i = 1; $i <= 5; $i++)
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="seating_cleanliness_marks" 
                                                    value="{{ $i }}" id="seating_cleanliness_marks_{{ $i }}" 
                                                    {{ old('seating_cleanliness_marks', $evaluation->seating_cleanliness_marks) == $i ? 'checked' : '' }}
                                                    onchange="calculateTotal()">
                                                <label class="form-check-label" for="seating_cleanliness_marks_{{ $i }}">{{ $i }}</label>
                                            </div>
                                        @endfor
                                    </div>
                                </div>
                            </div>

                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="writing_board_prep_marks" class="form-label">Writing Board Preparation</label>
                                    <div class="rating-group d-flex gap-3 mt-2">
                                        @for($i = 1; $i <= 5; $i++)
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="writing_board_prep_marks" 
                                                    value="{{ $i }}" id="writing_board_prep_marks_{{ $i }}" 
                                                    {{ old('writing_board_prep_marks', $evaluation->writing_board_prep_marks) == $i ? 'checked' : '' }}
                                                    onchange="calculateTotal()">
                                                <label class="form-check-label" for="writing_board_prep_marks_{{ $i }}">{{ $i }}</label>
                                            </div>
                                        @endfor
                                    </div>
                                </div>
                            </div>

                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="writing_board_use_marks" class="form-label">Writing Board Use</label>
                                    <div class="rating-group d-flex gap-3 mt-2">
                                        @for($i = 1; $i <= 5; $i++)
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="writing_board_use_marks" 
                                                    value="{{ $i }}" id="writing_board_use_marks_{{ $i }}" 
                                                    {{ old('writing_board_use_marks', $evaluation->writing_board_use_marks) == $i ? 'checked' : '' }}
                                                    onchange="calculateTotal()">
                                                <label class="form-check-label" for="writing_board_use_marks_{{ $i }}">{{ $i }}</label>
                                            </div>
                                        @endfor
                                    </div>
                                </div>
                            </div>

                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="syllabus_division_marks" class="form-label">Syllabus Division</label>
                                    <div class="rating-group d-flex gap-3 mt-2">
                                        @for($i = 1; $i <= 5; $i++)
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="syllabus_division_marks" 
                                                    value="{{ $i }}" id="syllabus_division_marks_{{ $i }}" 
                                                    {{ old('syllabus_division_marks', $evaluation->syllabus_division_marks) == $i ? 'checked' : '' }}
                                                    onchange="calculateTotal()">
                                                <label class="form-check-label" for="syllabus_division_marks_{{ $i }}">{{ $i }}</label>
                                            </div>
                                        @endfor
                                    </div>
                                </div>
                            </div>

                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="assessment_start_marks" class="form-label">Assessment Start</label>
                                    <div class="rating-group d-flex gap-3 mt-2">
                                        @for($i = 1; $i <= 5; $i++)
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="assessment_start_marks" 
                                                    value="{{ $i }}" id="assessment_start_marks_{{ $i }}" 
                                                    {{ old('assessment_start_marks', $evaluation->assessment_start_marks) == $i ? 'checked' : '' }}
                                                    onchange="calculateTotal()">
                                                <label class="form-check-label" for="assessment_start_marks_{{ $i }}">{{ $i }}</label>
                                            </div>
                                        @endfor
                                    </div>
                                </div>
                            </div>

                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="pk_testing_marks" class="form-label">PK Testing</label>
                                    <div class="rating-group d-flex gap-3 mt-2">
                                        @for($i = 1; $i <= 5; $i++)
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="pk_testing_marks" 
                                                    value="{{ $i }}" id="pk_testing_marks_{{ $i }}" 
                                                    {{ old('pk_testing_marks', $evaluation->pk_testing_marks) == $i ? 'checked' : '' }}
                                                    onchange="calculateTotal()">
                                                <label class="form-check-label" for="pk_testing_marks_{{ $i }}">{{ $i }}</label>
                                            </div>
                                        @endfor
                                    </div>
                                </div>
                            </div>

                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="av_activities_marks" class="form-label">AV Activities</label>
                                    <div class="rating-group d-flex gap-3 mt-2">
                                        @for($i = 1; $i <= 5; $i++)
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="av_activities_marks" 
                                                    value="{{ $i }}" id="av_activities_marks_{{ $i }}" 
                                                    {{ old('av_activities_marks', $evaluation->av_activities_marks) == $i ? 'checked' : '' }}
                                                    onchange="calculateTotal()">
                                                <label class="form-check-label" for="av_activities_marks_{{ $i }}">{{ $i }}</label>
                                            </div>
                                        @endfor
                                    </div>
                                </div>
                            </div>

                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="teaching_methods_marks" class="form-label">Teaching Methods</label>
                                    <div class="rating-group d-flex gap-3 mt-2">
                                        @for($i = 1; $i <= 5; $i++)
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="teaching_methods_marks" 
                                                    value="{{ $i }}" id="teaching_methods_marks_{{ $i }}" 
                                                    {{ old('teaching_methods_marks', $evaluation->teaching_methods_marks) == $i ? 'checked' : '' }}
                                                    onchange="calculateTotal()">
                                                <label class="form-check-label" for="teaching_methods_marks_{{ $i }}">{{ $i }}</label>
                                            </div>
                                        @endfor
                                    </div>
                                </div>
                            </div>

                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="subject_command_marks" class="form-label">Subject Command</label>
                                    <div class="rating-group d-flex gap-3 mt-2">
                                        @for($i = 1; $i <= 5; $i++)
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="subject_command_marks" 
                                                    value="{{ $i }}" id="subject_command_marks_{{ $i }}" 
                                                    {{ old('subject_command_marks', $evaluation->subject_command_marks) == $i ? 'checked' : '' }}
                                                    onchange="calculateTotal()">
                                                <label class="form-check-label" for="subject_command_marks_{{ $i }}">{{ $i }}</label>
                                            </div>
                                        @endfor
                                    </div>
                                </div>
                            </div>

                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="student_clarity_marks" class="form-label">Student Clarity</label>
                                    <div class="rating-group d-flex gap-3 mt-2">
                                        @for($i = 1; $i <= 5; $i++)
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="student_clarity_marks" 
                                                    value="{{ $i }}" id="student_clarity_marks_{{ $i }}" 
                                                    {{ old('student_clarity_marks', $evaluation->student_clarity_marks) == $i ? 'checked' : '' }}
                                                    onchange="calculateTotal()">
                                                <label class="form-check-label" for="student_clarity_marks_{{ $i }}">{{ $i }}</label>
                                            </div>
                                        @endfor
                                    </div>
                                </div>
                            </div>

                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="student_involvement_marks" class="form-label">Student Involvement</label>
                                    <div class="rating-group d-flex gap-3 mt-2">
                                        @for($i = 1; $i <= 5; $i++)
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="student_involvement_marks" 
                                                    value="{{ $i }}" id="student_involvement_marks_{{ $i }}" 
                                                    {{ old('student_involvement_marks', $evaluation->student_involvement_marks) == $i ? 'checked' : '' }}
                                                    onchange="calculateTotal()">
                                                <label class="form-check-label" for="student_involvement_marks_{{ $i }}">{{ $i }}</label>
                                            </div>
                                        @endfor
                                    </div>
                                </div>
                            </div>

                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="individual_attention_marks" class="form-label">Individual Attention</label>
                                    <div class="rating-group d-flex gap-3 mt-2">
                                        @for($i = 1; $i <= 5; $i++)
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="individual_attention_marks" 
                                                    value="{{ $i }}" id="individual_attention_marks_{{ $i }}" 
                                                    {{ old('individual_attention_marks', $evaluation->individual_attention_marks) == $i ? 'checked' : '' }}
                                                    onchange="calculateTotal()">
                                                <label class="form-check-label" for="individual_attention_marks_{{ $i }}">{{ $i }}</label>
                                            </div>
                                        @endfor
                                    </div>
                                </div>
                            </div>

                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="copy_work_marks" class="form-label">Copy Work</label>
                                    <div class="rating-group d-flex gap-3 mt-2">
                                        @for($i = 1; $i <= 5; $i++)
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="copy_work_marks" 
                                                    value="{{ $i }}" id="copy_work_marks_{{ $i }}" 
                                                    {{ old('copy_work_marks', $evaluation->copy_work_marks) == $i ? 'checked' : '' }}
                                                    onchange="calculateTotal()">
                                                <label class="form-check-label" for="copy_work_marks_{{ $i }}">{{ $i }}</label>
                                            </div>
                                        @endfor
                                    </div>
                                </div>
                            </div>

                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="moral_training_marks" class="form-label">Moral Training</label>
                                    <div class="rating-group d-flex gap-3 mt-2">
                                        @for($i = 1; $i <= 5; $i++)
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="moral_training_marks" 
                                                    value="{{ $i }}" id="moral_training_marks_{{ $i }}" 
                                                    {{ old('moral_training_marks', $evaluation->moral_training_marks) == $i ? 'checked' : '' }}
                                                    onchange="calculateTotal()">
                                                <label class="form-check-label" for="moral_training_marks_{{ $i }}">{{ $i }}</label>
                                            </div>
                                        @endfor
                                    </div>
                                </div>
                            </div>

                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="reading_marking_objective_marks" class="form-label">Reading/Marking Objective</label>
                                    <div class="rating-group d-flex gap-3 mt-2">
                                        @for($i = 1; $i <= 5; $i++)
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="reading_marking_objective_marks" 
                                                    value="{{ $i }}" id="reading_marking_objective_marks_{{ $i }}" 
                                                    {{ old('reading_marking_objective_marks', $evaluation->reading_marking_objective_marks) == $i ? 'checked' : '' }}
                                                    onchange="calculateTotal()">
                                                <label class="form-check-label" for="reading_marking_objective_marks_{{ $i }}">{{ $i }}</label>
                                            </div>
                                        @endfor
                                    </div>
                                </div>
                            </div>

                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="lecture_planning_marks" class="form-label">Lecture Planning</label>
                                    <div class="rating-group d-flex gap-3 mt-2">
                                        @for($i = 1; $i <= 5; $i++)
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="lecture_planning_marks" 
                                                    value="{{ $i }}" id="lecture_planning_marks_{{ $i }}" 
                                                    {{ old('lecture_planning_marks', $evaluation->lecture_planning_marks) == $i ? 'checked' : '' }}
                                                    onchange="calculateTotal()">
                                                <label class="form-check-label" for="lecture_planning_marks_{{ $i }}">{{ $i }}</label>
                                            </div>
                                        @endfor
                                    </div>
                                </div>
                            </div>

                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="time_management_marks" class="form-label">Time Management</label>
                                    <div class="rating-group d-flex gap-3 mt-2">
                                        @for($i = 1; $i <= 5; $i++)
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="time_management_marks" 
                                                    value="{{ $i }}" id="time_management_marks_{{ $i }}" 
                                                    {{ old('time_management_marks', $evaluation->time_management_marks) == $i ? 'checked' : '' }}
                                                    onchange="calculateTotal()">
                                                <label class="form-check-label" for="time_management_marks_{{ $i }}">{{ $i }}</label>
                                            </div>
                                        @endfor
                                    </div>
                                </div>
                            </div>

                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="spoken_english_marks" class="form-label">Spoken English</label>
                                    <div class="rating-group d-flex gap-3 mt-2">
                                        @for($i = 1; $i <= 5; $i++)
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="spoken_english_marks" 
                                                    value="{{ $i }}" id="spoken_english_marks_{{ $i }}" 
                                                    {{ old('spoken_english_marks', $evaluation->spoken_english_marks) == $i ? 'checked' : '' }}
                                                    onchange="calculateTotal()">
                                                <label class="form-check-label" for="spoken_english_marks_{{ $i }}">{{ $i }}</label>
                                            </div>
                                        @endfor
                                    </div>
                                </div>
                            </div>

                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="evaluation_marks" class="form-label">Evaluation</label>
                                    <div class="rating-group d-flex gap-3 mt-2">
                                        @for($i = 1; $i <= 5; $i++)
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="evaluation_marks" 
                                                    value="{{ $i }}" id="evaluation_marks_{{ $i }}" 
                                                    {{ old('evaluation_marks', $evaluation->evaluation_marks) == $i ? 'checked' : '' }}
                                                    onchange="calculateTotal()">
                                                <label class="form-check-label" for="evaluation_marks_{{ $i }}">{{ $i }}</label>
                                            </div>
                                        @endfor
                                    </div>
                                </div>
                            </div>

                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="home_task_checking_marks" class="form-label">Home Task Checking</label>
                                    <div class="rating-group d-flex gap-3 mt-2">
                                        @for($i = 1; $i <= 5; $i++)
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="home_task_checking_marks" 
                                                    value="{{ $i }}" id="home_task_checking_marks_{{ $i }}" 
                                                    {{ old('home_task_checking_marks', $evaluation->home_task_checking_marks) == $i ? 'checked' : '' }}
                                                    onchange="calculateTotal()">
                                                <label class="form-check-label" for="home_task_checking_marks_{{ $i }}">{{ $i }}</label>
                                            </div>
                                        @endfor
                                    </div>
                                </div>
                            </div>

                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="class_discipline_marks" class="form-label">Class Discipline</label>
                                    <div class="rating-group d-flex gap-3 mt-2">
                                        @for($i = 1; $i <= 5; $i++)
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="class_discipline_marks" 
                                                    value="{{ $i }}" id="class_discipline_marks_{{ $i }}" 
                                                    {{ old('class_discipline_marks', $evaluation->class_discipline_marks) == $i ? 'checked' : '' }}
                                                    onchange="calculateTotal()">
                                                <label class="form-check-label" for="class_discipline_marks_{{ $i }}">{{ $i }}</label>
                                            </div>
                                        @endfor
                                    </div>
                                </div>
                            </div>

                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="total_marks" class="form-label">Total Marks</label>
                                    <input type="number" class="form-control" id="total_marks" name="total_marks"
                                        value="{{ old('total_marks', $evaluation->total_marks) }}"
                                        placeholder="Total Marks" readonly>
                                </div>
                            </div>

                            <div class="col-xxl-12">
                                <div>
                                    <label for="observer_guidance" class="form-label">Guidance by Observer</label>
                                    <textarea class="form-control @error('observer_guidance') is-invalid @enderror" 
                                        id="observer_guidance" name="observer_guidance" 
                                        placeholder="Guidance by Observer" rows="3">{{ old('observer_guidance', $evaluation->observer_guidance) }}</textarea>
                                    @error('observer_guidance')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-xxl-12">
                                <div>
                                    <label for="teacher_views" class="form-label">Teacher's Views</label>
                                    <textarea class="form-control @error('teacher_views') is-invalid @enderror" 
                                        id="teacher_views" name="teacher_views" 
                                        placeholder="Teacher's Views" rows="3">{{ old('teacher_views', $evaluation->teacher_views) }}</textarea>
                                    @error('teacher_views')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                        </div>

                        <div class="mt-4">
                            <button type="submit" class="btn btn-primary">Update</button>
                            <a href="{{ route('seniorevaluation.index') }}" class="btn btn-secondary">Cancel</a>
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
                const selectedTeacherId = "{{ $evaluation->teacher_id }}";
                
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
                                    const isSelected = selectedTeacherId == teacher.id ? 'selected' : '';
                                    const teacherName = `${teacher.first_name} ${teacher.last_name}`;
                                    $('#teacher_id').append(
                                        `<option value="${teacher.id}" ${isSelected}>${teacherName}</option>`
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
                var principalCampusId = {{ $evaluation->campus_id }};
                loadTeachers(principalCampusId);
            @endif

            // Handle campus change for Admin users
            $('#campus_id').on('change', function() {
                var campusId = $(this).val();
                loadTeachers(campusId);
            });

            // Trigger change event on page load if a campus is already selected
            if ($('#campus_id').val()) {
                $('#campus_id').trigger('change');
            }
        });
    </script>

    <script>
        function calculateTotal() {
            let total = 0;

            // List of field names
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
                const selectedRadio = document.querySelector(`input[name="${field}"]:checked`);
                const value = selectedRadio ? parseInt(selectedRadio.value) : 0;
                total += value;
            });

            // Display the total in the total_marks field
            document.getElementById('total_marks').value = total;
        }

        // Calculate total on page load
        $(document).ready(function() {
            calculateTotal();
        });
    </script>

    <script type="text/javascript">
        const selectedSectionId = "{{ $evaluation->section_id }}";
        const selectedSubjectId = "{{ $evaluation->subject_id }}";
        const selectedClassId = "{{ $evaluation->class_id }}";

        function fetchClasses() {
            let teacherId = document.getElementById('teacher_id').value;
            if (teacherId) {
                fetch(`/get-classes/${teacherId}`)
                    .then(response => response.json())
                    .then(data => {
                        let classDropdown = document.getElementById('class_id');
                        classDropdown.innerHTML = '<option value="">Select Class</option>';
                        data.forEach(classData => {
                            const isSelected = selectedClassId == classData.id ? 'selected' : '';
                            classDropdown.innerHTML += `<option value="${classData.id}" ${isSelected}>${classData.name}</option>`;
                        });
                        // Trigger change for dependent sections
                        fetchSections();
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
                                const isSelected = selectedSectionId == section.id ? 'selected' : '';
                                sectionDropdown.innerHTML += `<option value="${section.id}" ${isSelected}>${section.name}</option>`;
                            });
                            // Trigger change for dependent subjects
                            fetchSubjects();
                        } else {
                            sectionDropdown.innerHTML = '<option value="">No Sections Available</option>';
                        }
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
                                const isSelected = selectedSubjectId == subject.id ? 'selected' : '';
                                subjectDropdown.innerHTML += `<option value="${subject.id}" ${isSelected}>${subject.name}</option>`;
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

        // Trigger initial teacher change if editing
        document.addEventListener('DOMContentLoaded', function() {
            if (document.getElementById('teacher_id').value) {
                fetchClasses();
            }
        });
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

        #total_marks {
            background-color: #e9ecef;
            font-weight: bold;
            color: #495057;
        }
    </style>
@endsection