@extends('qa.layout.app')

@section('title')
    Document Control
@endsection

@section('page-name')
    Document Control
@endsection

@section('active-link-doc')
    active bg-gradient-primary
@endsection

@section('main-content')
    <div class="container-fluid py-2">
        <div class="row">
            <div class="col-12">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 my-0 z-index-2">
                        <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                            <h6 class="text-white text-capitalize ps-3">Add Document Change Request </h6>
                        </div>

                        <div class="d-flex justify-content-end pe-0 pt-4">
                            <a href="{{ route('qa.doc-control.change.view') }}" class="btn bg-gradient-info" role="button"
                                aria-pressed="true">Go
                                Back</a>
                        </div>

                        <form class='px-3' action="{{route('qa.doc-control.change.create')}}" method="post">
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

                                <p class="ps-3 pb-2"><b>General Information</b></p>

                                <div class="col-md-6 px-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label>Document No</label>
                                        <input type="text" name="doc_no" class="form-control"
                                            value="{{ old('doc_no') }}">
                                        @error('doc_no')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 px-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label>Document Name</label>
                                        <input type="text" name="doc_name" class="form-control"
                                            value="{{ old('doc_name') }}">
                                        @error('doc_name')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <p class="ps-3 pt-5 pb-2"><b>Change Details</b></p>


                                @for ($i = 1; $i <= 5; $i++)
                                    <div class="col-md-6 px-3">
                                        <div class="input-group input-group-static mb-4">
                                            <label>Change {{ $i }}</label>
                                            <input type="text" name="change{{ $i }}" class="form-control"
                                                value="{{ old('change' . $i) }}">
                                            @error('change' . $i)
                                                <div class="text-danger small">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6 px-3">
                                        <div class="input-group input-group-static mb-4">
                                            <label>Reason {{ $i }}</label>
                                            <input type="text" name="reason{{ $i }}" class="form-control"
                                                value="{{ old('reason' . $i) }}">
                                            @error('reason' . $i)
                                                <div class="text-danger small">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                @endfor

                                <p class="ps-3 pt-5 pb-2"></p>

                                <div class="col-md-6 px-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label>Impact (If required)</label>
                                        <input type="text" name="impact" class="form-control"
                                            value="{{ old('impact') }}">
                                        @error('impact')
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

