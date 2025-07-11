@extends('manager.layout.app')

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
                            <a href="{{ route('manager.risk.view') }}" class="btn bg-gradient-info" role="button"
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

                        <form class='px-3' action="{{ route('manager.risk.update', $risk->id) }}" method="post">
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
                                <div class="col-md-6 px-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label>Risk Coordinator</label>
                                        <input type="text" name="coordinator" class="form-control"
                                            value="{{ $risk->coordinator }}">
                                        @error('coordinator')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <p class="ps-3 pt-5 pb-2"><b>Risk Assessment</b> (before mitigation)</p>

                                <div class="col-md-3 px-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label>Severity</label>
                                        <input type="text" name="severity_before" class="form-control"
                                            value="{{ $risk->severity_before }}">
                                        @error('severity_before')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3 px-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label>Probablity</label>
                                        <input type="text" name="probablity_before" class="form-control"
                                            value="{{ $risk->probablity_before }}">
                                        @error('probablity_before')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3 px-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label>Detectability</label>
                                        <input type="text" name="detectability_before" class="form-control"
                                            value="{{ $risk->detectability_before }}">
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

                                <div class="col-md-3 px-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label>Severity</label>
                                        <input type="text" name="severity_after" class="form-control"
                                            value="{{ $risk->severity_after }}">
                                        @error('severity_after')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3 px-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label>Probablity</label>
                                        <input type="text" name="probablity_after" class="form-control"
                                            value="{{ $risk->probablity_after }}">
                                        @error('probablity_after')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3 px-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label>Detectability</label>
                                        <input type="text" name="detectability_after" class="form-control"
                                            value="{{ $risk->detectability_after }}">
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
