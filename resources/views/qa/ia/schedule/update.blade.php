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
                            <h6 class="text-white text-capitalize ps-3">Update Schedule</h6>
                        </div>

                        <div class="d-flex justify-content-end pe-0 pt-4">
                            <a href="{{ route('qa.ia.schedule.view') }}" class="btn btn-info" role="button"
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

                        <form class='px-3' action="{{ route('qa.ia.schedule.update', $schedule->id) }}" method="post">
                            @csrf

                            <div class="row">
                                <!-- Internal Auditor Fields -->
                                <div class="col-md-6 px-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label>Internal Auditor #1</label>
                                        <input type="text" name="internal_auditor1" class="form-control"
                                            value="{{ old('internal_auditor1', $schedule->internal_auditor1) }}">
                                        @error('internal_auditor1')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 px-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label>Internal Auditor #2</label>
                                        <input type="text" name="internal_auditor2" class="form-control"
                                            value="{{ old('internal_auditor2', $schedule->internal_auditor2) }}">
                                        @error('internal_auditor2')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 px-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label>Document Date</label>
                                        <input type="date" name="doc_date" class="form-control"
                                            value="{{ old('doc_date', $schedule->doc_date) }}">
                                        @error('doc_date')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Loop for Department #1, #2, and #3 -->
                                @for ($i = 1; $i <= 3; $i++)
                                    <div class="col-md-6 px-3">
                                        <div class="input-group input-group-static mb-4">
                                            <label>Department #{{ $i }}</label>
                                            <input type="text" name="department{{ $i }}" class="form-control"
                                                value="{{ old('department' . $i, $schedule->{'department' . $i}) }}">
                                            @error('department' . $i)
                                                <div class="text-danger small">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6 px-3">
                                        <div class="input-group input-group-static mb-4">
                                            <label>Date of Audit</label>
                                            <input type="date" name="date_dep{{ $i }}" class="form-control"
                                                value="{{ old('date_dep' . $i, $schedule->{'date_dep' . $i}) }}">
                                            @error('date_dep' . $i)
                                                <div class="text-danger small">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6 px-3">
                                        <div class="input-group input-group-static mb-4">
                                            <label>Time</label>
                                            <input type="text" name="time{{ $i }}"
                                                placeholder="00:00am - 00:00pm" class="form-control"
                                                value="{{ old('time' . $i, $schedule->{'time' . $i}) }}">
                                            @error('time' . $i)
                                                <div class="text-danger small">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6 px-3">
                                        <div class="input-group input-group-static mb-4">
                                            <label>Area of Audit</label>
                                            <input type="text" name="area{{ $i }}" class="form-control"
                                                value="{{ old('area' . $i, $schedule->{'area' . $i}) }}">
                                            @error('area' . $i)
                                                <div class="text-danger small">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Loop for Auditees -->
                                    @for ($j = 'a'; $j <= 'c' ; $j++) <div class="col-md-6 px-3">
                                        <div class="input-group input-group-static mb-4">
                                            <label>Name of Auditee #{{ $j }}</label>
                                            <input type="text" name="auditee{{ $i . $j }}" class="form-control"
                                                value="{{ old('auditee' . $i . $j, $schedule->{'auditee' . $i . $j}) }}">
                                            @error('auditee' . $i . $j)
                                                <div class="text-danger small">{{ $message }}</div>
                                            @enderror
                                        </div>
                            </div>
                            @endfor
                            @endfor

                            <!-- Submit Button -->
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
