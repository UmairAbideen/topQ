@extends('qa.layout.app')

@section('title')
    Customer Feedback
@endsection

@section('page-name')
    Customer Feedback
@endsection

@section('active-link-feedback')
    active bg-gradient-primary
@endsection

@section('main-content')
    <div class="container-fluid pt-5 pb-4 px-3">

        <div class="d-flex justify-content-center mb-5">
            <img src="/assets/img/logo-4.png" class="w-30" alt="main_logo">
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card my-4 mx-2">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 my-0 z-index-2">
                        <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                            <h5 class="text-white text-capitalize ps-3">Customer Feedback Form</h5>
                        </div>

                        <form class='px-3 pt-5' action="{{ route('qa.feedback.create') }}" method="post">
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
                                <p class="small ms-1 pb-2"><b>Please Note: Fields with <span class="text-danger">*</span>
                                        are mandatory to fill.</b></p>

                                <div class="col-md-6 px-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label>Name <span class="text-danger">*</span></label>
                                        <input type="text" name="name" class="form-control"
                                            value="{{ old('name') }}">
                                        @error('name')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 px-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label>Designation <span class="text-danger">*</span></label>
                                        <input type="text" name="designation" class="form-control"
                                            value="{{ old('designation') }}">
                                        @error('designation')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 px-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label>Email <span class="text-danger">*</span></label>
                                        <input type="email" name="email" class="form-control"
                                            value="{{ old('email') }}">
                                        @error('email')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 px-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label>Organization <span class="text-danger">*</span></label>
                                        <input type="text" name="organization" class="form-control"
                                            value="{{ old('organization') }}">
                                        @error('organization')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>


                                {{-- Instrumentation --}}
                                <h5 class="text-center text-muted pt-5 pb-2">Instrumentation Feedback</h5>
                                <div class="col-md-12 pb-0">
                                    <p class="small ps-1">Please tick the below options to the best of your experience</p>
                                </div>

                                @php
                                    $feedbackSections = [
                                        'insp' => 'Product Quality',
                                        'inse' => 'Market Competitive Price',
                                        'inso' => 'Overall Services',
                                        'insr' => 'Response to Complaints',
                                    ];

                                    $options = ['Excellent', 'Good', 'Average', 'Low', 'Poor'];
                                @endphp

                                @foreach ($feedbackSections as $name => $label)
                                    <div class="col-md-12 px-3 pt-3">
                                        <p class="small"><strong>{{ $label }}</strong></p>

                                        <div class="col-md-12 px-1 py-0 my-0 d-flex justify-content-between">
                                            @foreach ($options as $option)
                                                <div class="form-check px-0">
                                                    <input class="form-check-input" type="radio"
                                                        name="{{ $name }}" value="{{ $option }}">
                                                    <label class="custom-control-label">{{ $option }}</label>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endforeach

                                <div class="col-md-12 px-3 py-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label><strong>Remarks (if any)</strong></label>
                                        <textarea name="remarksins" rows="1" cols="50" class="form-control"></textarea>
                                    </div>
                                </div>


                                {{-- Technical Service Feedback --}}
                                <h5 class="text-center text-muted pt-5 pb-2">Technical Service Feedback</h5>
                                <div class="col-md-12 pb-0">
                                    <p class="small ps-1">Please tick the below options to the best of your experience</p>
                                </div>

                                {{-- Technical Service Feedback Sections --}}
                                @php
                                    $technicalServiceSections = [
                                        'tsc' => 'Response to Complaint',
                                        'tsat' => 'Call Attended in Scheduled Time',
                                        'tse' => 'Market Competitive Price',
                                        'tsp' => 'Overall Performance',
                                    ];
                                    $options = ['Excellent', 'Good', 'Average', 'Low', 'Poor'];
                                @endphp

                                @foreach ($technicalServiceSections as $name => $label)
                                    <div class="col-md-12 px-3 pt-3">
                                        <p class="small"><strong>{{ $label }}</strong></p>
                                        <div class="col-md-12 px-1 py-0 my-0 d-flex justify-content-between">
                                            @foreach ($options as $option)
                                                <div class="form-check px-0">
                                                    <input class="form-check-input" type="radio"
                                                        name="{{ $name }}" value="{{ $option }}"
                                                        id="customRadio{{ $loop->parent->iteration }}_{{ $loop->iteration }}">
                                                    <label class="custom-control-label"
                                                        for="customRadio{{ $loop->parent->iteration }}_{{ $loop->iteration }}">{{ $option }}</label>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endforeach

                                {{-- Remarks Section --}}
                                <div class="col-md-12 px-3 py-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label><strong>Remarks (if any)</strong></label>
                                        <textarea name="remarksts" rows="1" cols="50" class="form-control"></textarea>
                                    </div>
                                </div>


                                {{-- IOLs --}}
                                <h5 class="text-center text-muted pt-5 pb-2">Intraocular Lens Feedback</h5>
                                <div class="col-md-12 pb-0">
                                    <p class="small ps-1">Please tick the below options to the best of your experience</p>
                                </div>

                                @php
                                    $iolFeedbackSections = [
                                        'iolp' => 'Product Quality',
                                        'iole' => 'Market Competitive Price',
                                        'iolo' => 'Overall Services',
                                        'iolr' => 'Response to Complaints',
                                    ];

                                    $iolOptions = ['Excellent', 'Good', 'Average', 'Low', 'Poor'];
                                @endphp

                                @foreach ($iolFeedbackSections as $name => $label)
                                    <div class="col-md-12 px-3 pt-3">
                                        <p class="small"><strong>{{ $label }}</strong></p>

                                        <div class="col-md-12 px-1 py-0 my-0 d-flex justify-content-between">
                                            @foreach ($iolOptions as $option)
                                                <div class="form-check px-0">
                                                    <input class="form-check-input" type="radio"
                                                        name="{{ $name }}" value="{{ $option }}">
                                                    <label class="custom-control-label">{{ $option }}</label>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endforeach

                                <div class="col-md-12 px-3 py-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label><strong>Remarks (if any)</strong></label>
                                        <textarea name="remarksiol" rows="1" cols="50" class="form-control"></textarea>
                                    </div>
                                </div>


                                {{-- Dry Eye --}}
                                <h5 class="text-center text-muted pt-5 pb-2">Dry Eye Feedback</h5>
                                <div class="col-md-12 pb-0">
                                    <p class="small ps-1">Please tick the below options to the best of your experience</p>
                                </div>

                                {{-- Dry Eye Feedback Sections --}}
                                @php
                                    $dryEyeFeedbackSections = [
                                        'dep' => 'Product Quality',
                                        'dee' => 'Market Competitive Price',
                                        'deo' => 'Overall Services',
                                        'der' => 'Response to Complaints',
                                    ];
                                    $options = ['Excellent', 'Good', 'Average', 'Low', 'Poor'];
                                @endphp

                                @foreach ($dryEyeFeedbackSections as $name => $label)
                                    <div class="col-md-12 px-3 pt-3">
                                        <p class="small"><strong>{{ $label }}</strong></p>
                                        <div class="col-md-12 px-1 py-0 my-0 d-flex justify-content-between">
                                            @foreach ($options as $option)
                                                <div class="form-check px-0">
                                                    <input class="form-check-input" type="radio"
                                                        name="{{ $name }}" value="{{ $option }}"
                                                        id="customRadio{{ $loop->parent->iteration }}_{{ $loop->iteration }}">
                                                    <label class="custom-control-label"
                                                        for="customRadio{{ $loop->parent->iteration }}_{{ $loop->iteration }}">{{ $option }}</label>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endforeach

                                {{-- Remarks Section --}}
                                <div class="col-md-12 px-3 py-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label><strong>Remarks (if any)</strong></label>
                                        <textarea name="remarksde" rows="1" cols="50" class="form-control"></textarea>
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
