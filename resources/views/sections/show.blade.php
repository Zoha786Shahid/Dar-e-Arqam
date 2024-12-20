@extends('layouts.master')

@section('title')
    @lang('translation.teacher-form')
@endsection

@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            Forms
        @endslot
        @slot('title')
            Teacher
        @endslot
    @endcomponent
    @include('partials.alerts')

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Teacher Form</h4>
                    <a href="{{ route('teacher.create') }}" class="btn btn-primary ms-auto">Create Teacher</a>
                </div><!-- end card header -->
                <div class="card-body">
                    <!-- Bordered Tables -->
               
                    <table class="table table-bordered table-nowrap">
                        <thead>
                            <tr>
                                <th scope="col">Name</th>
                                <th scope="col">Employee Id</th>
                                <th scope="col">Qualification</th>
                                <th scope="col">Experience</th>
                                <th scope="col">Subjects</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ $teacher->name }}</td>
                                <td>{{ $teacher->employee_id }}</td>
                                <td>{{ $teacher->qualification }}</td>
                                <td>{{ $teacher->experience }}</td>
                                <td>{{ $teacher->subjects }}</td>
                            </tr>
                        </tbody>
                    </table>
                
                    <a href="{{ route('teachers.index') }}" class="btn btn-primary mt-3">Back to List</a>
                </div>

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
