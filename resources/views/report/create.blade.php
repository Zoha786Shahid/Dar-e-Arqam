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

                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="campus_id" class="form-label">کیمپس</label>
                                    <select class="form-select @error('campus_id') is-invalid @enderror" id="campus_id"
                                        name="campus_id" required {{ auth()->user()->hasRole('Principal') ? 'disabled' : '' }}>
                                        <option value="">کیمپس منتخب کریں</option>
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
                                    <label for="teacher_id" class="form-label">استاد کا نام</label>
                                    <select class="form-select @error('teacher_id') is-invalid @enderror" id="teacher_id"
                                        name="teacher_id" onchange="fetchClasses()" required>
                                        <option value="">استاد منتخب کریں</option>
                                    </select>
                                    @error('teacher_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="class_id" class="form-label">کلاس</label>
                                    <select class="form-select @error('class_id') is-invalid @enderror" id="class_id" 
                                        name="class_id" onchange="fetchSections()" required>
                                        <option value="">کلاس منتخب کریں</option>
                                    </select>
                                    @error('class_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="section_id" class="form-label">سیکشن</label>
                                    <select class="form-select @error('section_id') is-invalid @enderror" id="section_id"
                                        name="section_id" onchange="fetchSubjects()" required>
                                        <option value="">سیکشن منتخب کریں</option>
                                    </select>
                                    @error('section_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="subject_id" class="form-label">مضمون</label>
                                    <select class="form-select @error('subject_id') is-invalid @enderror" id="subject_id"
                                        name="subject_id" required>
                                        <option value="">مضمون منتخب کریں</option>
                                    </select>
                                    @error('subject_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Evaluation Fields with Radio Buttons -->
                            
                            <!-- Field 1: آمد و استقبال (Entrance and Welcome) -->
                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="entrance_welcome" class="form-label">آمد و استقبال</label>
                                    <div class="rating-group d-flex gap-3 mt-2">
                                        @for($i = 1; $i <= 5; $i++)
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="entrance_welcome" 
                                                    value="{{ $i }}" id="entrance_welcome_{{ $i }}" onchange="calculateTotal()">
                                                <label class="form-check-label" for="entrance_welcome_{{ $i }}">{{ $i }}</label>
                                            </div>
                                        @endfor
                                    </div>
                                </div>
                            </div>

                            <!-- Field 2: شخصی سلیقہ و لباس (Personal Appearance and Dress) -->
                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="appearance_dress" class="form-label">شخصی سلیقہ و لباس</label>
                                    <div class="rating-group d-flex gap-3 mt-2">
                                        @for($i = 1; $i <= 5; $i++)
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="appearance_dress" 
                                                    value="{{ $i }}" id="appearance_dress_{{ $i }}" onchange="calculateTotal()">
                                                <label class="form-check-label" for="appearance_dress_{{ $i }}">{{ $i }}</label>
                                            </div>
                                        @endfor
                                    </div>
                                </div>
                            </div>

                            <!-- Field 3: درسی انداز (Teaching Style) -->
                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="teaching_style" class="form-label">درسی انداز</label>
                                    <div class="rating-group d-flex gap-3 mt-2">
                                        @for($i = 1; $i <= 5; $i++)
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="teaching_style" 
                                                    value="{{ $i }}" id="teaching_style_{{ $i }}" onchange="calculateTotal()">
                                                <label class="form-check-label" for="teaching_style_{{ $i }}">{{ $i }}</label>
                                            </div>
                                        @endfor
                                    </div>
                                </div>
                            </div>

                            <!-- Field 4: حفاظتی تدابیر و صفائی (Safety Measures and Cleanliness) -->
                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="safety_cleanliness" class="form-label">حفاظتی تدابیر و صفائی</label>
                                    <div class="rating-group d-flex gap-3 mt-2">
                                        @for($i = 1; $i <= 5; $i++)
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="safety_cleanliness" 
                                                    value="{{ $i }}" id="safety_cleanliness_{{ $i }}" onchange="calculateTotal()">
                                                <label class="form-check-label" for="safety_cleanliness_{{ $i }}">{{ $i }}</label>
                                            </div>
                                        @endfor
                                    </div>
                                </div>
                            </div>

                            <!-- Field 5: نظم و ضبط (Discipline) -->
                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="discipline" class="form-label">نظم و ضبط</label>
                                    <div class="rating-group d-flex gap-3 mt-2">
                                        @for($i = 1; $i <= 5; $i++)
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="discipline" 
                                                    value="{{ $i }}" id="discipline_{{ $i }}" onchange="calculateTotal()">
                                                <label class="form-check-label" for="discipline_{{ $i }}">{{ $i }}</label>
                                            </div>
                                        @endfor
                                    </div>
                                </div>
                            </div>

                            <!-- Field 6: کلاس بورڈ (Class Board) -->
                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="class_board" class="form-label">کلاس بورڈ</label>
                                    <div class="rating-group d-flex gap-3 mt-2">
                                        @for($i = 1; $i <= 5; $i++)
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="class_board" 
                                                    value="{{ $i }}" id="class_board_{{ $i }}" onchange="calculateTotal()">
                                                <label class="form-check-label" for="class_board_{{ $i }}">{{ $i }}</label>
                                            </div>
                                        @endfor
                                    </div>
                                </div>
                            </div>

                            <!-- Field 7: تدریسی پلان اور ٹائم ٹیبل (Teaching Plan and Time Table) -->
                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="teaching_plan" class="form-label">تدریسی پلان اور ٹائم ٹیبل</label>
                                    <div class="rating-group d-flex gap-3 mt-2">
                                        @for($i = 1; $i <= 5; $i++)
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="teaching_plan" 
                                                    value="{{ $i }}" id="teaching_plan_{{ $i }}" onchange="calculateTotal()">
                                                <label class="form-check-label" for="teaching_plan_{{ $i }}">{{ $i }}</label>
                                            </div>
                                        @endfor
                                    </div>
                                </div>
                            </div>

                            <!-- Field 8: مشق کروائی / طلبہ کی تیاری (Classroom Exercises / Student Preparation) -->
                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="student_preparation" class="form-label">مشق کروائی / طلبہ کی تیاری</label>
                                    <div class="rating-group d-flex gap-3 mt-2">
                                        @for($i = 1; $i <= 5; $i++)
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="student_preparation" 
                                                    value="{{ $i }}" id="student_preparation_{{ $i }}" onchange="calculateTotal()">
                                                <label class="form-check-label" for="student_preparation_{{ $i }}">{{ $i }}</label>
                                            </div>
                                        @endfor
                                    </div>
                                </div>
                            </div>

                            <!-- Field 9: گفتگو کا معیار (Standard of Conversation) -->
                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="conversation_standard" class="form-label">گفتگو کا معیار</label>
                                    <div class="rating-group d-flex gap-3 mt-2">
                                        @for($i = 1; $i <= 5; $i++)
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="conversation_standard" 
                                                    value="{{ $i }}" id="conversation_standard_{{ $i }}" onchange="calculateTotal()">
                                                <label class="form-check-label" for="conversation_standard_{{ $i }}">{{ $i }}</label>
                                            </div>
                                        @endfor
                                    </div>
                                </div>
                            </div>

                            <!-- Field 10: حفظ قرآن / دوران تعلیم و تدریس (Hifz-e-Quran / during Teaching) -->
                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="hifz_during_teaching" class="form-label">حفظ قرآن / دوران تعلیم و تدریس</label>
                                    <div class="rating-group d-flex gap-3 mt-2">
                                        @for($i = 1; $i <= 5; $i++)
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="hifz_during_teaching" 
                                                    value="{{ $i }}" id="hifz_during_teaching_{{ $i }}" onchange="calculateTotal()">
                                                <label class="form-check-label" for="hifz_during_teaching_{{ $i }}">{{ $i }}</label>
                                            </div>
                                        @endfor
                                    </div>
                                </div>
                            </div>

                            <!-- Field 11: حفظ قرآن / روانی (Hifz-e-Quran / Fluency) -->
                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="hifz_fluency" class="form-label">حفظ قرآن / روانی</label>
                                    <div class="rating-group d-flex gap-3 mt-2">
                                        @for($i = 1; $i <= 5; $i++)
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="hifz_fluency" 
                                                    value="{{ $i }}" id="hifz_fluency_{{ $i }}" onchange="calculateTotal()">
                                                <label class="form-check-label" for="hifz_fluency_{{ $i }}">{{ $i }}</label>
                                            </div>
                                        @endfor
                                    </div>
                                </div>
                            </div>

                            <!-- Field 12: قراءت (Recitation) -->
                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="recitation" class="form-label">قراءت</label>
                                    <div class="rating-group d-flex gap-3 mt-2">
                                        @for($i = 1; $i <= 5; $i++)
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="recitation" 
                                                    value="{{ $i }}" id="recitation_{{ $i }}" onchange="calculateTotal()">
                                                <label class="form-check-label" for="recitation_{{ $i }}">{{ $i }}</label>
                                            </div>
                                        @endfor
                                    </div>
                                </div>
                            </div>

                            <!-- Field 13: اخلاقی تربیت (Moral Training) -->
                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="moral_training" class="form-label">اخلاقی تربیت</label>
                                    <div class="rating-group d-flex gap-3 mt-2">
                                        @for($i = 1; $i <= 5; $i++)
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="moral_training" 
                                                    value="{{ $i }}" id="moral_training_{{ $i }}" onchange="calculateTotal()">
                                                <label class="form-check-label" for="moral_training_{{ $i }}">{{ $i }}</label>
                                            </div>
                                        @endfor
                                    </div>
                                </div>
                            </div>

                            <!-- Field 14: فکری و اخلاقی تربیت (Intellectual and Moral Training) -->
                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="intellectual_moral_training" class="form-label">فکری و اخلاقی تربیت</label>
                                    <div class="rating-group d-flex gap-3 mt-2">
                                        @for($i = 1; $i <= 5; $i++)
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="intellectual_moral_training" 
                                                    value="{{ $i }}" id="intellectual_moral_training_{{ $i }}" onchange="calculateTotal()">
                                                <label class="form-check-label" for="intellectual_moral_training_{{ $i }}">{{ $i }}</label>
                                            </div>
                                        @endfor
                                    </div>
                                </div>
                            </div>

                            <!-- Field 15: جسمانی طاقت و صحت (Physical Strength and Health) -->
                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="physical_strength_health" class="form-label">جسمانی طاقت و صحت</label>
                                    <div class="rating-group d-flex gap-3 mt-2">
                                        @for($i = 1; $i <= 5; $i++)
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="physical_strength_health" 
                                                    value="{{ $i }}" id="physical_strength_health_{{ $i }}" onchange="calculateTotal()">
                                                <label class="form-check-label" for="physical_strength_health_{{ $i }}">{{ $i }}</label>
                                            </div>
                                        @endfor
                                    </div>
                                </div>
                            </div>

                            <!-- Field 16: استعمال وقت (Time Management) -->
                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="time_management" class="form-label">استعمال وقت</label>
                                    <div class="rating-group d-flex gap-3 mt-2">
                                        @for($i = 1; $i <= 5; $i++)
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="time_management" 
                                                    value="{{ $i }}" id="time_management_{{ $i }}" onchange="calculateTotal()">
                                                <label class="form-check-label" for="time_management_{{ $i }}">{{ $i }}</label>
                                            </div>
                                        @endfor
                                    </div>
                                </div>
                            </div>

                            <!-- Field 17: طلبہ کی کارکردگی (Student Performance) -->
                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="student_performance" class="form-label">طلبہ کی کارکردگی</label>
                                    <div class="rating-group d-flex gap-3 mt-2">
                                        @for($i = 1; $i <= 5; $i++)
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="student_performance" 
                                                    value="{{ $i }}" id="student_performance_{{ $i }}" onchange="calculateTotal()">
                                                <label class="form-check-label" for="student_performance_{{ $i }}">{{ $i }}</label>
                                            </div>
                                        @endfor
                                    </div>
                                </div>
                            </div>

                            <!-- Field 18: ڈائری (Diary) -->
                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="diary" class="form-label">ڈائری</label>
                                    <div class="rating-group d-flex gap-3 mt-2">
                                        @for($i = 1; $i <= 5; $i++)
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="diary" 
                                                    value="{{ $i }}" id="diary_{{ $i }}" onchange="calculateTotal()">
                                                <label class="form-check-label" for="diary_{{ $i }}">{{ $i }}</label>
                                            </div>
                                        @endfor
                                    </div>
                                </div>
                            </div>

                            <!-- Total Marks Field -->
                            <div class="col-xxl-4 col-md-6">
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
            // Function to load teachers based on campus
            function loadTeachers(campusId) {
                if (campusId) {
                    $.ajax({
                        url: '/get-teachers/' + campusId,
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            $('#teacher_id').empty();
                            $('#teacher_id').append('<option value="">استاد منتخب کریں</option>');

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
                    $('#teacher_id').append('<option value="">استاد منتخب کریں</option>');
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
                $('#class_id').html('<option value="">کلاس منتخب کریں</option>');
                $('#section_id').html('<option value="">سیکشن منتخب کریں</option>');
                $('#subject_id').html('<option value="">مضمون منتخب کریں</option>');
            });
        });
    </script>

    <script>
        function calculateTotal() {
            let total = 0;

            // List of field names
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
                const selectedRadio = document.querySelector(`input[name="${field}"]:checked`);
                const value = selectedRadio ? parseInt(selectedRadio.value) : 0;
                total += value;
            });

            // Display the total in the total_marks field
            document.getElementById('total_marks').value = total;
        }
    </script>

    <script type="text/javascript">
        function fetchClasses() {
            let teacherId = document.getElementById('teacher_id').value;
            if (teacherId) {
                fetch(`/get-classes/${teacherId}`)
                    .then(response => response.json())
                    .then(data => {
                        let classDropdown = document.getElementById('class_id');
                        classDropdown.innerHTML = '<option value="">کلاس منتخب کریں</option>';
                        data.forEach(classData => {
                            classDropdown.innerHTML += `<option value="${classData.id}">${classData.name}</option>`;
                        });
                        // Clear dependent dropdowns
                        document.getElementById('section_id').innerHTML = '<option value="">سیکشن منتخب کریں</option>';
                        document.getElementById('subject_id').innerHTML = '<option value="">مضمون منتخب کریں</option>';
                    })
                    .catch(error => console.error('Error fetching classes:', error));
            } else {
                document.getElementById('class_id').innerHTML = '<option value="">کلاس منتخب کریں</option>';
                document.getElementById('section_id').innerHTML = '<option value="">سیکشن منتخب کریں</option>';
                document.getElementById('subject_id').innerHTML = '<option value="">مضمون منتخب کریں</option>';
            }
        }

        function fetchSections() {
            let classId = document.getElementById('class_id').value;
            if (classId) {
                fetch(`/get-sections-by-class?class_id=${classId}`)
                    .then(response => response.json())
                    .then(data => {
                        let sectionDropdown = document.getElementById('section_id');
                        sectionDropdown.innerHTML = '<option value="">سیکشن منتخب کریں</option>';
                        if (Array.isArray(data.sections) && data.sections.length > 0) {
                            data.sections.forEach(section => {
                                sectionDropdown.innerHTML += `<option value="${section.id}">${section.name}</option>`;
                            });
                        } else {
                            sectionDropdown.innerHTML = '<option value="">No Sections Available</option>';
                        }
                        // Clear subject dropdown
                        document.getElementById('subject_id').innerHTML = '<option value="">مضمون منتخب کریں</option>';
                    })
                    .catch(error => console.error('Error fetching sections:', error));
            } else {
                document.getElementById('section_id').innerHTML = '<option value="">سیکشن منتخب کریں</option>';
                document.getElementById('subject_id').innerHTML = '<option value="">مضمون منتخب کریں</option>';
            }
        }

        function fetchSubjects() {
            let sectionId = document.getElementById('section_id').value;
            if (sectionId) {
                fetch(`/get-subjects-by-section?section_id=${sectionId}`)
                    .then(response => response.json())
                    .then(data => {
                        let subjectDropdown = document.getElementById('subject_id');
                        subjectDropdown.innerHTML = '<option value="">مضمون منتخب کریں</option>';
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
                document.getElementById('subject_id').innerHTML = '<option value="">مضمون منتخب کریں</option>';
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

        #total_marks {
            background-color: #e9ecef;
            font-weight: bold;
            color: #495057;
        }
    </style>
@endsection