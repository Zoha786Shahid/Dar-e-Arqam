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
            ناظرہ رپورٹ
        @endslot
    @endcomponent
    @include('partials.alerts')

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1"> ناظرہ رپورٹ</h4>
                    <a href="{{ route('report.create') }}" class="btn btn-primary ms-auto">Create </a>
                </div><!-- end card header -->
                <div class="card-body">
                    <!-- Bordered Tables -->
                    <table class="table table-bordered table-nowrap">
                        <thead>
                            <tr>
                                <th scope="col">Name</th>
                                <th scope="col">Time Management</th>

                                <th scope="col">Moral Training</th>
                                <th scope="col">Created At</th>
                                <th scope="col">Total Marks</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($reports as $report)
                                <tr>
                                    <td>{{ $report->teacher->first_name ?? 'N/A' }}
                                        {{ $report->teacher->last_name ?? '' }}</td>

                                    <td>{{ $report->time_management }}</td>


                                    <td>{{ $report->moral_training }}</td>
                                    <td>{{ $report->created_at->format('Y-m-d') }}</td>
                                    <td>{{ $report->total_marks ?? 'N/A' }}</td>
                                    {{-- <td>
                                        <div class="dropdown">
                                            <a href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown"
                                                aria-expanded="false">
                                                <i class="ri-more-2-fill"></i>
                                            </a>
                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                <li><a class="dropdown-item" href="{{ route('reportcard.download', $report->id) }}">Download</a></li>

                                                <li><a class="dropdown-item"
                                                        href="{{ route('report.edit', $report->id) }}">Edit</a></li>
                                                <li>
                                                    <a class="dropdown-item" href="#"
                                                        onclick="confirmDelete(event, 'delete-form-{{ $report->id }}')">
                                                        Delete
                                                    </a>
                                                </li>
                                                <form id="delete-form-{{ $report->id }}"
                                                    action="{{ route('report.destroy', $report->id) }}" method="POST"
                                                    style="display: none;">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                            </ul>
                                        </div>
                                    </td> --}}

                                    <td>
                                        <!-- Check if the user has permission to edit the section -->
                                        {{-- @can('update', $section) --}}
                                        <a href="{{ route('report.edit', $report->id) }}" class="btn btn-sm btn-warning">
                                            <i class="ri-edit-line"></i> Edit
                                        </a>
                                        {{-- @endcan --}}
                                        <a href="{{ route('reportcard.download', $report->id) }}"
                                            class="btn btn-sm btn-success">
                                            <i class="ri-download-line"></i> Download
                                        </a>

                                        <!-- Check if the user has permission to delete the section -->
                                        {{-- @can('delete', $section) --}}
                                        <form id="delete-form-{{ $report->id }}"
                                            action="{{ route('report.destroy', $report->id) }}" method="POST"
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
    {{-- <script src="{{ URL::asset('build/libs/prismjs/prism.js') }}"></script>
    <script src="{{ URL::asset('build/js/app.js') }}"></script> --}}
@endsection
