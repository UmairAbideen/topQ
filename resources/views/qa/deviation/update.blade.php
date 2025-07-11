@extends('qa.layout.app')

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
                            <h6 class="text-white text-capitalize ps-3">Update Deviation Form</h6>
                        </div>

                        <div class="d-flex justify-content-end pe-0 pt-4">
                            <a href="{{ route('qa.deviation.view') }}" class="btn bg-gradient-info" role="button"
                                aria-pressed="true">Go
                                Back</a>
                        </div>

                        <form class='px-3' action="{{ route('qa.deviation.update', $deviation->id) }}" method="post">
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

                                <p class="ps-3 pt-5 pb-2"><b>Initial Information</b></p>

                                <div class="col-md-6 px-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label>Deviation Date</label>
                                        <input type="date" name="deviation_date" class="form-control"
                                            value="{{ old('deviation_date', $deviation->deviation_date) }}">
                                        @error('deviation_date')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 px-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label>Deviation Number</label>
                                        <input type="text" name="deviation_no" class="form-control"
                                            value="{{ old('deviation_no', $deviation->deviation_no) }}">
                                        @error('deviation_no')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 px-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label>Initiator Name</label>
                                        <input type="text" name="initiator_name" class="form-control"
                                            value="{{ old('initiator_name', $deviation->initiator_name) }}">
                                        @error('initiator_name')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 px-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label>Department</label>
                                        <input type="text" name="initiator_department" class="form-control"
                                            value="{{ old('initiator_department', $deviation->initiator_department) }}">
                                        @error('initiator_department')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 px-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label>Designation</label>
                                        <input type="text" name="initiator_designation" class="form-control"
                                            value="{{ old('initiator_designation', $deviation->initiator_designation) }}">
                                        @error('initiator_designation')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <p class="ps-3 pt-5 pb-2"><b>Initial Assessment</b></p>

                                <div class="col-md-6 px-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label>Subject</label>
                                        <select class="form-control ps-2" name="subject">
                                            <option disabled>--- Select option ---</option>
                                            <option value="product"
                                                {{ old('subject', $deviation->subject) == 'product' ? 'selected' : '' }}>
                                                Product</option>
                                            <option value="service"
                                                {{ old('subject', $deviation->subject) == 'service' ? 'selected' : '' }}>
                                                Service</option>
                                            <option value="process"
                                                {{ old('subject', $deviation->subject) == 'process' ? 'selected' : '' }}>
                                                Process</option>
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
                                            <option disabled>--- Select option ---</option>
                                            <option value="planned deviation"
                                                {{ old('status', $deviation->status) == 'planned deviation' ? 'selected' : '' }}>
                                                Planned Deviation</option>
                                            <option value="un-planned deviation"
                                                {{ old('status', $deviation->status) == 'un-planned deviation' ? 'selected' : '' }}>
                                                Unplanned Deviation</option>
                                        </select>
                                        @error('status')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 px-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label>Detail</label>
                                        <input type="text" name="detail" class="form-control"
                                            value="{{ old('detail', $deviation->detail) }}">
                                        @error('detail')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 px-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label>Deviation Statement</label>
                                        <input type="text" name="statement" class="form-control"
                                            value="{{ old('statement', $deviation->statement) }}">
                                        @error('statement')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 px-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label>Immediate Action(s)</label>
                                        <textarea name="action" class="form-control" cols="1" rows="1">{{ old('action', $deviation->action) }}</textarea>
                                        @error('action')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <p class="ps-3 pt-5 pb-2"><b>Root Cause Analysis</b></p>

                                <div class="col-md-6 px-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label>Possible Root Cause(s)</label>
                                        <textarea name="root_causes" class="form-control" cols="1" rows="1">{{ old('root_causes', $deviation->root_causes) }}</textarea>
                                        @error('root_causes')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 px-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label>Remarks (If Any)</label>
                                        <input type="text" name="root_cause_remarks" class="form-control"
                                            value="{{ old('root_cause_remarks', $deviation->root_cause_remarks) }}">
                                        @error('root_cause_remarks')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <p class="ps-3 pt-5 pb-2"><b>Categorization</b></p>

                                <div class="col-md-6 px-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label>Deviation Categorization</label>
                                        <select class="form-control ps-2" name="categorization">
                                            <option disabled selected>--- Select option ---</option>
                                            <option value="minor"
                                                {{ old('categorization', $deviation->categorization) == 'minor' ? 'selected' : '' }}>
                                                Minor Deviation</option>
                                            <option value="major"
                                                {{ old('categorization', $deviation->categorization) == 'major' ? 'selected' : '' }}>
                                                Major Deviation</option>
                                            <option value="critical"
                                                {{ old('categorization', $deviation->categorization) == 'critical' ? 'selected' : '' }}>
                                                Critical Deviation</option>
                                        </select>
                                        @error('categorization')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <p class="ps-3 pt-5 pb-2"><b>Review Committee</b></p>

                                @php
                                    $reviewerNames = [
                                        'Ayub Ismail',
                                        'Hassan Khatri',
                                        'Muhammad Faisal',
                                        'Akhtar Safi',
                                        'Faisal Khan',
                                        'Babar Khan',
                                        'Zain Nasir',
                                        'Muhammad Umair',
                                    ];
                                @endphp

                                @for ($i = 1; $i <= 3; $i++)
                                    <div class="col-md-3 px-3">
                                        <div class="input-group input-group-static mb-4">
                                            <label>Reviewer Name #{{ $i }}</label>
                                            <select class="form-control" name="reviewer_name{{ $i }}">
                                                <option disabled selected>--- Select Reviewer Name ---</option>
                                                @foreach ($reviewerNames as $name)
                                                    <option value="{{ $name }}"
                                                        {{ old('reviewer_name' . $i, $deviation->{'reviewer_name' . $i}) == $name ? 'selected' : '' }}>
                                                        {{ $name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('reviewer_name' . $i)
                                                <div class="text-danger small">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-9 px-3">
                                        <div class="input-group input-group-static mb-4">
                                            <label>Recommendation #{{ $i }}</label>
                                            <input type="text" name="recommendation{{ $i }}"
                                                class="form-control"
                                                value="{{ old('recommendation' . $i, $deviation->{'recommendation' . $i}) }}">
                                            @error("recommendation$i")
                                                <div class="text-danger small">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                @endfor

                                <p class="ps-3 pt-5 pb-2"><b>Impact Evaluation</b> (By Manager)</p>

                                <div class="col-md-6 px-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label>Medical Device Effected? If yes, give details</label>
                                        <textarea name="device_effected" class="form-control" cols="1" rows="1">{{ old('device_effected', $deviation->device_effected) }}</textarea>
                                        @error('device_effected')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 px-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label>Patient Effected? If yes, give details</label>
                                        <textarea name="patient_effected" class="form-control" cols="1" rows="1">{{ old('patient_effected', $deviation->patient_effected) }}</textarea>
                                        @error('patient_effected')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 px-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label>Any Other Process or Service Effected?</label>
                                        <textarea name="other_effected" class="form-control" cols="1" rows="1">{{ old('other_effected', $deviation->other_effected) }}</textarea>
                                        @error('other_effected')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <p class="ps-3 pt-5 pb-2"><b>Impact Evaluation</b> (By QA)</p>

                                <div class="col-md-6 px-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label>Recall Required?</label>
                                        <select class="form-control ps-2" name="required_recall">
                                            <option disabled selected>--- Select option ---</option>
                                            <option value="Yes"
                                                {{ old('required_recall', $deviation->required_recall) == 'Yes' ? 'selected' : '' }}>
                                                Yes</option>
                                            <option value="No"
                                                {{ old('required_recall', $deviation->required_recall) == 'No' ? 'selected' : '' }}>
                                                No</option>
                                        </select>
                                        @error('required_recall')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 px-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label>Recall Number</label>
                                        <input type="text" name="recall_no" class="form-control"
                                            value="{{ old('recall_no', $deviation->recall_no) }}">
                                        @error('recall_no')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 px-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label>CAPA Required?</label>
                                        <select class="form-control ps-2" name="required_capa">
                                            <option disabled selected>--- Select option ---</option>
                                            <option value="Yes"
                                                {{ old('required_capa', $deviation->required_capa) == 'Yes' ? 'selected' : '' }}>
                                                Yes</option>
                                            <option value="No"
                                                {{ old('required_capa', $deviation->required_capa) == 'No' ? 'selected' : '' }}>
                                                No</option>
                                        </select>
                                        @error('required_capa')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 px-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label>CAPA Number</label>
                                        <input type="text" name="capa_no" class="form-control"
                                            value="{{ old('capa_no', $deviation->capa_no) }}">
                                        @error('capa_no')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 px-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label>Change Control Required?</label>
                                        <select class="form-control ps-2" name="required_ccm">
                                            <option disabled selected>--- Select option ---</option>
                                            <option value="Yes"
                                                {{ old('required_ccm', $deviation->required_ccm) == 'Yes' ? 'selected' : '' }}>
                                                Yes</option>
                                            <option value="No"
                                                {{ old('required_ccm', $deviation->required_ccm) == 'No' ? 'selected' : '' }}>
                                                No</option>
                                        </select>
                                        @error('required_ccm')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 px-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label>Change Control Number</label>
                                        <input type="text" name="ccm_no" class="form-control"
                                            value="{{ old('ccm_no', $deviation->ccm_no) }}">
                                        @error('ccm_no')
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
