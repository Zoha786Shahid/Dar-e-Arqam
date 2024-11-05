@extends('layouts.master')

@section('title')
    @lang('translation.campus-form')
@endsection

@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            Forms
        @endslot
        @slot('title')
            Teachers Form
        @endslot
    @endcomponent
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <style>
        .select2-container--default .select2-selection--multiple .select2-selection__choice {
            color: black;
        }
    </style>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1"> Teachers Form </h4>
                    <a href="{{ route('teacher.index') }}" class="btn btn-primary ms-auto">Back</a>
                </div><!-- end card header -->
                <div class="card-body">
                    <form method="POST" action="{{ route('teacher.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row gy-4">
                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="first_name" class="form-label">First Name</label>
                                    <input type="text" class="form-control @error('first_name') is-invalid @enderror"
                                        id="first_name" name="first_name" required>
                                    @error('first_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <!--end col-->

                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="last_name" class="form-label">Last Name</label>
                                    <input type="text" class="form-control @error('last_name') is-invalid @enderror"
                                        id="last_name" name="last_name" required>
                                    @error('last_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <!--end col-->

                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="date_of_birth" class="form-label">Date of Birth</label>
                                    <input type="date" class="form-control @error('date_of_birth') is-invalid @enderror"
                                        id="date_of_birth" name="date_of_birth" required>
                                    @error('date_of_birth')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <!--end col-->

                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="gender" class="form-label">Gender</label>
                                    <select class="form-select @error('gender') is-invalid @enderror" id="gender"
                                        name="gender" required>
                                        <option value="male">Male</option>
                                        <option value="female">Female</option>
                                        <option value="other">Other</option>
                                    </select>
                                    @error('gender')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <!--end col-->

                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="phone_number" class="form-label">Phone Number</label>
                                    <input type="text" class="form-control @error('phone_number') is-invalid @enderror"
                                        id="phone_number" name="phone_number" required>
                                    @error('phone_number')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <!--end col-->

                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror"
                                        id="email" name="email" required>
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <!--end col-->
                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="campus_id" class="form-label">Campus</label>
                                    <select class="form-select @error('campus_id') is-invalid @enderror" id="campus_id"
                                        name="campus_id" required>
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
                                    <label for="classes" class="form-label">Class</label>
                                    <select class="form-select @error('class_id') is-invalid @enderror" id="classDropdown"
                                        name="class_id" required>
                                        <option value="">Select Class</option>
                                        @foreach ($classes as $class)
                                            <option value="{{ $class->id }}">{{ $class->name }}</option>
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
                                    <label for="sections" class="form-label">Section</label>
                                    <select class="form-select @error('section_ids') is-invalid @enderror"
                                        id="sectionDropdown" name="section_ids[]" required>
                                        <option value="">Select Section</option>
                                    </select>

                                    @error('section_ids')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="subjects" class="form-label">Assign Subjects </label>
                                    <!-- <select class="selectpicker @error('campus_id') is-invalid @enderror" id="sections"
                                        name="subject_ids[]" multiple required data-live-search="true"
                                        data-style="btn-white" title="Nothing selected">
                                        @foreach ($subjects as $subject)
                                            <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                                        @endforeach
                                    </select> -->
                                    
                                        <div class="vstack gap-3">
                                        <select class="form-control js-example-disabled-multi"  name="subject_ids[]" multiple="multiple">
                                            <option value="" selected>Select subject</option>
                                        @foreach ($subjects as $subject)
                                        <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                                    @endforeach
                                        </select>
                                        </div>
                                    @error('subject_ids')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <!--end col-->
                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="address" class="form-label">Address</label>
                                    <input type="text" class="form-control @error('address') is-invalid @enderror"
                                        id="address" name="address" required>
                                    @error('address')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <!--end col-->

                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="employee_id" class="form-label">Employee ID</label>
                                    <input type="text" class="form-control @error('employee_id') is-invalid @enderror"
                                        id="employee_id" name="employee_id" required>
                                    @error('employee_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <!--end col-->

                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="hire_date" class="form-label">Hire Date</label>
                                    <input type="date" class="form-control @error('hire_date') is-invalid @enderror"
                                        id="hire_date" name="hire_date" required>
                                    @error('hire_date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>


                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="qualification" class="form-label">Qualification</label>
                                    <input type="text"
                                        class="form-control @error('qualification') is-invalid @enderror"
                                        id="qualification" name="qualification" required>
                                    @error('qualification')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <!--end col-->

                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="experience" class="form-label">Experience (Years)</label>
                                    <input type="number" class="form-control @error('experience') is-invalid @enderror"
                                        id="experience" name="experience" required>
                                    @error('experience')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>


                            <!--end col-->

                        </div>
                        <!--end row-->


                      




                        <div class="mt-4">
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <a href="{{ route('teacher.index') }}" class="btn btn-secondary">Cancel</a>
                        </div>
                    </form>

                </div>
                <!-- end card body -->
            </div>
        </div>
    </div>
    <!-- end row -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="assets/js/pages/select2.init.js"></script>
@endsection

@section('script')


    <script type="text/javascript">
        $(document).ready(function() {
            $('.selectpicker').selectpicker();
        });
    </script>

    <!-- Additional Scripts for other Dropdowns -->
    <script>
        $(document).ready(function() {
            $('#classDropdown').on('change', function() {
                var classId = $(this).val();
                if (classId) {
                    $.ajax({
                        url: '{{ route('get.sections.by.class') }}', // Fetch sections route
                        type: 'GET',
                        data: {
                            class_id: classId
                        },
                        success: function(data) {
                            $('#sectionDropdown').empty();
                            $('#sectionDropdown').append(
                                '<option value="">Select Section</option>');
                            $.each(data.sections, function(key, section) {
                                $('#sectionDropdown').append('<option value="' + section
                                    .id + '">' + section.name + '</option>');
                            });
                        }
                    });
                } else {
                    $('#sectionDropdown').empty();
                    $('#sectionDropdown').append('<option value="">Select Section</option>');
                }
            });
        });
    </script>
@endsection
