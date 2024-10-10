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
                                        <div class="dropdown">
                                            <a href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown"
                                                aria-expanded="false">
                                                <i class="ri-more-2-fill"></i>
                                            </a>

                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                <li><a class="dropdown-item"
                                                        href="{{ route('seniorevaluation.download', $seniorevaluation->id) }}">Download</a>
                                                </li>

                                                <li><a class="dropdown-item"
                                                        href="{{ route('seniorevaluation.edit', $seniorevaluation->id) }}">Edit</a></li>
                                                <li>
                                                    <a class="dropdown-item" href="#"
                                                        onclick="confirmDelete(event, 'delete-form-{{ $seniorevaluation->id }}')">
                                                        Delete
                                                    </a>
                                                </li>
                                                <form id="delete-form-{{ $seniorevaluation->id }}"
                                                    action="{{ route('seniorevaluation.destroy', $seniorevaluation->id) }}"
                                                    method="POST" style="display: none;">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
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
    <script src="{{ URL::asset('build/libs/prismjs/prism.js') }}"></script>
    <script src="{{ URL::asset('build/js/app.js') }}"></script>
@endsection
