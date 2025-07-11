@extends('qa.layout.app')

@section('title')
    Training Management
@endsection

@section('page-name')
    Training Management
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
                            <h6 class="text-white text-capitalize ps-3">Create Attendance Sheet </h6>
                        </div>

                        <div class="d-flex justify-content-end pe-0 pt-4">
                            <a href="{{ route('qa.training.attendance.view') }}" class="btn bg-gradient-info" role="button"
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

                        <form class='px-3' action="{{ route('qa.training.attendance.create') }}" method="post">
                            @csrf

                            <div class="row">

                                <p class="ps-3 pt-5 pb-2"><b>Training Information</b></p>

                                <div class="col-md-6 px-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label>Training Name</label>
                                        <textarea name="training_name" class="form-control" cols="1" rows="1">{{ old('training_name') }}</textarea>
                                        @error('training_name')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-3 px-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label>Location</label>
                                        <input type="text" name="location" class="form-control"
                                            value="{{ old('location') }}">
                                        @error('location')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-3 px-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label>Date</label>
                                        <input type="date" name="date" class="form-control"
                                            value="{{ old('date') }}">
                                        @error('date')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-3 px-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label>From</label>
                                        <input type="time" name="from" class="form-control"
                                            value="{{ old('from') }}">
                                        @error('from')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-3 px-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label>To</label>
                                        <input type="time" name="to" class="form-control"
                                            value="{{ old('to') }}">
                                        @error('to')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-3 px-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label>Trainee Department(s)</label>
                                        <select name="department" class="form-control ps-2">
                                            <option value="" disabled selected>--- Select Department ---</option>
                                            <option value="Technical Service"
                                                {{ old('department') == 'Technical Service' ? 'selected' : '' }}>Technical
                                                Service</option>
                                            <option value="Supply Chain"
                                                {{ old('department') == 'Supply Chain' ? 'selected' : '' }}>Supply Chain
                                            </option>
                                            <option value="Instrumentation"
                                                {{ old('department') == 'Instrumentation' ? 'selected' : '' }}>
                                                Instrumentation</option>
                                            <option value="Dry Eye" {{ old('department') == 'Dry Eye' ? 'selected' : '' }}>
                                                Dry Eye</option>
                                            <option value="IOLs" {{ old('department') == 'IOLs' ? 'selected' : '' }}>IOLs
                                            </option>
                                            <option value="Head Office"
                                                {{ old('department') == 'Head Office' ? 'selected' : '' }}>Head Office
                                            </option>
                                        </select>
                                        @error('department')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>


                                <p class="ps-3 pt-5 pb-2"><b>Attendees</b></p>

                                @for ($i = 1; $i <= 10; $i++)
                                    {{-- Name Dropdown --}}
                                    <div class="col-md-3 px-3">
                                        <div class="input-group input-group-static mb-4">
                                            <label>Name - {{ $i }}</label>
                                            <select class="form-control" name="name{{ $i }}">
                                                <option value="" selected>--- Select Name ---</option>
                                                @foreach ($users as $user)
                                                    <option value="{{ $user->username }}"
                                                        {{ old("name$i") == $user->username ? 'selected' : '' }}>
                                                        {{ $user->username }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error("name$i")
                                                <div class="text-danger small">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    {{-- Absence Dropdown --}}
                                    <div class="col-md-3 px-3">
                                        <div class="input-group input-group-static mb-4">
                                            <label>Absence - {{ $i }}</label>
                                            <select class="ps-1 form-control" name="absence{{ $i }}">
                                                <option value="" selected>--- Select Absence ---</option>
                                                <option value="no" {{ old("absence$i") == 'no' ? 'selected' : '' }}>No
                                                </option>
                                                <option value="yes" {{ old("absence$i") == 'yes' ? 'selected' : '' }}>
                                                    Yes</option>
                                            </select>
                                            @error("absence$i")
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
