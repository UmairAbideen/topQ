@extends('qa.layout.app')

@section('title')
    Management Review Minutes
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
                            <h6 class="text-white text-capitalize ps-3">Update Management Review Agenda</h6>
                        </div>

                        <div class="d-flex justify-content-end pe-0 pt-4">
                            <a href="{{ route('qa.mrm.minutes.view', $minutes->agenda->id) }}" class="btn bg-gradient-info" role="button"
                                aria-pressed="true">Go
                                Back</a>
                        </div>

                        <form class='px-3' action="{{ route('qa.mrm.minutes.update', $minutes->id) }}" method="post">
                            @csrf

                            @if (session('status'))
                                <div class="alert alert-success alert-dismissible text-white fade show" role="alert">
                                    <small>{{ session('status') }}</small>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif

                            <div class="row">
                                @for ($i = 1; $i <= 10; $i++)
                                    <div class="col-md-6 px-3">
                                        <div class="input-group input-group-static mb-4">
                                            <label>Decision # {{ $i }}</label>
                                            <input type="text" name="decision{{ $i }}" class="form-control"
                                                value="{{ old('decision' . $i, $minutes->{'decision' . $i}) }}">
                                            @error('decision' . $i)
                                                <div class="text-danger small">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6 px-3">
                                        <div class="input-group input-group-static mb-4">
                                            <label>Action # {{ $i }}</label>
                                            <input type="text" name="action{{ $i }}" class="form-control"
                                                value="{{ old('action' . $i, $minutes->{'action' . $i}) }}">
                                            @error('action' . $i)
                                                <div class="text-danger small">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6 px-3">
                                        <div class="input-group input-group-static mb-4">
                                            <label>Responsible Person # {{ $i }}</label>
                                            <input type="text" name="responsible{{ $i }}"
                                                class="form-control"
                                                value="{{ old('responsible' . $i, $minutes->{'responsible' . $i}) }}">
                                            @error('responsible' . $i)
                                                <div class="text-danger small">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6 px-3">
                                        <div class="input-group input-group-static mb-4">
                                            <label>Completion Date # {{ $i }}</label>
                                            <input type="date" name="completion_date{{ $i }}"
                                                class="form-control"
                                                value="{{ old('completion_date' . $i, $minutes->{'completion_date' . $i}) }}">
                                            @error('completion_date' . $i)
                                                <div class="text-danger small">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6 px-3">
                                        <div class="input-group input-group-static mb-4">
                                            <label>Remarks # {{ $i }}</label>
                                            <input type="text" name="remarks{{ $i }}" class="form-control"
                                                value="{{ old('remarks' . $i, $minutes->{'remarks' . $i}) }}">
                                            @error('remarks' . $i)
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
