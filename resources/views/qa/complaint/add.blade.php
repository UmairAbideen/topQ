@extends('qa.layout.app')

@section('title')
    Product Complaint
@endsection

@section('page-name')
    Product Complaint
@endsection

@section('active-link-complaint')
    active bg-gradient-primary
@endsection

@section('main-content')
    <div class="container-fluid py-2">
        <div class="row">
            <div class="col-12">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 my-0 z-index-2">
                        <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                            <h6 class="text-white text-capitalize ps-3">Add Complaint</h6>
                        </div>

                        <div class="d-flex justify-content-end pe-0 pt-4">
                            <a href="{{ route('qa.complaint.view') }}" class="btn bg-gradient-info" role="button"
                                aria-pressed="true">Go
                                Back</a>
                        </div>

                        <form class='px-3' action="{{ route('qa.complaint.create') }}" method="post">
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
                                <div class="col-md-12 px-3 pb-4 small">
                                    <b>Note: For a field that needs to be empty, wirte N/A.</b>
                                </div>

                                <div class="col-md-6 px-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label>Receipt Date</label>
                                        <input type="date" name="receipt_date" class="form-control"
                                            value="{{ old('receipt_date') }}">
                                        @error('receipt_date')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 px-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label>Customer Name</label>
                                        <input type="text" name="customer_name" class="form-control"
                                            value="{{ old('customer_name') }}">
                                        @error('customer_name')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 px-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label>Complaint Detail</label>
                                        <input type="text" name="detail" class="form-control"
                                            value="{{ old('detail') }}">
                                        @error('detail')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 px-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label class="ms-0">Complaint Category</label>
                                        <select class="form-control" name="category">
                                            <option selected disabled>--- Select Category ---</option>
                                            <option value="proComp" {{ old('category') == 'proComp' ? 'selected' : '' }}>
                                                Product Complaint</option>
                                            <option value="techComp" {{ old('category') == 'techComp' ? 'selected' : '' }}>
                                                Technical Complaint</option>
                                        </select>
                                        @error('category')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 px-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label>Product Name</label>
                                        <input type="text" name="product_name" class="form-control"
                                            value="{{ old('product_name') }}">
                                        @error('product_name')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 px-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label>Batch Number</label>
                                        <input type="text" name="batch" class="form-control"
                                            value="{{ old('batch') }}">
                                        @error('batch')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 px-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label>Serial Number</label>
                                        <input type="text" name="serial" class="form-control"
                                            value="{{ old('serial') }}">
                                        @error('serial')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 px-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label>Expiry</label>
                                        <input type="date" name="expiry" class="form-control"
                                            value="{{ old('expiry') }}">
                                        @error('expiry')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 px-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label>Quantity</label>
                                        <input type="text" name="quantity" class="form-control"
                                            value="{{ old('quantity') }}">
                                        @error('quantity')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 px-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label>CAPA Initiation Date</label>
                                        <input type="date" name="capa_init" class="form-control"
                                            value="{{ old('capa_init') }}">
                                        @error('capa_init')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 px-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label>CAPA Number</label>
                                        <input type="text" name="capa_no" class="form-control"
                                            value="{{ old('capa_no') }}">
                                        @error('capa_no')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 px-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label>CAPA Status</label>
                                        <input type="text" name="status" class="form-control"
                                            value="{{ old('status') }}">
                                        @error('status')
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
