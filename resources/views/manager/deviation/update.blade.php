@extends('manager.layout.app')

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
                            <a href="{{ route('manager.deviation.view') }}" class="btn bg-gradient-info" role="button"
                                aria-pressed="true">Go
                                Back</a>
                        </div>

                        <form class='px-3' action="{{ route('manager.deviation.update', $deviation->id) }}"
                            method="post">
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
                                @if (is_null($deviation->verifier_signtime))

                                    {{-- ----------------- Initial Assessment Fields ---------------- --}}
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

                                    <div class="mt-3">
                                        <button type="submit" class="btn bg-gradient-success">Submit</button>
                                    </div>
                                @elseif (!is_null($deviation->verifier_signtime) && !is_null($deviation->approver_signtime))
                                    @if (is_null($deviation->categorization))

                                        {{-- --------------------- Root Cause Fields -------------------------- --}}

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
                                        <div class="mt-3">
                                            <button type="submit" class="btn bg-gradient-success">Submit</button>
                                        </div>
                                    @elseif (!is_null($deviation->categorization) && is_null($deviation->closer_signtime))
                                        @if ($deviation->categorization === 'critical' || $deviation->categorization === 'major')
                                            @if (
                                                ($deviation->reviewer_name1 === $username && is_null($deviation->reviewer_signtime1)) ||
                                                    ($deviation->reviewer_name2 === $username && is_null($deviation->reviewer_signtime2)) ||
                                                    ($deviation->reviewer_name3 === $username && is_null($deviation->reviewer_signtime3)))
                                                {{-- --------------------- Review Committee Recommendation -------------------------- --}}
                                                <p class="ps-3 pt-5 pb-2"><b>Review Committee</b></p>

                                                @for ($i = 1; $i <= 3; $i++)
                                                    @php
                                                        $reviewer_name = 'reviewer_name' . $i;
                                                        $reviewer_signtime = 'reviewer_signtime' . $i;
                                                    @endphp

                                                    @if ($deviation->{'reviewer_name' . $i} === $username)
                                                        <div class="col-md-3 px-3">
                                                            <div class="input-group input-group-static mb-4">
                                                                <label>Reviewer Name #{{ $i }}</label>
                                                                <select class="form-control"
                                                                    name="reviewer_name{{ $i }}">
                                                                    <option value=""
                                                                        {{ old('reviewer_name' . $i) === '' ? 'selected' : '' }}>
                                                                        --- Select Reviewer Name ---</option>
                                                                    <option value="{{ $username }}"
                                                                        {{ old('reviewer_name' . $i, $deviation->$reviewer_name) == $username ? 'selected' : '' }}>
                                                                        {{ $username }}
                                                                    </option>
                                                                </select>
                                                                @error('reviewer_name' . $i)
                                                                    <div class="text-danger small">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                        <div class="col-md-9 px-3">
                                                            <div class="input-group input-group-static mb-4">
                                                                <label>Recommendation #{{ $i }}</label>
                                                                <input type="text"
                                                                    name="recommendation{{ $i }}"
                                                                    class="form-control"
                                                                    value="{{ old('recommendation' . $i, $deviation->{'recommendation' . $i}) }}">
                                                                @error("recommendation$i")
                                                                    <div class="text-danger small">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    @endif
                                                @endfor

                                                <div class="mt-3">
                                                    <button type="submit" class="btn bg-gradient-success">Submit</button>
                                                </div>

                                                {{-- ----------------- Impact Evaluation in case of Critical or Major -------------------------- --}}
                                            @elseif (
                                                ($deviation->reviewer_name1 === $username && !is_null($deviation->reviewer_signtime1)) ||
                                                    ($deviation->reviewer_name2 === $username && !is_null($deviation->reviewer_signtime2)) ||
                                                    ($deviation->reviewer_name3 === $username && !is_null($deviation->reviewer_signtime3)))
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
                                                <div class="mt-3">
                                                    <button type="submit" class="btn bg-gradient-success">Submit</button>
                                                </div>
                                            @endif
                                            {{-- ---------------------- Impact Evaluation in case of minor -------------------------- --}}
                                        @elseif ($deviation->categorization === 'minor' && is_null($deviation->closer_signtime))
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
                                            <div class="mt-3">
                                                <button type="submit" class="btn bg-gradient-success">Submit</button>
                                            </div>
                                        @endif
                                    @endif
                                @endif
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection





























{{-- @if (is_null($deviation->verifier_signtime)) --}}

{{-- ----------------- Initial Assessment Fields ---------------- --}}
{{-- @elseif (!is_null($deviation->verifier_signtime) && !is_null($deviation->approver_signtime))
    @if (is_null($deviation->categorization)) --}}

{{-- --------------------- Root Cause Fields -------------------------- --}}
{{-- @elseif (!is_null($deviation->categorization) && is_null($deviation->closer_signtime))
        @if ($deviation->categorization === 'critical' || $deviation->categorization === 'major')
            @if (($deviation->reviewer_name1 === $username && is_null($deviation->reviewer_signtime1)) || ($deviation->reviewer_name2 === $username && is_null($deviation->reviewer_signtime2)) || ($deviation->reviewer_name3 === $username && is_null($deviation->reviewer_signtime3))) --}}
{{-- --------------------- Review Committee Recommendation -------------------------- --}}

{{-- @for ($i = 1; $i <= 3; $i++)
                    @php
                        $reviewer_name = 'reviewer_name' . $i;
                        $reviewer_signtime = 'reviewer_signtime' . $i;
                    @endphp --}}

{{-- ----------------- Impact Evaluation in case of Critical or Major -------------------------- --}}
{{-- @elseif (
                    ($deviation->reviewer_name1 === $username && !is_null($deviation->reviewer_signtime1)) ||
                        ($deviation->reviewer_name2 === $username && !is_null($deviation->reviewer_signtime2)) ||
                        ($deviation->reviewer_name3 === $username && !is_null($deviation->reviewer_signtime3)))
                @endif --}}
{{-- ---------------------- Impact Evaluation in case of minor -------------------------- --}}
{{-- @elseif ($deviation->categorization === 'minor' && is_null($deviation->closer_signtime))
            @endif
        @endif
    @endif
@endif --}}
