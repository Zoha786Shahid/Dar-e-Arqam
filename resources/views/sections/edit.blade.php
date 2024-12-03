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
            Edit Section
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Edit Section</h4>
                    <a href="{{ route('sections.index') }}" class="btn btn-primary ms-auto">Back</a>
                </div><!-- end card header -->
                <div class="card-body">
                    <!-- Form for editing Teacher -->
                    <form method="POST" action="{{ route('sections.update', $section->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="row gy-4">
                                   <!--end col-->
                                   <div class="col-xxl-12 col-md-6">
                                    <div>
                                        <label for="class_id" class="form-label">Class</label>
                                        <select class="form-select @error('class_id') is-invalid @enderror" id="class_id"
                                            name="class_id" required>
                                            <option value="">Select Class</option>
                                            @foreach ($classes as $class)
                                                <option value="{{ $class->id }}"
                                                    {{ old('class_id', $section->class_id) == $class->id ? 'selected' : '' }}>
                                                    {{ $class->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('class_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <!--end col-->
                            <div class="col-xxl-12 col-md-6">
                                <div>
                                    <label for="section" class="form-label">Section Name</label>
                                    <select class="form-control select2 @error('section') is-invalid @enderror"
                                        id="section" name="section[]" multiple required>
                                        @foreach ($sections as $sectionName)
                                            <option value="{{ $sectionName }}"
                                                {{ in_array($sectionName, explode(',', $section->name)) ? 'selected' : '' }}>
                                                {{ $sectionName }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('section')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                     
                            <div class="col-xxl-12 col-md-12">
                                <div>
                                    <label for="code" class="form-label">Code (optional)</label>
                                    <input type="text" class="form-control @error('code') is-invalid @enderror"
                                        id="code" name="code" value="{{ old('code', $section->code) }}">
                                    @error('code')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <!--end col-->
                        </div>
                        <!--end row-->

                        <div class="mt-4">
                            <button type="submit" class="btn btn-primary">Update</button>
                            <a href="{{ route('sections.index') }}" class="btn btn-secondary">Cancel</a>
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
    <script src="{{ URL::asset('build/libs/prismjs/prism.js') }}"></script>
    <script src="{{ URL::asset('build/js/app.js') }}"></script>
    <!-- Select2 CSS -->
    <script>
        $(document).ready(function() {
            $('#section').select2({
                placeholder: "Select Section(s)",
                allowClear: true
            });
        });
    </script>
@endsection
