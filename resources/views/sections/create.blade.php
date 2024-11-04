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
            Sections Form
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1"> Sections Form </h4>
                    <a href="{{ route('sections.index') }}" class="btn btn-primary ms-auto">Back</a>
                </div><!-- end card header -->
                <div class="card-body">

                    <form method="POST" action="{{ route('sections.store') }}">
                        @csrf
                        <div class="row gy-4">
                            <div class="col-xxl-12 col-md-6">
                                <div>
                                    <label for="name" class="form-label">Section Name</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                        id="name" name="name" required>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <!--end col-->
                             <!-- Class Dropdown -->
        <div class="col-xxl-12 col-md-6">
            <div>
                <label for="class_id" class="form-label">Class</label>
                <select class="form-select @error('class_id') is-invalid @enderror" id="class_id" name="class_id" required>
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
        <!--end col-->

                            <div class="col-xxl-12 col-md-12">
                                <div>
                                    <label for="code" class="form-label">Code (optional)</label>
                                    <input type="text" class="form-control @error('code') is-invalid @enderror"
                                        id="code" name="code">
                                    @error('code')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <!--end col-->
                        </div>
                        <!--end row-->

                        <div class="mt-4">
                            <button type="submit" class="btn btn-primary">Submit</button>
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
@endsection
