@extends('qa.layout.app')

@section('title')
    Recall Closure
@endsection

@section('page-name')
    Recall Closure
@endsection

@section('active-link-recall')
    active bg-gradient-primary
@endsection

@section('main-content')
    <div class="container-fluid py-2">
        <div class="row">
            <div class="col-12">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 my-0 z-index-2">
                        <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                            <h6 class="text-white text-capitalize ps-3">Update Recall Report</h6>
                        </div>

                        <div class="d-flex justify-content-end pe-0 pt-4">
                            <a href="{{ route('qa.closure.view') }}" class="btn bg-gradient-info" role="button"
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

                        <form class='px-3' action="{{ route('qa.closure.update', $closure->id) }}" method="post">
                            @csrf

                            <div class="row">
                                <div class="col-md-6 px-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label>Product Name</label>
                                        <input type="text" name="product" class="form-control"
                                            value="{{ old('product', $closure->product) }}">
                                        @error('product')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 px-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label>Recall Number</label>
                                        <input type="text" name="recall_no" class="form-control"
                                            value="{{ old('recall_no', $closure->recall_no) }}">
                                        @error('recall_no')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 px-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label>Problem Detail</label>
                                        <input type="text" name="problem_detail" class="form-control"
                                            value="{{ old('problem_detail', $closure->problem_detail) }}">
                                        @error('problem_detail')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <p class="ps-3 pt-5 pb-2"><b>Reconciliation of Recalled Product</b></p>

                                <div class="col-md-6 px-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label>Batch Number</label>
                                        <input type="text" name="batch" class="form-control"
                                            value="{{ old('batch', $closure->batch) }}">
                                        @error('batch')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 px-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label>Serial Number</label>
                                        <input type="text" name="serial" class="form-control"
                                            value="{{ old('serial', $closure->serial) }}">
                                        @error('serial')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 px-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label>Expiry Date</label>
                                        <input type="date" name="expiry" class="form-control"
                                            value="{{ old('expiry', $closure->expiry) }}">
                                        @error('expiry')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 px-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label>Manufacturing Date</label>
                                        <input type="date" name="manufacturing_date" class="form-control"
                                            value="{{ old('manufacturing_date', $closure->manufacturing_date) }}">
                                        @error('manufacturing_date')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 px-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label>Commercial Qty. Distributed</label>
                                        <input type="number" name="distributed_c" class="form-control"
                                            value="{{ old('distributed_c', $closure->distributed_c) }}">
                                        @error('distributed_c')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 px-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label>Commercial Qty. Recovered</label>
                                        <input type="number" name="recovered_c" class="form-control"
                                            value="{{ old('recovered_c', $closure->recovered_c) }}">
                                        @error('recovered_c')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 px-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label>Commercial - Recovery Rate</label>
                                        <input type="number" name="recovery_c" class="form-control"
                                            value="{{ old('recovery_c', $closure->recovery_c) }}">
                                        @error('recovery_c')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 px-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label>Sample Qty. Distributed</label>
                                        <input type="number" name="distributed_s" class="form-control"
                                            value="{{ old('distributed_s', $closure->distributed_s) }}">
                                        @error('distributed_s')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 px-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label>Sample Qty. Recovered</label>
                                        <input type="number" name="recovered_s" class="form-control"
                                            value="{{ old('recovered_s', $closure->recovered_s) }}">
                                        @error('recovered_s')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 px-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label>Sample - Recovery Rate</label>
                                        <input type="number" name="recovery_s" class="form-control"
                                            value="{{ old('recovery_s', $closure->recovery_s) }}">
                                        @error('recovery_s')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <hr><hr><hr>

                                <div class="col-md-6 px-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label>Remarks</label>
                                        <input type="text" name="remarks" class="form-control"
                                            value="{{ old('remarks', $closure->remarks) }}">
                                        @error('remarks')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 px-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label>Decision</label>
                                        <input type="text" name="decision" class="form-control"
                                            value="{{ old('decision', $closure->decision) }}">
                                        @error('decision')
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
