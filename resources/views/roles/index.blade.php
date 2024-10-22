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
            Teacher Performance Report
        @endslot
    @endcomponent
    @include('partials.alerts')

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1"> Roles</h4>
                    <a href="{{ route('roles.create') }}" class="btn btn-primary ms-auto">Create </a>
                </div><!-- end card header -->
                <div class="card-body">
                    <!-- Bordered Tables -->
                    <table class="table table-bordered table-nowrap">
                        <thead>
                            <tr>
                                <th scope="col">Role Name</th>
                                <th scope="col">Guard Name</th>
                                <th scope="col">Created At</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($roles as $role)
                                <tr>
                                    <td>{{ $role->name }}</td> <!-- Display role name -->
                                    <td>{{ $role->guard_name }}</td> <!-- Display guard name -->
                                    <td>{{ $role->created_at->format('Y-m-d') }}</td> <!-- Display created at date -->
                                    <td>
                                        <div class="dropdown">
                                            <a href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="ri-more-2-fill"></i>
                                            </a>
                    
                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                <li><a class="dropdown-item" href="{{ route('roles.show', $role->id) }}">View</a></li>
                                                <li><a class="dropdown-item" href="{{ route('roles.edit', $role->id) }}">Edit</a></li>
                                                <li>
                                                    <a class="dropdown-item" href="#"
                                                        onclick="confirmDelete(event, 'delete-form-{{ $role->id }}')">Delete</a>
                                                </li>
                                                <form id="delete-form-{{ $role->id }}" action="{{ route('roles.destroy', $role->id) }}"
                                                    method="POST" style="display: none;">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                    
                                <!-- Collapsible Section for Role Permissions -->
                                <tr>
                                    <td colspan="4">
                                        <a class="btn btn-secondary" data-bs-toggle="collapse" href="#permissions-{{ $role->id }}"
                                            role="button" aria-expanded="false" aria-controls="permissions-{{ $role->id }}">
                                            View Permissions
                                        </a>
                                        <div class="collapse" id="permissions-{{ $role->id }}">
                                            <ul class="list-group mt-2">
                                                @if($role->permissions->isEmpty())
                                                    <li class="list-group-item">No permissions assigned</li>
                                                @else
                                                    @foreach($role->permissions as $permission)
                                                       
                                                            <!-- Delete Button (Cross) -->
                                                          <!-- Permission Item with Tick Icon and Delete Button -->
<li class="list-group-item d-flex justify-content-between align-items-center">
    {{ $permission->name }}

    <form action="{{ route('roles.revokePermission', [$role->id, $permission->id]) }}" method="POST" style="margin: 0;">
        @csrf
        @method('DELETE')

        <!-- Cross Icon as Delete Button -->
        <button type="submit" class="btn btn-danger btn-sm" title="Revoke Permission">
            <i class="fas fa-times"></i>
        </button>
    </form>
</li>

                                                            
                                                        </li>
                                                    @endforeach
                                                @endif
                                            </ul>
                                        </div>
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
<!-- Add this to your layout to load FontAwesome -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">

    <script src="{{ URL::asset('build/libs/prismjs/prism.js') }}"></script>
    <script src="{{ URL::asset('build/js/app.js') }}"></script>
@endsection
