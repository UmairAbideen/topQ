@extends('manager.layout.app')

@section('title')
    New Employee Training Plan
@endsection

@section('page-name')
    New Employee Training Plan
@endsection

@section('active-link-training')
    active bg-gradient-primary
@endsection

@section('main-content')
    <div class="container-fluid py-2">
        <div class="row">
            <div class="col-12">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 my-0 z-index-2">
                        <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                            <h6 class="text-white text-capitalize ps-3">Create New Employee Training Plan </h6>
                        </div>

                        <div class="d-flex justify-content-end pe-0 pt-4">
                            <a href="{{ route('manager.training.new-employee.view') }}" class="btn bg-gradient-info" role="button"
                                aria-pressed="true">Go
                                Back</a>
                        </div>

                        @if (session('status'))
                            <div class="alert alert-success alert-dismissible text-white fade show" role="alert">
                                <small>{{ session('status') }}</small>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif

                        @if (session('error'))
                            <div class="alert alert-secondary alert-dismissible text-white fade show" role="alert">
                                <small>{{ session('error') }}</small>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif

                        <form class='px-3' action="{{ route('manager.training.new-employee.create') }}" method="post">
                            @csrf

                            <div class="row">
                                <p class="ps-3 pb-2"><b>Trainee Details</b></p>
                                <!-- Attendee Name -->
                                <div class="col-md-6 px-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label>Attendee Name</label>
                                        <input type="text" name="attendee_name" class="form-control"
                                            value="{{ old('attendee_name') }}">
                                        @error('attendee_name')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Attendee Department -->
                                <div class="col-md-6 px-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label>Attendee Department</label>
                                        <input type="text" name="attendee_department" class="form-control"
                                            value="{{ old('attendee_department') }}">
                                        @error('attendee_department')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Attendee Designation -->
                                <div class="col-md-6 px-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label>Attendee Designation</label>
                                        <input type="text" name="attendee_designation" class="form-control"
                                            value="{{ old('attendee_designation') }}">
                                        @error('attendee_designation')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Joining Date -->
                                <div class="col-md-6 px-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label>Joining Date</label>
                                        <input type="date" name="joining_date" class="form-control"
                                            value="{{ old('joining_date') }}">
                                        @error('joining_date')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <p class="ps-3 pt-5 pb-2"><b>Training Details</b></p>


                                <!-- Loop for Training Name and Training Date -->
                                @for ($i = 1; $i <= 20; $i++)
                                    <!-- Training Name -->
                                    <div class="col-md-4 px-3">
                                        <div class="input-group input-group-static mb-4">
                                            <label>Training Name {{ $i }}</label>
                                            <input type="text" name="training_name{{ $i }}"
                                                class="form-control" value="{{ old('training_name' . $i) }}">
                                            @error('training_name' . $i)
                                                <div class="text-danger small">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Training Date -->
                                    <div class="col-md-2 px-3">
                                        <div class="input-group input-group-static mb-4">
                                            <label>Training Date {{ $i }}</label>
                                            <input type="date" name="training_date{{ $i }}"
                                                class="form-control" value="{{ old('training_date' . $i) }}">
                                            @error('training_date' . $i)
                                                <div class="text-danger small">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                @endfor


                                <div class="mt-3">
                                    <button type="submit" class="btn bg-gradient-success">Submit</button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
