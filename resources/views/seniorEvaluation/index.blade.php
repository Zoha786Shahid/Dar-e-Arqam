@extends('layouts.master')

@section('title')
    @lang('translation.seniorevaluation-form')
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
                    <h4 class="card-title mb-0 flex-grow-1"> Senior Evaluation Report</h4>
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <form method="GET" action="{{ route('seniorevaluation.index') }}">
                                <div class="input-group">
                                    <input type="text" name="search" class="form-control" placeholder="Search by Teacher Name"
                                        value="{{ request('search') }}">
                                    <button class="btn btn-primary" type="submit">Search</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <a href="{{ route('seniorevaluation.create') }}" class="btn btn-primary ms-auto">Create </a>
                </div><!-- end card header -->
                <div class="card-body">
                    <!-- Bordered Tables -->
                    <table class="table table-bordered table-nowrap">
                        <thead>
                            <tr>
                                <th scope="col">Teacher name</th>
                                <th scope="col">Campus</th>
                                <th scope="col">Total Marks</th>
                                <th scope="col">Created At</th>
                                <th scope="col">Action</th>
                
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($reports as $seniorevaluation)
                                <tr>
                                    <!-- Display the teacher's name from the relationship -->
                                    <td>{{ $seniorevaluation->teacher->first_name ?? 'N/A' }}
                                        {{ $seniorevaluation->teacher->last_name ?? '' }}</td>
                                    <!-- Display campus name -->
                                    <td>{{ $seniorevaluation->campus->name ?? 'N/A' }}</td>
                                    <td>{{ $seniorevaluation->total_marks ?? 'N/A' }}</td>
                                    <td>{{ $seniorevaluation->created_at->format('Y-m-d') }}</td>
                                   
                                    <td>
                                        <!-- Check if the user has permission to edit the section -->
                                        {{-- @can('update', $section) --}}
                                        <a href="{{ route('seniorevaluation.edit',  $seniorevaluation->id) }}" class="btn btn-sm btn-warning">
                                            <i class="ri-edit-line"></i> Edit
                                        </a>
                                        {{-- @endcan --}}
                                        <a href="{{ route('seniorevaluation.download', $seniorevaluation->id) }}"
                                            class="btn btn-sm btn-success">
                                            <i class="ri-download-line"></i> Download
                                        </a>
                                        <!-- Check if the user has permission to delete the section -->
                                        {{-- @can('delete', $section) --}}
                                        <form id="delete-form-{{  $seniorevaluation->id }}"
                                            action="{{ route('seniorevaluation.destroy', $seniorevaluation->id) }}" method="POST"
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
