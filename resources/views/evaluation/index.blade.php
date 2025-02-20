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

                    {{-- Align all elements in one row --}}
                    <div class="d-flex align-items-center gap-2 ms-auto">
                        <form method="GET" action="{{ route('evaluation.batchDownload') }}" class="d-flex align-items-center">
                            <select name="subject_id" class="form-control me-2">
                                <option value="">Select Subject</option>
                                @foreach ($subjects as $subject)
                                    <option value="{{ $subject->id }}" 
                                        {{ request('subject_id') == $subject->id ? 'selected' : '' }}>
                                        {{ $subject->name }}
                                    </option>
                                @endforeach
                            </select>
                            <button type="submit" class="btn btn-primary">Download</button>
                        </form>

                        <form method="GET" action="{{ route('evaluation.index') }}" class="d-flex align-items-center">
                            <input type="text" name="search" class="form-control me-2" placeholder="Search by Teacher Name"
                                value="{{ request('search') }}">
                            <button class="btn btn-primary" type="submit">Search</button>
                        </form>

                        <a href="{{ route('evaluation.create') }}" class="btn btn-primary">Create</a>
                    </div>

                </div><!-- end card header -->

                <div class="card-body">
                    <!-- Bordered Tables -->
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
                                    <td>{{ $evaluation->teacher->first_name ?? 'N/A' }}
                                        {{ $evaluation->teacher->last_name ?? 'N/A' }}</td>
                                    <td>{{ $evaluation->campus->name ?? 'N/A' }}</td>
                                    <td>{{ $evaluation->percentage }}%</td>
                                    <td>{{ $evaluation->created_at->format('Y-m-d') }}</td>
                                    <td>
                                        <a href="{{ route('evaluation.edit', $evaluation->id) }}" class="btn btn-sm btn-warning">
                                            <i class="ri-edit-line"></i> Edit
                                        </a>
                                        <a href="{{ route('evaluation.download', $evaluation->id) }}" class="btn btn-sm btn-success">
                                            <i class="ri-download-line"></i> Download
                                        </a>
                                        <form id="delete-form-{{ $evaluation->id }}"
                                            action="{{ route('evaluation.destroy', $evaluation->id) }}" method="POST"
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
