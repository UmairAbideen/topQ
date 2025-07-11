@extends('qa.layout.app')

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
                            <a href="{{ route('qa.risk.view') }}" class="btn bg-gradient-info" role="button"
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

                        <form class='px-3' action="{{ route('qa.risk.update', $risk->id) }}" method="post">
                            @csrf

                            <div class="row">

                                <p class="ps-3 pt-5 pb-2"><b>Initial Information</b></p>

                                {{-- <div class="col-md-3 px-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label>QRE Number</label>
                                        <input type="text" name="qre_no" class="form-control"
                                            value="{{ $risk->qre_no }}">
                                        @error('qre_no')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div> --}}
                                <div class="col-md-3 px-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label>Date of Identification</label>
                                        <input type="date" name="receipt_date" class="form-control"
                                            value="{{ $risk->receipt_date }}">
                                        @error('receipt_date')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3 px-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label class="ms-0">Department</label>
                                        <select class="form-control" name="department">
                                            @if ($risk->department == 'TS')
                                                <option value="TS" selected>Technical Service</option>
                                                <option value="INS">Instrumentation</option>
                                                <option value="DE">Dry Eye</option>
                                                <option value="SC">Supply Chain</option>
                                                <option value="IOL">IOL</option>
                                                <option value="QA">Quality Assurance</option>
                                            @elseif ($risk->department == 'INS')
                                                <option value="TS">Technical Service</option>
                                                <option value="INS" selected>Instrumentation</option>
                                                <option value="DE">Dry Eye</option>
                                                <option value="SC">Supply Chain</option>
                                                <option value="IOL">IOL</option>
                                                <option value="QA">Quality Assurance</option>
                                            @elseif ($risk->department == 'DE')
                                                <option value="TS">Technical Service</option>
                                                <option value="INS">Instrumentation</option>
                                                <option value="DE" selected>Dry Eye</option>
                                                <option value="SC">Supply Chain</option>
                                                <option value="IOL">IOL</option>
                                                <option value="QA">Quality Assurance</option>
                                            @elseif ($risk->department == 'SC')
                                                <option value="TS">Technical Service</option>
                                                <option value="INS">Instrumentation</option>
                                                <option value="DE">Dry Eye</option>
                                                <option value="SC" selected>Supply Chain</option>
                                                <option value="IOL">IOL</option>
                                                <option value="QA">Quality Assurance</option>
                                            @elseif ($risk->department == 'IOL')
                                                <option value="TS">Technical Service</option>
                                                <option value="INS">Instrumentation</option>
                                                <option value="DE">Dry Eye</option>
                                                <option value="SC">Supply Chain</option>
                                                <option value="IOL" selected>IOL</option>
                                                <option value="QA">Quality Assurance</option>
                                            @elseif ($risk->department == 'QA')
                                                <option value="TS">Technical Service</option>
                                                <option value="INS">Instrumentation</option>
                                                <option value="DE">Dry Eye</option>
                                                <option value="SC">Supply Chain</option>
                                                <option value="IOL">IOL</option>
                                                <option value="QA" selected>Quality Assurance</option>
                                            @endif
                                        </select>
                                        @error('department')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3 px-3">
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
                                <div class="col-md-3 px-3">
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
                                {{-- <div class="col-md-3 px-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label>Risk Priority Number (RPN)</label>
                                        <input type="text" name="rpn_before" class="form-control"
                                            value="{{ $risk->rpn_before }}">
                                        @error('rpn_before')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div> --}}
                                {{-- <div class="col-md-3 px-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label class="ms-0">Risk Criticality - Before</label>
                                        <select class="form-control" name="criticality_before">
                                            @if ($risk->criticality_before == 'Low')
                                                <option value="Low" selected>Low</option>
                                                <option value="Medium">Medium</option>
                                                <option value="High">High</option>
                                            @elseif($risk->criticality_before == 'Medium')
                                                <option value="Low">Low</option>
                                                <option value="Medium" selected>Medium</option>
                                                <option value="High">High</option>
                                            @elseif($risk->criticality_before == 'High')
                                                <option value="Low">Low</option>
                                                <option value="Medium">Medium</option>
                                                <option value="High" selected>High</option>
                                            @endif
                                        </select>
                                        @error('criticality_before')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div> --}}

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
                                {{-- <div class="col-md-3 px-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label>Risk Priority Number (RPN)</label>
                                        <input type="text" name="rpn_after" class="form-control"
                                            value="{{ $risk->rpn_after }}">
                                        @error('rpn_after')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-3 px-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label class="ms-0">Risk Criticality - After</label>
                                        <select class="form-control" name="criticality_after">
                                            @if ($risk->criticality_after == 'Low')
                                                <option value="Low" selected>Low</option>
                                                <option value="Medium">Medium</option>
                                                <option value="High">High</option>
                                            @elseif($risk->criticality_after == 'Medium')
                                                <option value="Low">Low</option>
                                                <option value="Medium" selected>Medium</option>
                                                <option value="High">High</option>
                                            @elseif($risk->criticality_after == 'High')
                                                <option value="Low">Low</option>
                                                <option value="Medium">Medium</option>
                                                <option value="High" selected>High</option>
                                            @endif
                                        </select>
                                        @error('criticality_after')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div> --}}

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
