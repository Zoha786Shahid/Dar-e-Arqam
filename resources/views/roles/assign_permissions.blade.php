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
            Roles
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Role Form</h4>
                    <a href="{{ route('roles.index') }}" class="btn btn-primary ms-auto">Back</a>
                </div><!-- end card header -->
                <div class="card-body">
                    <form method="POST" action="{{ route('roles.assignPermissions') }}">
                        @csrf

                        <!-- Select Role -->
                        <div class="form-group">
                            <label for="role_name">Select Role</label>
                            <select name="role_name" id="role_name" class="form-control" required>
                                <option value="" disabled selected>Select a Role</option>
                                @foreach ($roles as $role)
                                    <option value="{{ $role->name }}">{{ $role->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Select Permissions (Multiple) -->
                        <div class="form-group mt-3">
                            <label for="permissions">Assign Permissions</label>
                            <select name="permissions[]" id="permissions" class="form-control select2" multiple required>
                                @foreach ($permissions as $permission)
                                    <option value="{{ $permission->name }}">{{ $permission->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="btn btn-primary mt-3">Assign Permissions</button>
                    </form>
                </div>
                <!-- end card body -->
            </div>
        </div>
    </div>
    <!-- end row -->
@endsection

@section('script')
    <!-- Load jQuery before your script -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Include Select2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <!-- Include Select2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <!-- Select2 Initialization -->
    <script>
        $(document).ready(function() {
            // Initialize Select2 for permissions dropdown
            $('#permissions').select2({
                placeholder: "Select permissions", // Optional: Add placeholder
                allowClear: true // Optional: Allow users to clear selection
            });
        });
    </script>

    <!-- Your other script files -->
    <script src="{{ URL::asset('build/libs/prismjs/prism.js') }}"></script>
    <script src="{{ URL::asset('build/js/app.js') }}"></script>

    <!-- jQuery to Fetch and Populate Permissions -->
    <script>
        // When the role is changed, fetch permissions for the selected role
        $('#role_name').on('change', function() {
            let roleName = $(this).val();

            if (roleName) {
                // Make an AJAX call to fetch assigned and all permissions
                $.ajax({
                    url: `/roles/${roleName}/permissions`,
                    type: 'GET',
                    success: function(data) {
                        // Clear the existing options
                        $('#permissions').empty();

                        // Loop through all permissions and append to the dropdown
                        $.each(data.all, function(index, value) {
                            let isSelected = data.assigned.includes(
                            value); // Check if this permission is assigned
                            let option = new Option(value, value, isSelected, isSelected);
                            $('#permissions').append(option);
                        });

                        // Trigger the change event to update the Select2 UI
                        $('#permissions').trigger('change');
                    },
                    error: function() {
                        alert('Unable to fetch permissions.');
                    }
                });
            } else {
                $('#permissions').val([]).trigger('change'); // Clear selection if no role selected
            }
        });
    </script>
@endsection
