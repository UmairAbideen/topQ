@extends('qa.layout.app')

@section('title')
    Management Review Attendance
@endsection

@section('page-name')
    Management Review Meeting
@endsection

@section('active-link-mrm')
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
                            <a href="{{ route('qa.mrm.attendance.view', $agenda->id) }}" class="btn bg-gradient-info"
                                role="button" aria-pressed="true">Go
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

                        <form class='px-3' action="{{ route('qa.mrm.attendance.create') }}" method="post">
                            @csrf

                            <div class="row">
                                @php
                                    // Arrays containing the names and departments options
                                    $names = [
                                        'Khalid Mahmood Khan',
                                        'Ayub Ismail',
                                        'Hassan Khatri',
                                        'Muhammad Faisal',
                                        'Akhtar Safi',
                                        'Faisal Khan',
                                        'Babar Khan',
                                        'Zain Nasir',
                                    ];
                                    $departments = [
                                        'N/A',
                                        'HR & Admin',
                                        'Finance',
                                        'Business Analysis',
                                        'Technical Service',
                                        'Dry Eye',
                                        'Instrumentation',
                                        'Supply Chain',
                                    ];
                                @endphp

                                @for ($i = 1; $i <= 8; $i++)
                                    {{-- Name Dropdown --}}
                                    <div class="col-md-5 px-3">
                                        <div class="input-group input-group-static mb-4">
                                            <label>Name - {{ $i }}</label>
                                            <select class="form-control" name="name{{ $i }}">
                                                <option selected disabled>--- Select Name ---</option>
                                                @foreach ($names as $name)
                                                    <option value="{{ $name }}"
                                                        {{ old('name' . $i) == $name ? 'selected' : '' }}>
                                                        {{ $name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('name' . $i)
                                                <div class="text-danger small">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    {{-- Department Dropdown --}}
                                    <div class="col-md-5 px-3">
                                        <div class="input-group input-group-static mb-4">
                                            <label>Department - {{ $i }}</label>
                                            <select class="form-control" name="department{{ $i }}">
                                                <option selected disabled>--- Select Department ---</option>
                                                @foreach ($departments as $department)
                                                    <option value="{{ $department }}"
                                                        {{ old('department' . $i) == $department ? 'selected' : '' }}>
                                                        {{ $department }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('department' . $i)
                                                <div class="text-danger small">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    {{-- Absence Dropdown --}}
                                    <div class="col-md-2 px-3">
                                        <div class="input-group input-group-static mb-4">
                                            <label>Absence - {{ $i }}</label>
                                            <select class="form-control" name="absence{{ $i }}">
                                                <option selected disabled>--- Select Absence ---</option>
                                                <option value="yes"
                                                    {{ old('absence' . $i) == 'yes' ? 'selected' : '' }}>Yes</option>
                                                <option value="no" {{ old('absence' . $i) == 'no' ? 'selected' : '' }}>
                                                    No</option>
                                            </select>
                                            @error('absence' . $i)
                                                <div class="text-danger small">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                @endfor

                                <!-- Hidden Field-->
                                <div class="col-md-6 px-3">
                                    <input type="hidden" name="agenda_id" value="{{ $agenda->id }}">
                                </div>

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
