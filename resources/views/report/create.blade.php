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
            Teacher Report
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">ناظرہ رپورٹ</h4>
                    <a href="{{ route('report.index') }}" class="btn btn-primary ms-auto">Back</a>
                </div><!-- end card header -->
                <div class="card-body">
                    <form method="POST" action="{{ route('report.store') }}">
                        @csrf
                        <div class="row gy-4">
                            {{-- <div class="col-xxl-6 col-md-6">
                                <div>
                                    <label for="campus_id" class="form-label">کیمپس</label>
                                    <select class="form-select @error('campus_id') is-invalid @enderror" id="campus_id"
                                        name="campus_id" required>
                                        <option value="">کیمپس منتخب کریں</option>
                                        @foreach ($campuses as $campus)
                                            <option value="{{ $campus->id }}">{{ $campus->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('campus_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>


                            <div class="col-xxl-6 col-md-6">
                                <div>
                                    <label for="teacher_id" class="form-label">استاد کا نام</label>
                                    <select class="form-select @error('teacher_id') is-invalid @enderror" id="teacher_id"
                                        name="teacher_id" required>
                                        <option value="">استاد منتخب کریں</option>
                                    </select>
                                    @error('teacher_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div> --}}
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

                        </div>
                        <div class="row gy-4">

                            <!-- Field 1: آمد و استقبال (Entrance and Welcome) -->
                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="entrance_welcome" class="form-label">آمد و استقبال</label>
                                    <input type="number" class="form-control" id="entrance_welcome" name="entrance_welcome"
                                        oninput="calculateTotal()" placeholder="نمبر درج کریں" min="0" max="2"
                                        required>
                                </div>
                            </div>

                            <!-- Field 2: شخصی سلیقہ و لباس (Personal Appearance and Dress) -->
                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="appearance_dress" class="form-label">شخصی سلیقہ و لباس</label>
                                    <input type="number" class="form-control" id="appearance_dress" name="appearance_dress"
                                        oninput="calculateTotal()" placeholder="نمبر درج کریں" min="0" max="3"
                                        required>
                                </div>
                            </div>

                            <!-- Field 3: درسی انداز (Teaching Style) -->
                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="teaching_style" class="form-label">درسی انداز</label>
                                    <input type="number" class="form-control" id="teaching_style" name="teaching_style"
                                        oninput="calculateTotal()" oninput="calculateTotal()  placeholder="نمبر درج کریں"
                                        min="0" max="5" required>
                                </div>
                            </div>

                            <!-- Field 4: حفاظتی تدابیر و صفائی (Safety Measures and Cleanliness) -->
                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="safety_cleanliness" class="form-label">حفاظتی تدابیر و صفائی</label>
                                    <input type="number" class="form-control" id="safety_cleanliness"
                                        name="safety_cleanliness" oninput="calculateTotal()" placeholder="نمبر درج کریں"
                                        min="0" max="3" required>
                                </div>
                            </div>

                            <!-- Field 5: نظم و ضبط (Discipline) -->
                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="discipline" class="form-label">نظم و ضبط</label>
                                    <input type="number" class="form-control" id="discipline" name="discipline"
                                        oninput="calculateTotal()" placeholder="نمبر درج کریں" min="0" max="5"
                                        required>
                                </div>
                            </div>

                            <!-- Field 6: کلاس بورڈ (Class Board) -->
                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="class_board" class="form-label">کلاس بورڈ</label>
                                    <input type="number" class="form-control" id="class_board" name="class_board"
                                        oninput="calculateTotal()" placeholder="نمبر درج کریں" min="0" max="2"
                                        required>
                                </div>
                            </div>

                            <!-- Field 7: تدریسی پلان اور ٹائم ٹیبل (Teaching Plan and Time Table) -->
                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="teaching_plan" class="form-label">تدریسی پلان اور ٹائم ٹیبل</label>
                                    <input type="number" class="form-control" id="teaching_plan" name="teaching_plan"
                                        oninput="calculateTotal()" placeholder="نمبر درج کریں" min="0"
                                        max="5" required>
                                </div>
                            </div>

                            <!-- Field 8: مشق کروائی / طلبہ کی تیاری (Classroom Exercises / Student Preparation) -->
                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="student_preparation" class="form-label">مشق کروائی / طلبہ کی تیاری</label>
                                    <input type="number" class="form-control" id="student_preparation"
                                        name="student_preparation" oninput="calculateTotal()" placeholder="نمبر درج کریں"
                                        min="0" max="10" required>
                                </div>
                            </div>

                            <!-- Field 9: گفتگو کا معیار (Standard of Conversation) -->
                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="conversation_standard" class="form-label">گفتگو کا معیار</label>
                                    <input type="number" class="form-control" id="conversation_standard"
                                        name="conversation_standard" oninput="calculateTotal()"
                                        placeholder="نمبر درج کریں" min="0" max="10" required>
                                </div>
                            </div>

                            <!-- Field 10: حفظ قرآن / دوران تعلیم و تدریس (Hifz-e-Quran / during Teaching) -->
                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="hifz_during_teaching" class="form-label">حفظ قرآن / دوران تعلیم و
                                        تدریس</label>
                                    <input type="number" class="form-control" id="hifz_during_teaching"
                                        name="hifz_during_teaching" oninput="calculateTotal()"
                                        placeholder="نمبر درج کریں" min="0" max="10" required>
                                </div>
                            </div>

                            <!-- Field 11: حفظ قرآن / روانی (Hifz-e-Quran / Fluency) -->
                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="hifz_fluency" class="form-label">حفظ قرآن / روانی</label>
                                    <input type="number" class="form-control" id="hifz_fluency" name="hifz_fluency"
                                        oninput="calculateTotal()" placeholder="نمبر درج کریں" min="0"
                                        max="10" required>
                                </div>
                            </div>

                            <!-- Field 12: قراءت (Recitation) -->
                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="recitation" class="form-label">قراءت</label>
                                    <input type="number" class="form-control" id="recitation" name="recitation"
                                        oninput="calculateTotal()" placeholder="نمبر درج کریں" min="0"
                                        max="7" required>
                                </div>
                            </div>

                            <!-- Field 13: اخلاقی تربیت (Moral Training) -->
                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="moral_training" class="form-label">اخلاقی تربیت</label>
                                    <input type="number" class="form-control" id="moral_training" name="moral_training"
                                        oninput="calculateTotal()" placeholder="نمبر درج کریں" min="0"
                                        max="10" required>
                                </div>
                            </div>

                            <!-- Field 14: فکری و اخلاقی تربیت (Intellectual and Moral Training) -->
                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="intellectual_moral_training" class="form-label">فکری و اخلاقی
                                        تربیت</label>
                                    <input type="number" class="form-control" id="intellectual_moral_training"
                                        name="intellectual_moral_training" oninput="calculateTotal()"
                                        placeholder="نمبر درج
                                        کریں" min="0"
                                        max="5" required>
                                </div>
                            </div>

                            <!-- Field 15: جسمانی طاقت و صحت (Physical Strength and Health) -->
                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="physical_strength_health" class="form-label">جسمانی طاقت و صحت</label>
                                    <input type="number" class="form-control" id="physical_strength_health"
                                        name="physical_strength_health" oninput="calculateTotal()"
                                        placeholder="نمبر درج
                                        کریں" min="0"
                                        max="3" required>
                                </div>
                            </div>

                            <!-- Field 16: استعمال وقت (Time Management) -->
                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="time_management" class="form-label">استعمال وقت</label>
                                    <input type="number" class="form-control" id="time_management"
                                        name="time_management" oninput="calculateTotal()" placeholder="نمبر درج کریں"
                                        min="0" max="2" required>
                                </div>
                            </div>

                            <!-- Field 17: طلبہ کی کارکردگی (Student Performance) -->
                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="student_performance" class="form-label">طلبہ کی کارکردگی</label>
                                    <input type="number" class="form-control" id="student_performance"
                                        name="student_performance" oninput="calculateTotal()" placeholder="نمبر درج کریں"
                                        min="0" max="5" required>
                                </div>
                            </div>

                            <!-- Field 18: ڈائری (Diary) -->
                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="diary" class="form-label">ڈائری</label>
                                    <input type="number" class="form-control" id="diary" name="diary"
                                        oninput="calculateTotal()" placeholder="نمبر درج کریں" min="0"
                                        max="3" required>
                                </div>
                            </div>

                            <!-- Total Marks Field -->
                            <div class="col-xxl-12 col-md-6">
                                <div>
                                    <label for="total_marks" class="form-label">Total Marks</label>
                                    <input type="number" class="form-control" id="total_marks" name="total_marks"
                                        placeholder="Total Marks" readonly>
                                </div>
                            </div>
                        </div>

                        <div class="mt-4">
                            <button type="submit" class="btn btn-primary">جمع کرائیں</button>
                            <a href="{{ route('report.index') }}" class="btn btn-secondary">منسوخ کریں</a>
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


    <script>
        function calculateTotal() {
            let total = 0;

            // List of your field IDs
            const fields = [
                'entrance_welcome',
                'appearance_dress',
                'teaching_style',
                'safety_cleanliness',
                'discipline',
                'class_board',
                'teaching_plan',
                'student_preparation',
                'conversation_standard',
                'hifz_during_teaching',
                'hifz_fluency',
                'recitation',
                'moral_training',
                'intellectual_moral_training',
                'physical_strength_health',
                'time_management',
                'student_performance',
                'diary'
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
