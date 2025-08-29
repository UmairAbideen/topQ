@extends('guest.layout.app')

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
            <img src="/assets/img/logo-4.png" class="w-35" alt="main_logo">
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card my-4 mx-2">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 my-0 z-index-2">
                        <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                            <h4 class="text-white text-capitalize ps-3 text-center">Customer Feedback Form</h4>
                        </div>

                        <form class="px-3 pt-5" action="{{ route('guest.feedback.create') }}" method="post">
                            @csrf

                            @if (session('status'))
                                <div class="alert alert-success alert-dismissible text-white fade show" role="alert">
                                    <small>{{ session('status') }}</small>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif

                            <p class="small ms-1 pb-2"><b>Please Note: Fields with <span class="text-danger">*</span>
                                    are mandatory to fill.</b></p>

                            {{-- User Details (Always Open) --}}
                            <div class="row">
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
                            </div>

                            {{-- Accordion for Feedback Sections --}}
                            <div class="accordion mt-4" id="feedbackAccordion">

                                {{-- Instrumentation --}}
                                <div class="accordion-item mb-2">
                                    <h2 class="accordion-header" id="headingOne">
                                        <button
                                            class="accordion-button bg-gradient-dark shadow-dark text-white d-flex justify-content-between align-items-center
                                            py-2 m-0"
                                            type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne"
                                            aria-expanded="true">

                                            <h5 class="text-white text-capitalize ps-3">Instrumentation
                                                Feedback</h5>
                                            <span class="material-icons ms-2 mb-1 rotate-icon">chevron_right</span>
                                        </button>
                                    </h2>

                                    <div id="collapseOne" class="accordion-collapse collapse"
                                        data-bs-parent="#feedbackAccordion">
                                        <div class="accordion-body">

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
                                                <div class="px-2 pt-3 w-100">
                                                    <p class="small"><strong>{{ $label }}</strong></p>

                                                    {{-- ✅ Use flex instead of fixed col-md-2 --}}
                                                    <div class="d-flex justify-content-between flex-wrap">
                                                        @foreach ($options as $option)
                                                            <div class="form-check me-2">
                                                                <input class="form-check-input" type="radio"
                                                                    name="{{ $name }}"
                                                                    value="{{ $option }}">
                                                                <label class="form-check-label">{{ $option }}</label>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            @endforeach

                                            <div class="px-3 py-3">
                                                <div class="input-group input-group-static mb-4">
                                                    <label><strong>Remarks (if any)</strong></label>
                                                    <textarea name="remarksins" rows="2" class="form-control"></textarea>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>



                                {{-- Technical Service --}}
                                <div class="accordion-item mb-2">
                                    <h2 class="accordion-header" id="headingTwo">
                                        <button
                                            class="accordion-button bg-gradient-primary shadow-primary text-white d-flex justify-content-between align-items-center py-2 m-0"
                                            type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo"
                                            aria-expanded="true">

                                            <h5 class="text-white text-capitalize ps-3">Technical Service Feedback</h5>
                                            <span class="material-icons ms-2 mb-1 rotate-icon">chevron_right</span>
                                        </button>
                                    </h2>

                                    <div id="collapseTwo" class="accordion-collapse collapse"
                                        data-bs-parent="#feedbackAccordion">
                                        <div class="accordion-body">

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
                                                <div class="px-2 pt-3 w-100">
                                                    <p class="small"><strong>{{ $label }}</strong></p>

                                                    <div class="d-flex justify-content-between flex-wrap">
                                                        @foreach ($options as $option)
                                                            <div class="form-check me-2">
                                                                <input class="form-check-input" type="radio"
                                                                    name="{{ $name }}"
                                                                    value="{{ $option }}">
                                                                <label
                                                                    class="form-check-label">{{ $option }}</label>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            @endforeach

                                            <div class="px-3 py-3">
                                                <div class="input-group input-group-static mb-4">
                                                    <label><strong>Remarks (if any)</strong></label>
                                                    <textarea name="remarksts" rows="2" class="form-control"></textarea>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>


                                {{-- IOLs --}}
                                <div class="accordion-item mb-2">
                                    <h2 class="accordion-header" id="headingThree">
                                        <button
                                            class="accordion-button bg-gradient-dark shadow-dark text-white d-flex justify-content-between align-items-center py-2 m-0"
                                            type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree"
                                            aria-expanded="true">

                                            <h5 class="text-white text-capitalize ps-3">Intraocular Lens Feedback</h5>
                                            <span class="material-icons ms-2 mb-1 rotate-icon">chevron_right</span>
                                        </button>
                                    </h2>

                                    <div id="collapseThree" class="accordion-collapse collapse"
                                        data-bs-parent="#feedbackAccordion">
                                        <div class="accordion-body">

                                            @php
                                                $iolFeedbackSections = [
                                                    'iolp' => 'Product Quality',
                                                    'iole' => 'Market Competitive Price',
                                                    'iolo' => 'Overall Services',
                                                    'iolr' => 'Response to Complaints',
                                                ];
                                                $options = ['Excellent', 'Good', 'Average', 'Low', 'Poor'];
                                            @endphp

                                            @foreach ($iolFeedbackSections as $name => $label)
                                                <div class="px-2 pt-3 w-100">
                                                    <p class="small"><strong>{{ $label }}</strong></p>

                                                    <div class="d-flex justify-content-between flex-wrap">
                                                        @foreach ($options as $option)
                                                            <div class="form-check me-2">
                                                                <input class="form-check-input" type="radio"
                                                                    name="{{ $name }}"
                                                                    value="{{ $option }}">
                                                                <label
                                                                    class="form-check-label">{{ $option }}</label>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            @endforeach

                                            <div class="px-3 py-3">
                                                <div class="input-group input-group-static mb-4">
                                                    <label><strong>Remarks (if any)</strong></label>
                                                    <textarea name="remarksiol" rows="2" class="form-control"></textarea>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>


                                {{-- Dry Eye --}}
                                <div class="accordion-item mb-2">
                                    <h2 class="accordion-header" id="headingFour">
                                        <button
                                            class="accordion-button bg-gradient-primary shadow-primary text-white d-flex justify-content-between align-items-center py-2 m-0"
                                            type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour"
                                            aria-expanded="true">

                                            <h5 class="text-white text-capitalize ps-3">Dry Eye & Ocular Health Feedback</h5>
                                            <span class="material-icons ms-2 mb-1 rotate-icon">chevron_right</span>
                                        </button>
                                    </h2>

                                    <div id="collapseFour" class="accordion-collapse collapse"
                                        data-bs-parent="#feedbackAccordion">
                                        <div class="accordion-body">

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
                                                <div class="px-2 pt-3 w-100">
                                                    <p class="small"><strong>{{ $label }}</strong></p>

                                                    <div class="d-flex justify-content-between flex-wrap">
                                                        @foreach ($options as $option)
                                                            <div class="form-check me-2">
                                                                <input class="form-check-input" type="radio"
                                                                    name="{{ $name }}"
                                                                    value="{{ $option }}">
                                                                <label
                                                                    class="form-check-label">{{ $option }}</label>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            @endforeach

                                            <div class="px-3 py-3">
                                                <div class="input-group input-group-static mb-4">
                                                    <label><strong>Remarks (if any)</strong></label>
                                                    <textarea name="remarksde" rows="2" class="form-control"></textarea>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                            </div> {{-- end accordion --}}

                            <div class="mt-4">
                                <button type="submit" class="btn bg-gradient-success">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.querySelectorAll('.accordion-button').forEach(btn => {
            let icon = btn.querySelector('.material-icons');

            btn.addEventListener('click', () => {
                setTimeout(() => {
                    if (btn.classList.contains('collapsed')) {
                        icon.textContent = 'chevron_right'; // collapsed
                    } else {
                        icon.textContent = 'expand_more'; // expanded (down arrow)
                    }
                }, 150); // wait for Bootstrap toggle
            });
        });
    </script>
@endsection
