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
            Sections
        @endslot
    @endcomponent
    @include('partials.alerts')

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Section Form</h4>
                    <a href="{{ route('sections.create') }}" class="btn btn-primary ms-auto">Create Sections</a>
                </div><!-- end card header -->
                <div class="card-body">
                    <!-- Bordered Tables -->
                    <table class="table table-bordered table-nowrap">
                        <thead>
                            <tr>
                                <th scope="col">Section Name</th>
                                <th scope="col">Class Name</th>
                                <th scope="col">Code</th>
                                <th scope="col">Actions</th> <!-- Action column -->
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($sections as $section)
                                <tr>
                                    <td>{{ $section->name }}</td>
                                    <td>{{ $section->class ? $section->class->name : 'N/A' }}</td> <!-- Display Class Name -->
                                    <td>{{ $section->code }}</td>
                                    <td>
                                        <!-- Check if the user has permission to edit the section -->
                                        {{-- @can('update', $section) --}}
                                        <a href="{{ route('sections.edit', $section->id) }}" class="btn btn-sm btn-warning">
                                            <i class="ri-edit-line"></i> Edit
                                        </a>
                                        {{-- @endcan --}}

                                        <!-- Check if the user has permission to delete the section -->
                                        {{-- @can('delete', $section) --}}
                                        <form id="delete-form-{{ $section->id }}"
                                            action="{{ route('sections.destroy', $section->id) }}" method="POST"
                                            style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger"
                                                onclick="return confirm('Are you sure?')">
                                                <i class="ri-delete-bin-line"></i> Delete
                                            </button>
                                        </form>
                                        {{-- @endcan --}}
                                    </td>
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