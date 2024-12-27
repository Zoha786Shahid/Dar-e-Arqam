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
            Edit Campus
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Edit Campus</h4>
                    <a href="{{ route('campus.index') }}" class="btn btn-primary ms-auto">Back</a>
                </div><!-- end card header -->
                <div class="card-body">
                    <!-- Form for editing campus -->

                    <form action="{{ route('campus.update', $campus->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT') <!-- or @method('PATCH') -->
                        <div class="row gy-4">
                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" class="form-control" id="name" name="name"
                                        value="{{ old('name', $campus->name) }}" required>
                                </div>
                            </div>
                            <!--end col-->

                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="address" class="form-label">Address</label>
                                    <input type="text" class="form-control" id="address" name="address"
                                        value="{{ old('address', $campus->address) }}" required>
                                </div>
                            </div>
                            <!--end col-->

                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="city" class="form-label">City</label>
                                    <input type="text" class="form-control" id="city" name="city"
                                        value="{{ old('city', $campus->city) }}" required>
                                </div>
                            </div>
                            <!--end col-->

                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="state" class="form-label">State</label>
                                    <input type="text" class="form-control" id="state" name="state"
                                        value="{{ old('state', $campus->state) }}">
                                </div>
                            </div>
                            <!--end col-->

                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="country" class="form-label">Country</label>
                                    <input type="text" class="form-control" id="country" name="country"
                                        value="{{ old('country', $campus->country) }}" required>
                                </div>
                            </div>
                            <!--end col-->

                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="postal_code" class="form-label">Postal Code</label>
                                    <input type="text" class="form-control" id="postal_code" name="postal_code"
                                        value="{{ old('postal_code', $campus->postal_code) }}">
                                </div>
                            </div>
                            <!--end col-->

                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="phone_number" class="form-label">Phone Number</label>
                                    <input type="text" class="form-control" id="phone_number" name="phone_number"
                                        value="{{ old('phone_number', $campus->phone_number) }}">
                                </div>
                            </div>
                            <!--end col-->

                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" name="email"
                                        value="{{ old('email', $campus->email) }}">
                                </div>
                            </div>
                            <!--end col-->

                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="website" class="form-label">Website</label>
                                    <input type="url" class="form-control" id="website" name="website"
                                        value="{{ old('website', $campus->website) }}">
                                </div>
                            </div>
                            <!--end col-->

                            <!--end col-->

                          
                            <!--end col-->

                       
                            <!--end col-->

                            <div class="col-xxl-6 col-md-6">
                                <div>
                                    <label for="capacity" class="form-label">Capacity</label>
                                    <input type="number" class="form-control" id="capacity" name="capacity"
                                        value="{{ old('capacity', $campus->capacity) }}">
                                </div>
                            </div>
                            <!--end col-->
                            <div class="col-xxl-6 col-md-6">
                                <div>
                                    <label for="status" class="form-label">Status</label>
                                    <select class="form-select mb-3" aria-label="Default select example" name="status">
                                        <option value="active"
                                            {{ old('status', $campus->status) == 'active' ? 'selected' : '' }}>Active
                                        </option>
                                        <option value="inactive"
                                            {{ old('status', $campus->status) == 'inactive' ? 'selected' : '' }}>Inactive
                                        </option>
                                    </select>
                                </div>
                            </div>


                            <!--end col-->

                            <div class="col-xxl-12">
                                <div>
                                    <label for="description" class="form-label">Description</label>
                                    <textarea class="form-control" id="description" name="description" rows="3">{{ old('description', $campus->description) }}</textarea>
                                </div>
                            </div>
                            <!--end col-->

                        </div>
                        <!--end row-->

                        <div class="mt-4">
                            <button type="submit" class="btn btn-primary">Update</button>
                            <a href="{{ route('campus.index') }}" class="btn btn-secondary">Cancel</a>
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
