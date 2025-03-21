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
                    <h4 class="card-title mb-0 flex-grow-1">Evaluation Report</h4>
    
                    <div class="d-flex align-items-center gap-2 ms-auto">
                        {{-- <form method="GET" action="{{ route('evaluation.batchDownload') }}" class="d-flex align-items-center">
    
                            @if(auth()->user()->hasRole('Principal'))
                                <!-- Auto-selected campus for Principal -->
                                <input type="hidden" name="campus_id" value="{{ auth()->user()->campus_id }}">
                                
                                <!-- Teacher dropdown based on the selected campus -->
                                <select name="teacher_id" class="form-control me-2" required>
                                    <option value="">Select Teacher</option>
                                    @foreach ($teachers->where('campus_id', auth()->user()->campus_id) as $teacher)
                                        <option value="{{ $teacher->id }}">{{ $teacher->first_name }} {{ $teacher->last_name }}</option>
                                    @endforeach
                                </select>
    
                            @else
                                <!-- Filters for other roles like Owner -->
                                <select name="campus_id" class="form-control me-2" id="campus_id" required>
                                    <option value="">Select Campus</option>
                                    @foreach ($campuses as $campus)
                                        <option value="{{ $campus->id }}">{{ $campus->name }}</option>
                                    @endforeach
                                </select>
                                <select class="form-control me-2 classDropdown" name="class_ids[]" required>
                                    <option value="">Select Class</option>
                                    @foreach ($classes as $class)
                                        <option value="{{ $class->id }}">{{ $class->name }}</option>
                                    @endforeach
                                </select>
                                <select name="subject_id" class="form-control me-2">
                                    <option value="">Select Subject</option>
                                    @foreach ($subjects as $subject)
                                        <option value="{{ $subject->id }}" 
                                            {{ request('subject_id') == $subject->id ? 'selected' : '' }}>
                                            {{ $subject->name }}
                                        </option>
                                    @endforeach
                                </select>
                            @endif
    
                            <button type="submit" class="btn btn-primary">Download</button>
                        </form> --}}
                        <form method="GET" action="{{ route('evaluation.batchDownload') }}" class="d-flex align-items-center">
                            @if(auth()->user()->hasRole('Owner') || auth()->user()->hasRole('Principal'))
                                <select name="campus_id" class="form-control me-2" id="campus_id" required>
                                    <option value="">Select Campus</option>
                                    @foreach ($campuses as $campus)
                                        <option value="{{ $campus->id }}" {{ auth()->user()->hasRole('Principal') && auth()->user()->campus_id == $campus->id ? 'selected' : '' }}>
                                            {{ $campus->name }}
                                        </option>
                                    @endforeach
                                </select>
                        
                                <select class="form-control me-2 classDropdown" name="class_ids[]">
                                    <option value="">Select Class</option>
                                    @foreach ($classes as $class)
                                        <option value="{{ $class->id }}">{{ $class->name }}</option>
                                    @endforeach
                                </select>
                        
                                @if(auth()->user()->hasRole('Principal'))
                                    <select name="teacher_id" class="form-control me-2">
                                        <option value="">Select Teacher</option>
                                        @foreach ($teachers->where('campus_id', auth()->user()->campus_id) as $teacher)
                                            <option value="{{ $teacher->id }}">{{ $teacher->first_name }} {{ $teacher->last_name }}</option>
                                        @endforeach
                                    </select>
                                @endif
                        
                                <select name="subject_id" class="form-control me-2">
                                    <option value="">Select Subject</option>
                                    @foreach ($subjects as $subject)
                                        <option value="{{ $subject->id }}" {{ request('subject_id') == $subject->id ? 'selected' : '' }}>
                                            {{ $subject->name }}
                                        </option>
                                    @endforeach
                                </select>
                            @endif
                            <button type="submit" class="btn btn-primary">Download</button>
                        </form>
    
                        <form method="GET" action="{{ route('evaluation.index') }}" class="d-flex align-items-center">
                            <input type="text" name="search" class="form-control me-2" placeholder="Search by Teacher Name" value="{{ request('search') }}">
                            <button class="btn btn-primary" type="submit">Search</button>
                        </form>
    
                        <a href="{{ route('evaluation.create') }}" class="btn btn-primary">Create</a>
                    </div>
    
                </div><!-- end card header -->
    
                <div class="card-body">
                    <table class="table table-bordered table-nowrap">
                        <thead>
                            <tr>
                                <th scope="col">Teacher Name</th>
                                <th scope="col">Campus</th>
                                <th scope="col">Percentage</th>
                                <th scope="col">Created At</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($evaluations as $evaluation)
                                <tr>
                                    <td>{{ $evaluation->teacher->first_name ?? 'N/A' }} {{ $evaluation->teacher->last_name ?? 'N/A' }}</td>
                                    <td>{{ $evaluation->campus->name ?? 'N/A' }}</td>
                                    <td>{{ $evaluation->percentage }}%</td>
                                    <td>{{ $evaluation->created_at->format('Y-m-d') }}</td>
                                    <td>
                                        <a href="{{ route('evaluation.edit', $evaluation->id) }}" class="btn btn-sm btn-warning"><i class="ri-edit-line"></i> Edit</a>
                                        <a href="{{ route('evaluation.download', $evaluation->id) }}" class="btn btn-sm btn-success"><i class="ri-download-line"></i> Download</a>
                                        <form id="delete-form-{{ $evaluation->id }}" action="{{ route('evaluation.destroy', $evaluation->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">
                                                <i class="ri-delete-bin-line"></i> Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div><!-- end card body -->
            </div>
        </div>
    </div>
    
    
    <!-- end row -->
@endsection
@section('script')
    <script>
        $(document).on('change', '.classDropdown', function() {
            var classId = $(this).val();
            var sectionDropdown = $(this).closest('form').find('.sectionDropdown');

            if (classId) {
                $.ajax({
                    url: '{{ route('get.sections.by.class') }}',
                    type: 'GET',
                    data: {
                        class_id: classId
                    },
                    success: function(data) {
                        sectionDropdown.empty().append('<option value="">Select Section</option>');
                        $.each(data.sections, function(key, section) {
                            sectionDropdown.append('<option value="' + section.id + '">' +
                                section.name + '</option>');
                        });
                    },
                    error: function(xhr) {
                        console.log(xhr.responseText);
                    }
                });
            } else {
                sectionDropdown.empty().append('<option value="">Select Section</option>');
            }
        });
    </script>
@endsection
