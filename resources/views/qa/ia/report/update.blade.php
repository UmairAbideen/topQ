@extends('qa.layout.app')

@section('title')
    Internal Audit
@endsection

@section('page-name')
    Internal Audit
@endsection

@section('active-link-ia')
    active bg-gradient-primary
@endsection

@section('main-content')
    <div class="container-fluid py-2">
        <div class="row">
            <div class="col-12">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 my-0 z-index-2">
                        <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                            <h6 class="text-white text-capitalize ps-3">Update Report</h6>
                        </div>

                        <div class="d-flex justify-content-end pe-0 pt-4">
                            <a href="{{ route('qa.ia.report.view') }}" class="btn btn-info" role="button"
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

                        <form class='px-3' action="{{ route('qa.ia.report.update', $report->id) }}" method="post">
                            @csrf

                            <div class="row">
                                <div class="col-md-6 px-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label>Report Number</label>
                                        <input type="text" name="report_no" class="form-control"
                                            value="{{ old('report_no', $report->report_no) }}">
                                        @error('report_no')
                                            <span class="text-danger small">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 px-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label>Document Date</label>
                                        <input type="date" name="doc_date" class="form-control"
                                            value="{{ old('doc_date', $report->doc_date) }}">
                                        @error('doc_date')
                                            <span class="text-danger small">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 px-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label>Internal Auditor # 1</label>
                                        <input type="text" name="internal_auditor1" class="form-control"
                                            value="{{ old('internal_auditor1', $report->internal_auditor1) }}">
                                        @error('internal_auditor1')
                                            <span class="text-danger small">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 px-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label>Internal Auditor # 2</label>
                                        <input type="text" name="internal_auditor2" class="form-control"
                                            value="{{ old('internal_auditor2', $report->internal_auditor2) }}">
                                        @error('internal_auditor2')
                                            <span class="text-danger small">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Loop for Departments -->
                                @for ($i = 1; $i <= 3; $i++)
                                    <div class="col-md-6 px-3">
                                        <div class="input-group input-group-static mb-4">
                                            <label>Department # {{ $i }}</label>
                                            <input type="text" name="department{{ $i }}" class="form-control"
                                                value="{{ old('department' . $i, $report->{'department' . $i}) }}">
                                            @error('department' . $i)
                                                <span class="text-danger small">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6 px-3">
                                        <div class="input-group input-group-static mb-4">
                                            <label>Date of Audit</label>
                                            <input type="date" name="date_dep{{ $i }}" class="form-control"
                                                value="{{ old('date_dep' . $i, $report->{'date_dep' . $i}) }}">
                                            @error('date_dep' . $i)
                                                <span class="text-danger small">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6 px-3">
                                        <div class="input-group input-group-static mb-4">
                                            <label>Area of Audit</label>
                                            <input type="text" name="area{{ $i }}" class="form-control"
                                                value="{{ old('area' . $i, $report->{'area' . $i}) }}">
                                            @error('area' . $i)
                                                <span class="text-danger small">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6 px-3">
                                        <div class="input-group input-group-static mb-4">
                                            <label>Scope</label>
                                            <input type="text" name="scope{{ $i }}" class="form-control"
                                                value="{{ old('scope' . $i, $report->{'scope' . $i}) }}">
                                            @error('scope' . $i)
                                                <span class="text-danger small">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                @endfor

                                <div class="col-md-6 px-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label>Summary</label>
                                        <input type="text" name="summary" class="form-control"
                                            value="{{ old('summary', $report->summary) }}">
                                        @error('summary')
                                            <span class="text-danger small">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 px-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label>Deviation Number</label>
                                        <input type="text" name="deviation_no" class="form-control"
                                            value="{{ old('deviation_no', $report->deviation_no) }}">
                                        @error('deviation_no')
                                            <span class="text-danger small">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="mt-3">
                                    <button type="submit" class="btn btn-success">Submit</button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
