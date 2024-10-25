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
                                <th scope="col">Campus</th>
                                <th scope="col">Actions</th> <!-- Action column -->
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($teachers as $teacher)
                                <tr>
                                    <td>{{ $teacher->first_name }}</td>
                                    <td>{{ $teacher->employee_id }}</td>
                                    <td>{{ $teacher->qualification }}</td>
                                    <td>{{ $teacher->experience }}</td>
                                    <td>{{ $teacher->campus ? $teacher->campus->name : 'No Campus' }}</td> <!-- Display the campus name -->
                                    <td>
                                        <!-- Check if the user has permission to view the teacher -->


                                        <!-- Check if the user has permission to edit the teacher -->
                                        @can('update', $teacher)
                                            <a href="{{ route('teacher.edit', $teacher->id) }}" class="btn btn-sm btn-warning">
                                                <i class="ri-edit-line"></i> Edit
                                            </a>
                                        @endcan

                                        <!-- Check if the user has permission to delete the teacher -->
                                        {{-- @can('delete', $teacher) --}}
                                        <form id="delete-form-{{ $teacher->id }}"
                                            action="{{ route('teacher.destroy', $teacher->id) }}" method="POST"
                                            style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger"
                                                onclick="return confirm('Are you sure?')">
                                                <i class="ri-delete-bin-line"></i> Delete
                                            </button>
                                        </form>
                                        {{-- @endcan --}}


                                </tr>
                            @endforeach
                        </tbody>
                    </table>



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
