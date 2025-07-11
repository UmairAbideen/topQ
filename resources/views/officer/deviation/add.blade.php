@extends('officer.layout.app')

@section('title')
    Deviation Management
@endsection

@section('page-name')
    Deviation Management
@endsection

@section('active-link-dm')
    active bg-gradient-primary
@endsection

@section('main-content')
    <div class="container-fluid py-2">
        <div class="row">
            <div class="col-12">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 my-0 z-index-2">
                        <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                            <h6 class="text-white text-capitalize ps-3">Add New Deviation</h6>
                        </div>

                        <div class="d-flex justify-content-end pe-0 pt-4">
                            <a href="{{ route('officer.deviation.view') }}" class="btn bg-gradient-info" role="button"
                                aria-pressed="true">Go
                                Back</a>
                        </div>

                        <form class='px-3' action="{{ route('officer.deviation.create') }}" method="post">
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
                                <p class="ps-3 pt-5 pb-2"><b>Initial Assessment</b></p>

                                <div class="col-md-6 px-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label>Subject</label>
                                        <select class="form-control ps-2" name="subject">
                                            <option selected disabled>--- Select option ---</option>
                                            <option value="product">Product</option>
                                            <option value="service">Service</option>
                                            <option value="process">Process</option>
                                        </select>
                                        @error('subject')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 px-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label>Deviation Status</label>
                                        <select class="form-control ps-2" name="status">
                                            <option selected disabled>--- Select option ---</option>
                                            <option value="planned deviation">Planned Deviation</option>
                                            <option value="un-planned deviation">Unplanned Deviation</option>
                                        </select>
                                        @error('status')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 px-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label>Detail</label>
                                        <input type="text" name="detail" class="form-control">
                                        @error('detail')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 px-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label>Deviation Statement</label>
                                        <input type="text" name="statement" class="form-control">
                                        @error('statement')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 px-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label>Immediate Action(s)</label>
                                        <textarea name="action" class="form-control" cols="1" rows="1"></textarea>
                                        @error('action')
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
