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

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Permissions Form</h4>
                    <a href="{{ route('permissions.index') }}" class="btn btn-primary ms-auto">Back</a>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('permissions.update', $permission->id) }}">
                        @csrf
                        @method('PUT') <!-- Use PUT method for updating -->
                        
                        <div class="row gy-4">
                            <!-- Permission Name -->
                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="name" class="form-label">Permission Name</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                        id="name" name="name" value="{{ old('name', $permission->name) }}"
                                        placeholder="Enter Permission Name" required>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                    
                            <!-- Guard Name (optional: default to 'web') -->
                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="guard_name" class="form-label">Guard Name</label>
                                    <input type="text" class="form-control @error('guard_name') is-invalid @enderror"
                                        id="guard_name" name="guard_name" value="{{ old('guard_name', $permission->guard_name ?? 'web') }}"
                                        placeholder="Enter Guard Name" required>
                                    @error('guard_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    
                        <!-- Submit Button -->
                        <div class="mt-4">
                            <button type="submit" class="btn btn-primary">Update</button>
                            <a href="{{ route('permissions.index') }}" class="btn btn-secondary">Cancel</a>
                        </div>
                    </form>
                    



                </div>
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

    <script>
        $(document).ready(function() {
            $('.select2').select2({
                placeholder: "Select permissions", // Optional: Add placeholder
                allowClear: true // Optional: Allow users to clear selection
            });
        });
    </script>

    <!-- Your other script files -->
    <script src="{{ URL::asset('build/libs/prismjs/prism.js') }}"></script>
    <script src="{{ URL::asset('build/js/app.js') }}"></script>
@endsection
