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
                                        <!-- Edit button -->
                                        {{-- @can('update', $section) --}}
                                        <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-sm btn-warning">
                                            <i class="ri-edit-line"></i> Edit
                                        </a>
                                        {{-- @endcan --}}

                                        <!-- Show button -->
                                        {{-- <a href="{{ route('roles.show', $role->id) }}" class="btn btn-sm btn-info">
                                            <i class="ri-eye-line"></i> Show
                                        </a> --}}

                                        <!-- Delete button -->
                                        <form id="delete-form-{{ $role->id }}"
                                            action="{{ route('roles.destroy', $role->id) }}" method="POST"
                                            style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger"
                                                onclick="return confirm('Are you sure?')">
                                                <i class="ri-delete-bin-line"></i> Delete
                                            </button>
                                        </form>
                                    </td>

                                </tr>

                                <!-- Collapsible Section for Role Permissions -->
                                <tr>
                                    <td colspan="4">
                                        <a class="btn btn-sm btn-info" data-bs-toggle="collapse"
                                            href="#permissions-{{ $role->id }}" role="button" aria-expanded="false"
                                            aria-controls="permissions-{{ $role->id }}">
                                            <i class="ri-eye-line"></i> View Permissions
                                        </a>

                                        <div class="collapse" id="permissions-{{ $role->id }}">
                                            <ul class="list-group mt-2">
                                                @if ($role->permissions->isEmpty())
                                                    <li class="list-group-item">No permissions assigned</li>
                                                @else
                                                    @foreach ($role->permissions as $permission)
                                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                                        {{ $permission->name }}
                                                    
                                                        <!-- Revoke Permission button, hidden for 'Owner' role -->
                                                        @if ($role->name !== 'Owner')
                                                            <form action="{{ route('roles.revokePermission', [$role->id, $permission->id]) }}" method="POST" style="margin: 0;">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-secondary btn-sm" title="Revoke Permission">
                                                                    <i class="fas fa-user-lock"></i> Revoke
                                                                </button>
                                                                
                                                            </form>
                                                        @endif
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ URL::asset('build/js/app.js') }}"></script>
@endsection
