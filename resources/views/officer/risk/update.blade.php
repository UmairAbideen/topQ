@extends('officer.layout.app')

@section('title')
    Risk Assessment
@endsection

@section('page-name')
    Risk Assessment
@endsection

@section('active-link-risk')
    active bg-gradient-primary
@endsection

@section('main-content')
    <div class="container-fluid py-2">
        <div class="row">
            <div class="col-12">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 my-0 z-index-2">
                        <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                            <h6 class="text-white text-capitalize ps-3">Update Risk Assessment</h6>
                        </div>

                        <div class="d-flex justify-content-end pe-0 pt-4">
                            <a href="{{ route('officer.risk.view') }}" class="btn bg-gradient-info" role="button"
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

                        <form class='px-3' action="{{ route('officer.risk.update', $risk->id) }}" method="post">
                            @csrf

                            <div class="row">

                                <p class="ps-3 pt-5 pb-2"><b>Initial Information</b></p>

                                <div class="col-md-6 px-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label>Area</label>
                                        <input type="text" name="area" class="form-control"
                                            value="{{ $risk->area }}">
                                        @error('area')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 px-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label>Description</label>
                                        <input type="text" name="description" class="form-control"
                                            value="{{ $risk->description }}">
                                        @error('description')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 px-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label>Existing Controls</label>
                                        <textarea name="existing_controls" rows="1" cols="50" class="form-control">{{ $risk->existing_controls }}</textarea>
                                        @error('existing_controls')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                {{-- <div class="col-md-6 px-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label>Risk Coordinator</label>
                                        <input type="text" name="coordinator" class="form-control"
                                            value="{{ $risk->coordinator }}">
                                        @error('coordinator')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div> --}}

                                <p class="ps-3 pt-5 pb-2"><b>Risk Assessment</b> (before mitigation)</p>

                                <!-- Severity Before Dropdown -->
                                <div class="col-md-3 px-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label>Severity (before)</label>
                                        <select name="severity_before" class="form-control ps-2">
                                            <option value="" disabled selected>--- Select Severity ---</option>
                                            @for ($i = 1; $i <= 5; $i++)
                                                <option value="{{ $i }}"
                                                    {{ old('severity_before', $risk->severity_before) == $i ? 'selected' : '' }}>
                                                    {{ $i }}
                                                </option>
                                            @endfor
                                        </select>
                                        @error('severity_before')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Probability Before Dropdown -->
                                <div class="col-md-3 px-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label>Probability (before)</label>
                                        <select name="probablity_before" class="form-control ps-2">
                                            <option value="" disabled selected>--- Select Probability ---</option>
                                            @for ($i = 1; $i <= 5; $i++)
                                                <option value="{{ $i }}"
                                                    {{ old('probablity_before', $risk->probablity_before) == $i ? 'selected' : '' }}>
                                                    {{ $i }}
                                                </option>
                                            @endfor
                                        </select>
                                        @error('probablity_before')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Detectability Before Dropdown -->
                                <div class="col-md-3 px-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label>Detectability (before)</label>
                                        <select name="detectability_before" class="form-control ps-2">
                                            <option value="" disabled selected>--- Select Detectability ---</option>
                                            @for ($i = 1; $i <= 3; $i++)
                                                <option value="{{ $i }}"
                                                    {{ old('detectability_before', $risk->detectability_before) == $i ? 'selected' : '' }}>
                                                    {{ $i }}
                                                </option>
                                            @endfor
                                        </select>
                                        @error('detectability_before')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>


                                <p class="ps-3 pt-5 pb-2"><b>Mitigation Plan</b></p>

                                @for ($i = 1; $i <= 5; $i++)
                                    <div class="col-md-6 px-3">
                                        <div class="input-group input-group-static mb-4">
                                            <label>Action # {{ $i }}</label>
                                            <textarea name="action{{ $i }}" rows="1" cols="50" class="form-control">{{ $risk->{'action' . $i} }}</textarea>
                                            @error("action{$i}")
                                                <div class="text-danger small">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-3 px-3">
                                        <div class="input-group input-group-static mb-4">
                                            <label>Responsibility # {{ $i }}</label>
                                            <textarea name="responsibility{{ $i }}" rows="1" cols="50" class="form-control">{{ $risk->{'responsibility' . $i} }}</textarea>
                                            @error("responsibility{$i}")
                                                <div class="text-danger small">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-3 px-3">
                                        <div class="input-group input-group-static mb-4">
                                            <label>Completion Date # {{ $i }}</label>
                                            <input type="date" name="completion_date{{ $i }}"
                                                class="form-control"
                                                value="{{ old('completion_date' . $i, $risk->{'completion_date' . $i}) }}">
                                            @error("completion_date{$i}")
                                                <div class="text-danger small">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                @endfor

                                <p class="ps-3 pt-5 pb-2"><b>Risk Assessment</b> (after mitigation)</p>

                                <!-- Severity After Dropdown -->
                                <div class="col-md-3 px-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label>Severity (after)</label>
                                        <select name="severity_after" class="form-control ps-2">
                                            <option value="" disabled selected>--- Select Severity ---</option>
                                            @for ($i = 1; $i <= 5; $i++)
                                                <option value="{{ $i }}"
                                                    {{ old('severity_after', $risk->severity_after) == $i ? 'selected' : '' }}>
                                                    {{ $i }}
                                                </option>
                                            @endfor
                                        </select>
                                        @error('severity_after')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Probability After Dropdown -->
                                <div class="col-md-3 px-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label>Probability (after)</label>
                                        <select name="probablity_after" class="form-control ps-2">
                                            <option value="" disabled selected>--- Select Probability ---</option>
                                            @for ($i = 1; $i <= 5; $i++)
                                                <option value="{{ $i }}"
                                                    {{ old('probablity_after', $risk->probablity_after) == $i ? 'selected' : '' }}>
                                                    {{ $i }}
                                                </option>
                                            @endfor
                                        </select>
                                        @error('probablity_after')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Detectability After Dropdown -->
                                <div class="col-md-3 px-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label>Detectability (after)</label>
                                        <select name="detectability_after" class="form-control ps-2">
                                            <option value="" disabled selected>--- Select Detectability ---</option>
                                            @for ($i = 1; $i <= 3; $i++)
                                                <option value="{{ $i }}"
                                                    {{ old('detectability_after', $risk->detectability_after) == $i ? 'selected' : '' }}>
                                                    {{ $i }}
                                                </option>
                                            @endfor
                                        </select>
                                        @error('detectability_after')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
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
