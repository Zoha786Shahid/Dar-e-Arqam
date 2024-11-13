@extends('layouts.master')

@section('title')
    @lang('translation.evaluation-form')
@endsection

@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            Forms
        @endslot
        @slot('title')
            Permissions
        @endslot
    @endcomponent
    @include('partials.alerts')

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1"> Permissions</h4>
                    <a href="{{ route('permissions.create') }}" class="btn btn-primary ms-auto">Create </a>
                </div><!-- end card header -->
                <div class="card-body">
                    <!-- Bordered Tables -->
                    <table class="table table-bordered table-nowrap">
                        <thead>
                            <tr>
                                <th scope="col">Permission Name</th>
                                <th scope="col">Guard Name</th>
                                <th scope="col">Created At</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($permissions as $permission)
                                <tr>
                                    <td>{{ $permission->name }}</td> <!-- Display permission name -->
                                    <td>{{ $permission->guard_name }}</td> <!-- Display guard name -->
                                    <td>{{ $permission->created_at->format('Y-m-d') }}</td> <!-- Display created at date -->
                                   
                                        <td>
                                            <!-- Check if the user has permission to edit the section -->
                                            {{-- @can('update', $section) --}}
                                            <a href="{{ route('permissions.edit', $permission->id) }}" class="btn btn-sm btn-warning">
                                                <i class="ri-edit-line"></i> Edit
                                            </a>
                                            {{-- @endcan --}}
                                      
                                            <!-- Check if the user has permission to delete the section -->
                                            {{-- @can('delete', $section) --}}
                                            <form id="delete-form-{{ $permission->id }}"
                                                action="{{ route('permissions.destroy', $permission->id) }}" method="POST"
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
