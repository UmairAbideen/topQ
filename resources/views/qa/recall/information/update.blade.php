@extends('qa.layout.app')

@section('title')
    Product Recall
@endsection

@section('page-name')
    Product Recall
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
                            <h6 class="text-white text-capitalize ps-3">Update Recall Information</h6>
                        </div>

                        <div class="d-flex justify-content-end pe-0 pt-4">
                            <a href="{{ route('qa.recall.view') }}" class="btn bg-gradient-info" role="button"
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

                        <form class='px-3' action="{{ route('qa.recall.update', $recall->id) }}" method="post">
                            @csrf

                            <div class="row">
                                <p class="ps-3 pb-2"><b>Reporter Detail</b></p>

                                <div class="col-md-6 px-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label>Reporter Name</label>
                                        <input type="text" name="reporter_name" class="form-control"
                                            value="{{ old('reporter_name', $recall->reporter_name) }}">
                                        @error('reporter_name')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 px-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label>Organization</label>
                                        <input type="text" name="organization" class="form-control"
                                            value="{{ old('organization', $recall->organization) }}">
                                        @error('organization')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 px-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label>Address</label>
                                        <input type="text" name="address" class="form-control"
                                            value="{{ old('address', $recall->address) }}">
                                        @error('address')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 px-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label>Contact</label>
                                        <input type="text" name="contact" class="form-control"
                                            value="{{ old('contact', $recall->contact) }}">
                                        @error('contact')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 px-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label>Email</label>
                                        <input type="email" name="email" class="form-control"
                                            value="{{ old('email', $recall->email) }}">
                                        @error('email')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 px-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label>Receipt Date</label>
                                        <input type="date" name="receipt_date" class="form-control"
                                            value="{{ old('receipt_date', $recall->receipt_date) }}">
                                        @error('receipt_date')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <p class="ps-3 pt-5 pb-2"><b>Product Detail</b></p>

                                <div class="col-md-6 px-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label>Product Name</label>
                                        <input type="text" name="product_name" class="form-control"
                                            value="{{ old('product_name', $recall->product_name) }}">
                                        @error('product_name')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 px-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label>Registration Number</label>
                                        <input type="text" name="registration_no" class="form-control"
                                            value="{{ old('registration_no', $recall->registration_no) }}">
                                        @error('registration_no')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 px-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label>Batch</label>
                                        <input type="text" name="batch" class="form-control"
                                            value="{{ old('batch', $recall->batch) }}">
                                        @error('batch')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 px-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label>Serial</label>
                                        <input type="text" name="serial" class="form-control"
                                            value="{{ old('serial', $recall->serial) }}">
                                        @error('serial')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 px-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label>Expiry</label>
                                        <input type="date" name="expiry" class="form-control"
                                            value="{{ old('expiry', $recall->expiry) }}">
                                        @error('expiry')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 px-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label>Manufacturing Date</label>
                                        <input type="date" name="manufacturing_date" class="form-control"
                                            value="{{ old('manufacturing_date', $recall->manufacturing_date) }}">
                                        @error('manufacturing_date')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <p class="ps-3 pt-5 pb-2"><b>Distribution Detail</b></p>

                                <div class="col-md-6 px-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label>Initial Product Quantity</label>
                                        <input type="number" name="qty_before" class="form-control"
                                            value="{{ old('qty_before', $recall->qty_before) }}">
                                        @error('qty_before')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 px-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label>Quantity Distributed</label>
                                        <input type="number" name="qty_distributed" class="form-control"
                                            value="{{ old('qty_distributed', $recall->qty_distributed) }}">
                                        @error('qty_distributed')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 px-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label>Customer Name # 1</label>
                                        <input type="text" name="customer_name1" class="form-control"
                                            value="{{ old('customer_name1', $recall->customer_name1) }}">
                                        @error('customer_name1')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 px-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label>Distribution Date # 1</label>
                                        <input type="date" name="distribution_date1" class="form-control"
                                            value="{{ old('distribution_date1', $recall->distribution_date1) }}">
                                        @error('distribution_date1')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 px-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label>Customer Name # 2</label>
                                        <input type="text" name="customer_name2" class="form-control"
                                            value="{{ old('customer_name2', $recall->customer_name2) }}">
                                        @error('customer_name2')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 px-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label>Distribution Date # 2</label>
                                        <input type="date" name="distribution_date2" class="form-control"
                                            value="{{ old('distribution_date2', $recall->distribution_date2) }}">
                                        @error('distribution_date2')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 px-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label>Customer Name # 3</label>
                                        <input type="text" name="customer_name3" class="form-control"
                                            value="{{ old('customer_name3', $recall->customer_name3) }}">
                                        @error('customer_name3')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 px-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label>Distribution Date # 3</label>
                                        <input type="date" name="distribution_date3" class="form-control"
                                            value="{{ old('distribution_date3', $recall->distribution_date3) }}">
                                        @error('distribution_date3')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <p class="ps-3 pt-5 pb-2"><b>Defect Detail</b></p>

                                <div class="col-md-6 px-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label>Source of Problem</label>
                                        <input type="text" name="source" class="form-control"
                                            value="{{ old('source', $recall->source) }}">
                                        @error('source')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 px-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label>Problem Detail</label>
                                        <input type="text" name="problem_detail" class="form-control"
                                            value="{{ old('problem_detail', $recall->problem_detail) }}">
                                        @error('problem_detail')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 px-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label>Number of Complaints Received</label>
                                        <input type="number" name="no_of_complaint" class="form-control"
                                            value="{{ old('no_of_complaint', $recall->no_of_complaint) }}">
                                        @error('no_of_complaint')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 px-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label>Action Taken</label>
                                        <input type="text" name="action_taken" class="form-control"
                                            value="{{ old('action_taken', $recall->action_taken) }}">
                                        @error('action_taken')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 px-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label>Risk Assessment</label>
                                        <input type="text" name="risk_assessment" class="form-control"
                                            value="{{ old('risk_assessment', $recall->risk_assessment) }}">
                                        @error('risk_assessment')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 px-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label>Recall Class</label>
                                        <select class="form-control" name="recall_type">
                                            <option selected disabled>--- Select Recall Class ---</option>
                                            <option value="Class I"
                                                {{ old('recall_type', $recall->recall_type) == 'Class I' ? 'selected' : '' }}>
                                                Class I</option>
                                            <option value="Class II"
                                                {{ old('recall_type', $recall->recall_type) == 'Class II' ? 'selected' : '' }}>
                                                Class II</option>
                                            <option value="Class III"
                                                {{ old('recall_type', $recall->recall_type) == 'Class III' ? 'selected' : '' }}>
                                                Class III</option>
                                            <option value="Class IV"
                                                {{ old('recall_type', $recall->recall_type) == 'Class IV' ? 'selected' : '' }}>
                                                Class IV</option>
                                        </select>
                                        @error('recall_type')
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
