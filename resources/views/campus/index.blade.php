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
            Campus
        @endslot
    @endcomponent
    @include('partials.alerts')

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Campus Form</h4>
                    <a href="{{ route('campus.create') }}" class="btn btn-primary ms-auto">Create Campus</a>
                </div><!-- end card header -->
                <div class="card-body">
                    <!-- Bordered Tables -->
                    <table class="table table-bordered table-nowrap">
                        <thead>
                            <tr>
                                <th scope="col">Name</th>
                                <th scope="col">City</th>
                                <th scope="col">Capacity</th>
                                <th scope="col">Status</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($campuses as $campus)
                                <tr>
                                    <td>{{ $campus->name }}</td>
                                    <td>{{ $campus->city }}</td>
                                    <td>{{ $campus->capacity }}</td>
                                    <td>
                                        @if ($campus->status == 'active')
                                            <span class="badge badge-soft-success">Active</span>
                                        @elseif($campus->status == 'inactive')
                                            <span class="badge badge-soft-secondary">Inactive</span>
                                        @else
                                            <span class="badge badge-soft-danger">Unknown</span>
                                        @endif
                                    </td>

                                    <td>
                                        <!-- Check if the user has permission to edit the section -->
                                        {{-- @can('update', $section) --}}
                                        <a href="{{ route('campus.edit', $campus->id) }}" class="btn btn-sm btn-warning">
                                            <i class="ri-edit-line"></i> Edit
                                        </a>
                                        {{-- @endcan --}}

                                        <!-- Check if the user has permission to delete the section -->
                                        {{-- @can('delete', $section) --}}
                                        <form id="delete-form-{{ $campus->id }}"
                                            action="{{ route('campus.destroy', $campus->id) }}" method="POST"
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
