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
            Edit User
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Edit User</h4>
                    <a href="{{ route('user.index') }}" class="btn btn-primary ms-auto">Back</a>
                </div><!-- end card header -->
                <div class="card-body">
                    <!-- Form for editing Teacher -->

                    <form action="{{ route('user.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row gy-4">
                            <!-- Name -->
                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" class="form-control" id="name" name="name"
                                        value="{{ old('name', $user->name) }}" required>
                                </div>
                            </div>
                            <!--end col-->

                            <!-- Email -->
                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" name="email"
                                        value="{{ old('email', $user->email) }}" required>
                                </div>
                            </div>
                            <!--end col-->

                            <!-- Password (optional) -->
                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" class="form-control" id="password" name="password"
                                        placeholder="Leave blank if not changing">
                                </div>
                            </div>
                            <!--end col-->
                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="password_confirmation" class="form-label">Confirm Password</label>
                                    <input type="password"
                                        class="form-control @error('password_confirmation') is-invalid @enderror"
                                        id="password_confirmation" name="password_confirmation">
                                    @error('password_confirmation')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>


                            <!-- Avatar Upload -->
                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="avatar" class="form-label">Avatar</label>
                                    <input type="file" class="form-control @error('avatar') is-invalid @enderror" id="avatar" name="avatar">
                                    
                                    @if ($user->avatar)
                                        <img src="{{ asset('images/' . $user->avatar) }}" alt="Avatar" width="50" height="50" class="mt-2">
                                    @else
                                        <p>No avatar uploaded</p> <!-- Message when no avatar is present -->
                                    @endif
                                    
                                    @error('avatar')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <!--end col-->




                            <!-- Role (optional if roles exist) -->
                            {{-- <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="role" class="form-label">Role</label>
                                    <select class="form-select" id="role" name="role_id" required>
                                        <option value="">Select a role</option> <!-- Placeholder option -->
                                        @foreach ($roles as $role)
                                            <option value="{{ $role->id }}" {{ (old('role_id', $user->role_id) == $role->id) ? 'selected' : '' }}>
                                                {{ $role->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('role_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div> --}}
                            <!-- Role (optional if roles exist) -->
<div class="col-xxl-4 col-md-6">
    <div>
        <label for="role" class="form-label">Role</label>
        <select class="form-select" id="role" name="role_id" required>
            <option value="">Select a role</option> <!-- Placeholder option -->
            @foreach ($roles as $role)
                <option value="{{ $role->id }}" {{ (old('role_id', $user->role_id) == $role->id) ? 'selected' : '' }}>
                    {{ $role->name }}
                </option>
            @endforeach
        </select>
        @error('role_id')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>

<!-- Display Permissions -->
<!-- Display Permissions -->
<div class="col-xxl-4 col-md-6">
    <div>
        <label for="permissions" class="form-label">Permissions</label>
        @if ($permissions && $permissions->isNotEmpty())
            @foreach ($permissions as $permission)
                <p>{{ $permission->name }}</p>
            @endforeach
        @else
            <p>No permissions assigned to this role.</p>
        @endif
    </div>
</div>


                            <!--end col-->
                        </div>
                        <!--end row-->

                        <div class="mt-4">
                            <button type="submit" class="btn btn-primary">Update</button>
                            <a href="{{ route('user.index') }}" class="btn btn-secondary">Cancel</a>
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
