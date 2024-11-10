@extends('layouts.master')

@section('title')
    @lang('translation.edit-teacher')
@endsection

@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            Forms
        @endslot
        @slot('title')
            Edit Teacher Form
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1"> Edit Teacher Form </h4>
                    @foreach ($errors->all() as $erros)
                        <li>{{ $erros }}</li>
                    @endforeach
                    <a href="{{ route('teacher.index') }}" class="btn btn-primary ms-auto">Back</a>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('teacher.update', $teacher->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row gy-4">
                            @php
                                $fields = [
                                    'first_name' => 'First Name',
                                    'last_name' => 'Last Name',
                                    'date_of_birth' => 'Date of Birth',
                                    'phone_number' => 'Phone Number',
                                    'email' => 'Email',
                                    'employee_id' => 'Employee ID',
                                    'qualification' => 'Qualification',
                                    'experience' => 'Experience (Years)',
                                    'hire_date' => 'Hire Date',
                                    'address' => 'Address',
                                ];
                            @endphp
                            @foreach ($fields as $field => $label)
                                <div class="col-xxl-3 col-md-6">
                                    <div>
                                        <label for="{{ $field }}" class="form-label">{{ $label }}</label>
                                        <input
                                            type="{{ in_array($field, ['date_of_birth', 'hire_date']) ? 'date' : 'text' }}"
                                            class="form-control @error($field) is-invalid @enderror"
                                            id="{{ $field }}" name="{{ $field }}"
                                            value="{{ old($field, $teacher->$field) }}" required>
                                        @error($field)
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            @endforeach

                            <div class="col-xxl-3 col-md-6">
                                <div>
                                    <label for="gender" class="form-label">Gender</label>
                                    <select class="form-select @error('gender') is-invalid @enderror" id="gender"
                                        name="gender" required>
                                        <option value="male" {{ $teacher->gender === 'male' ? 'selected' : '' }}>Male
                                        </option>
                                        <option value="female" {{ $teacher->gender === 'female' ? 'selected' : '' }}>Female
                                        </option>
                                        <option value="other" {{ $teacher->gender === 'other' ? 'selected' : '' }}>Other
                                        </option>
                                    </select>
                                    @error('gender')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-xxl-3 col-md-6">
                                <div>
                                    <label for="campus_id" class="form-label">Campus</label>
                                    <select class="form-select @error('campus_id') is-invalid @enderror" id="campus_id"
                                        name="campus_id" required>
                                        @foreach ($campuses as $campus)
                                            <option value="{{ $campus->id }}"
                                                {{ $teacher->campus_id == $campus->id ? 'selected' : '' }}>
                                                {{ $campus->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('campus_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-xxl-12">
                                <div id="subjectClassSectionContainer">
                                    @foreach ($teacher->teacherSectionSubjects ?? [] as $index => $assignment)
                                        <div class="row gy-3 subject-class-section-group">
                                            <!-- Hidden field for existing assignment ID -->
                                            <input type="hidden" name="assignment_ids[]" value="{{ $assignment->id }}">

                                            <!-- Assign Subjects -->
                                            <div class="col-xxl-3 col-md-6">
                                                <label class="form-label">Assign Subjects</label>
                                                <select class="form-control js-example-disabled-multi" name="subject_ids[]"
                                                    multiple="multiple" required>
                                                    @foreach ($subjects as $subject)
                                                        <option value="{{ $subject->id }}"
                                                            {{ in_array($subject->id, [$assignment->subject_id]) ? 'selected' : '' }}>
                                                            {{ $subject->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <!-- Class Dropdown -->
                                            <div class="col-xxl-3 col-md-6">
                                                <label class="form-label">Class</label>
                                                <select class="form-select classDropdown" name="class_ids[]" required>
                                                    @foreach ($classes as $class)
                                                        <option value="{{ $class->id }}"
                                                            {{ $assignment->class_id == $class->id ? 'selected' : '' }}>
                                                            {{ $class->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <!-- Section Dropdown -->
                                            <div class="col-xxl-3 col-md-6">
                                                <label class="form-label">Section</label>
                                                <select class="form-select sectionDropdown" name="section_ids[]" required>
                                                    @foreach ($sections as $section)
                                                        <option value="{{ $section->id }}"
                                                            {{ $assignment->section_id == $section->id ? 'selected' : '' }}>
                                                            {{ $section->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-xxl-3 col-md-2">
                                                <!-- Add More Button -->
                                                <button type="button" class="btn btn-secondary mt-4 add-more-btn">Add
                                                    More</button>
                                            </div>
                                            <!-- Remove Button -->

                                        </div>
                                    @endforeach
                                </div>

                            </div>

                        </div>

                        <div class="mt-4">
                            <button type="submit" class="btn btn-primary">Update</button>
                            <a href="{{ route('teacher.index') }}" class="btn btn-secondary">Cancel</a>
                        </div>


                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).on('click', '.add-more-btn', function() {
            let newGroup = $('.subject-class-section-group:first').clone();

            // Reset all values in the cloned group
            newGroup.find('select').each(function() {
                $(this).val(null).trigger('change'); // Reset select values
                $(this).removeAttr('data-select2-id'); // Remove Select2 ID
            });

            // Remove existing Select2 containers in the cloned group
            newGroup.find('.select2-container').remove();

            // Reinitialize Select2 for the new group
            newGroup.find('.js-example-disabled-multi').select2({
                placeholder: "Select Subject",
                allowClear: true
            });

            // Clear input values in the cloned group
            newGroup.find('input').val('');

            // Replace "Add More" button with "Remove" button in the cloned group
            newGroup.find('.add-more-btn').replaceWith(
                '<button type="button" class="btn btn-danger remove-btn mt-4">Remove</button>'
            );

            // Append the new group to the container
            $('#subjectClassSectionContainer').append(newGroup);

            // Reinitialize Select2 for the container to ensure all rows are initialized
            $('#subjectClassSectionContainer .js-example-disabled-multi').select2({
                placeholder: "Select Subject",
                allowClear: true
            });
        });

        // Remove Button Functionality
        $(document).on('click', '.remove-btn', function() {
            $(this).closest('.subject-class-section-group').remove(); // Removes the closest group
        });


        $(document).on('change', '.classDropdown', function() {
            var classId = $(this).val();
            var sectionDropdown = $(this).closest('.subject-class-section-group').find('.sectionDropdown');

            if (classId) {
                $.ajax({
                    url: '{{ route('get.sections.by.class') }}',
                    type: 'GET',
                    data: {
                        class_id: classId
                    },
                    success: function(data) {
                        sectionDropdown.empty().append('<option value="">Select Section</option>');
                        $.each(data.sections, function(key, section) {
                            sectionDropdown.append('<option value="' + section.id + '">' +
                                section.name + '</option>');
                        });
                    }
                });
            } else {
                sectionDropdown.empty().append('<option value="">Select Section</option>');
            }
        });
    </script>
@endsection
