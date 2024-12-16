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
            Teacher Performance Report
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">SeniorEvaluation Form</h4>
                    <a href="{{ route('seniorevaluation.index') }}" class="btn btn-primary ms-auto">Back</a>
                </div><!-- end card header -->
                <div class="card-body">
                    <form method="POST" action="{{ route('seniorevaluation.store') }}">
                        @csrf
                        <div class="row gy-4">
                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="campus_id" class="form-label">Campus</label>
                                    <select class="form-select @error('campus_id') is-invalid @enderror" id="campus_id"
                                        name="campus_id" required>
                                        <option value="">Select Campus</option>
                                        @foreach ($campuses as $campus)
                                            <option value="{{ $campus->id }}">{{ $campus->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('campus_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="teacher_id" class="form-label">Teacher’s name</label>
                                    <select class="form-select @error('teacher_id') is-invalid @enderror" id="teacher_id"
                                        name="teacher_id" onchange="fetchClasses()"  required>
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
                                    <select class="form-select" id="class_id" name="class_id" onchange="fetchSections()" required>
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
                                    <select class="form-select @error('section_id') is-invalid @enderror" id="section_id" name="section_id"  onchange="fetchSubjects()" required>
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
                                    <select class="form-select @error('subject_id') is-invalid @enderror" id="subject_id" name="subject_id" required>
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
                                    <input type="text" class="form-control" id="observer_name" name="observer_name"
                                        placeholder="Observer Name">
                                </div>
                            </div>

                            <!-- Evaluation Fields -->
                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="entrance_welcome_marks" class="form-label">Entrance Welcome Marks</label>
                                    <input type="number" class="form-control" id="entrance_welcome_marks"
                                        oninput="calculateTotal()" name="entrance_welcome_marks" min="0"
                                        max="10" required>
                                </div>
                            </div>

                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="appearance_dress_code_marks" class="form-label">Appearance & Dress Code
                                        Marks</label>
                                    <input type="number" class="form-control" id="appearance_dress_code_marks"
                                        oninput="calculateTotal()" name="appearance_dress_code_marks" min="0"
                                        max="10" required>
                                </div>
                            </div>

                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="seating_cleanliness_marks" class="form-label">Seating & Cleanliness
                                        Marks</label>
                                    <input type="number" class="form-control" id="seating_cleanliness_marks"
                                        oninput="calculateTotal()" name="seating_cleanliness_marks" min="0"
                                        max="10" required>
                                </div>
                            </div>

                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="writing_board_prep_marks" class="form-label">Writing Board Preparation
                                        Marks</label>
                                    <input type="number" class="form-control" id="writing_board_prep_marks"
                                        oninput="calculateTotal()" name="writing_board_prep_marks" min="0"
                                        max="10" required>
                                </div>
                            </div>

                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="writing_board_use_marks" class="form-label">Writing Board Use Marks</label>
                                    <input type="number" class="form-control" id="writing_board_use_marks"
                                        oninput="calculateTotal()" name="writing_board_use_marks" min="0"
                                        max="10" required>
                                </div>
                            </div>

                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="syllabus_division_marks" class="form-label">Syllabus Division Marks</label>
                                    <input type="number" class="form-control" id="syllabus_division_marks"
                                        oninput="calculateTotal()" name="syllabus_division_marks" min="0"
                                        max="10" required>
                                </div>
                            </div>

                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="assessment_start_marks" class="form-label">Assessment Start Marks</label>
                                    <input type="number" class="form-control" id="assessment_start_marks"
                                        oninput="calculateTotal()" name="assessment_start_marks" min="0"
                                        max="10" required>
                                </div>
                            </div>

                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="pk_testing_marks" class="form-label">PK Testing Marks</label>
                                    <input type="number" class="form-control" id="pk_testing_marks"
                                        oninput="calculateTotal()" name="pk_testing_marks" min="0" max="10"
                                        required>
                                </div>
                            </div>

                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="av_activities_marks" class="form-label">AV Activities Marks</label>
                                    <input type="number" class="form-control" id="av_activities_marks"
                                        oninput="calculateTotal()" name="av_activities_marks" min="0"
                                        max="10" required>
                                </div>
                            </div>

                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="teaching_methods_marks" class="form-label">Teaching Methods Marks</label>
                                    <input type="number" class="form-control" id="teaching_methods_marks"
                                        oninput="calculateTotal()" name="teaching_methods_marks" min="0"
                                        max="10" required>
                                </div>
                            </div>

                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="subject_command_marks" class="form-label">Subject Command Marks</label>
                                    <input type="number" class="form-control" id="subject_command_marks"
                                        oninput="calculateTotal()" name="subject_command_marks" min="0"
                                        max="10" required>
                                </div>
                            </div>

                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="student_clarity_marks" class="form-label">Student Clarity Marks</label>
                                    <input type="number" class="form-control" id="student_clarity_marks"
                                        oninput="calculateTotal()" name="student_clarity_marks" min="0"
                                        max="10" required>
                                </div>
                            </div>

                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="student_involvement_marks" class="form-label">Student Involvement
                                        Marks</label>
                                    <input type="number" class="form-control" id="student_involvement_marks"
                                        oninput="calculateTotal()" name="student_involvement_marks" min="0"
                                        max="10" required>
                                </div>
                            </div>

                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="individual_attention_marks" class="form-label">Individual Attention
                                        Marks</label>
                                    <input type="number" class="form-control" id="individual_attention_marks"
                                        oninput="calculateTotal()" name="individual_attention_marks" min="0"
                                        max="10" required>
                                </div>
                            </div>

                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="copy_work_marks" class="form-label">Copy Work Marks</label>
                                    <input type="number" class="form-control" id="copy_work_marks"
                                        oninput="calculateTotal()" name="copy_work_marks" min="0" max="10"
                                        required>
                                </div>
                            </div>

                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="moral_training_marks" class="form-label">Moral Training Marks</label>
                                    <input type="number" class="form-control" id="moral_training_marks"
                                        oninput="calculateTotal()" name="moral_training_marks" min="0"
                                        max="10" required>
                                </div>
                            </div>

                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="reading_marking_objective_marks" class="form-label">Reading/Marking
                                        Objective Marks</label>
                                    <input type="number" class="form-control" id="reading_marking_objective_marks"
                                        oninput="calculateTotal()" name="reading_marking_objective_marks" min="0"
                                        max="10" required>
                                </div>
                            </div>

                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="lecture_planning_marks" class="form-label">Lecture Planning Marks</label>
                                    <input type="number" class="form-control" id="lecture_planning_marks"
                                        oninput="calculateTotal()" name="lecture_planning_marks" min="0"
                                        max="10" required>
                                </div>
                            </div>

                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="time_management_marks" class="form-label">Time Management Marks</label>
                                    <input type="number" class="form-control" id="time_management_marks"
                                        oninput="calculateTotal()" name="time_management_marks" min="0"
                                        max="10" required>
                                </div>
                            </div>

                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="spoken_english_marks" class="form-label">Spoken English Marks</label>
                                    <input type="number" class="form-control" id="spoken_english_marks"
                                        oninput="calculateTotal()" name="spoken_english_marks" min="0"
                                        max="10" required>
                                </div>
                            </div>

                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="evaluation_marks" class="form-label">Evaluation Marks</label>
                                    <input type="number" class="form-control" id="evaluation_marks"
                                        oninput="calculateTotal()" name="evaluation_marks" min="0" max="10"
                                        required>
                                </div>
                            </div>

                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="home_task_checking_marks" class="form-label">Home Task Checking
                                        Marks</label>
                                    <input type="number" class="form-control" id="home_task_checking_marks"
                                        oninput="calculateTotal()" name="home_task_checking_marks" min="0"
                                        max="10" required>
                                </div>
                            </div>

                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="class_discipline_marks" class="form-label">Class Discipline Marks</label>
                                    <input type="number" class="form-control" id="class_discipline_marks"
                                        oninput="calculateTotal()" name="class_discipline_marks" min="0"
                                        max="10" required>
                                </div>
                            </div>

                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="total_marks" class="form-label">Total Marks</label>
                                    <input type="number" class="form-control" id="total_marks" name="total_marks"
                                        placeholder="Total Marks" readonly>
                                </div>
                            </div>


                            <div class="col-xxl-12">
                                <div>
                                    <label for="observer_guidance" class="form-label">Guidance by Observer</label>
                                    <textarea class="form-control" id="observer_guidance" name="observer_guidance" rows="3"></textarea>
                                </div>
                            </div>

                            <div class="col-xxl-12">
                                <div>
                                    <label for="teacher_views" class="form-label">Teacher Views</label>
                                    <textarea class="form-control" id="teacher_views" name="teacher_views" rows="3"></textarea>
                                </div>
                            </div>

                        </div>

                        <div class="mt-4">
                            <button type="submit" class="btn btn-primary">Submit</button>
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
@section('script')
<!-- Load jQuery before your script -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Your other script files -->
<script src="{{ URL::asset('build/libs/prismjs/prism.js') }}"></script>
<script src="{{ URL::asset('build/js/app.js') }}"></script>

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



@section('script')
    {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}

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
<script type="text/javascript">
    function fetchClasses() {
        let teacherId = document.getElementById('teacher_id').value; // Get selected teacher ID
        fetch(`/get-classes/${teacherId}`)
            .then(response => response.json())
            .then(data => {
                let classDropdown = document.getElementById('class_id');
                classDropdown.innerHTML = '<option value="">Select Class</option>'; // Clear previous options
                data.forEach(classData => {
                    classDropdown.innerHTML += `<option value="${classData.id}">${classData.name}</option>`; // Populate dropdown
                });
            })
            .catch(error => console.error('Error fetching classes:', error));
    }
    function fetchSections() {
        let classId = document.getElementById('class_id').value; // Get selected class ID
        console.log('Selected Class ID:', classId); // Log the class ID
    
        if (classId) {
            fetch(`/get-sections-by-class?class_id=${classId}`)
                .then(response => response.json())
                .then(data => {
                    let sectionDropdown = document.getElementById('section_id');
                    sectionDropdown.innerHTML = '<option value="">Select Section</option>'; // Clear previous options
                    if (Array.isArray(data.sections) && data.sections.length > 0) {
                        data.sections.forEach(section => {
                            sectionDropdown.innerHTML += `<option value="${section.id}">${section.name}</option>`;
                        });
                    } else {
                        sectionDropdown.innerHTML = '<option value="">No Sections Available</option>';
                    }
                })
                .catch(error => console.error('Error fetching sections:', error));
        } else {
            console.error('No Class ID selected'); // Log if class ID is missing
        }
    }
    
    function fetchSubjects() {
        let sectionId = document.getElementById('section_id').value; // Get selected section ID
        if (sectionId) {
            fetch(`/get-subjects-by-section?section_id=${sectionId}`)
                .then(response => response.json())
                .then(data => {
                    let subjectDropdown = document.getElementById('subject_id');
                    subjectDropdown.innerHTML = '<option value="">Select Subject</option>'; // Clear previous options
                    if (Array.isArray(data.subjects) && data.subjects.length > 0) {
                        data.subjects.forEach(subject => {
                            subjectDropdown.innerHTML += `<option value="${subject.id}">${subject.name}</option>`; // Populate dropdown
                        });
                    } else {
                        subjectDropdown.innerHTML = '<option value="">No Subjects Available</option>';
                    }
                })
                .catch(error => console.error('Error fetching subjects:', error));
        } else {
            document.getElementById('subject_id').innerHTML = '<option value="">Select Subject</option>'; // Reset dropdown
        }
    }
    </script>

@endsection
