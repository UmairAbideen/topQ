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
                            <h6 class="text-white text-capitalize ps-3">Deviation Log</h6>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end pe-3 pt-4">
                        <a href="{{ route('manager.deviation.form') }}" class="btn bg-gradient-info" role="button"
                            aria-pressed="true">+
                            Add New</a>
                    </div>

                    @if (session('status'))
                        <div class="px-3">
                            <div class="alert alert-secondary alert-dismissible text-white fade show" role="alert">
                                <small>{{ session('status') }}</small>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        </div>
                    @endif

                    <div class="card-body ps-3 pe-2 pb-5 pt-0">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th rowspan="2"
                                            class="text-center text-secondary small font-weight-bolder opacity-9">
                                            S. No.
                                        </th>
                                        <th rowspan="2"
                                            class="text-center text-secondary small font-weight-bolder opacity-9">
                                            Deviation Date
                                        </th>
                                        <th rowspan="2"
                                            class="text-center text-secondary small font-weight-bolder opacity-9">
                                            Deviation No.
                                        </th>
                                        <th rowspan="2"
                                            class="text-center text-secondary small font-weight-bolder opacity-9">
                                            Initiator
                                        </th>
                                        <th rowspan="2"
                                            class=" text-center text-secondary small font-weight-bolder opacity-9">
                                            Department
                                        </th>
                                        <th rowspan="1" colspan="3"
                                            class=" text-center text-secondary small font-weight-bolder opacity-9">
                                            Initial Approvals
                                        </th>
                                        <th rowspan="2" colspan="1"
                                            class=" text-center text-secondary small font-weight-bolder opacity-9">
                                            Root-Cause Identified<br>
                                            (By Manager)
                                        </th>
                                        <th rowspan="2" colspan="1"
                                            class=" text-center text-secondary small font-weight-bolder opacity-9">
                                            Categorization<br>(By QA)
                                        </th>
                                        <th rowspan="1" colspan="2"
                                            class="text-center text-secondary small font-weight-bolder opacity-9">
                                            Committee<br>Evaluation
                                        </th>
                                        <th rowspan="1" colspan="2"
                                            class="text-center text-secondary small font-weight-bolder opacity-9">
                                            Impact Evaluation<br>(By Manager)
                                        </th>
                                        <th rowspan="1" colspan="2"
                                            class="text-center text-secondary small font-weight-bolder opacity-9">
                                            Recall
                                        </th>
                                        <th rowspan="1" colspan="2"
                                            class="text-center text-secondary small font-weight-bolder opacity-9">
                                            CAPA
                                        </th>
                                        <th rowspan="1" colspan="2"
                                            class="text-center text-secondary small font-weight-bolder opacity-9">
                                            Change Control
                                        </th>
                                        <th rowspan="2" colspan="1"
                                            class="text-center text-secondary small font-weight-bolder opacity-9">
                                            Close out<br>(by Director)
                                        </th>
                                        <th rowspan="2" colspan="1"
                                            class="text-center text-secondary small font-weight-bolder opacity-9">
                                            Actions
                                        </th>
                                    </tr>

                                    <tr>
                                        <th rowspan="1" colspan="1"
                                            class=" text-center text-secondary small font-weight-bolder opacity-9">
                                            Manager
                                        </th>
                                        <th rowspan="1" colspan="1"
                                            class=" text-center text-secondary small font-weight-bolder opacity-9">
                                            QA
                                        </th>
                                        <th rowspan="1" colspan="1"
                                            class=" text-center text-secondary small font-weight-bolder opacity-9">
                                            Director
                                        </th>
                                        <th rowspan="1" colspan="1"
                                            class=" text-center text-secondary small font-weight-bolder opacity-9">
                                            Remarks<br>Given
                                        </th>
                                        <th rowspan="1" colspan="1"
                                            class=" text-center text-secondary small font-weight-bolder opacity-9">
                                            Approval
                                        </th>

                                        <th rowspan="1" colspan="1"
                                            class=" text-center text-secondary small font-weight-bolder opacity-9">
                                            Provided
                                        </th>
                                        <th rowspan="1" colspan="1"
                                            class=" text-center text-secondary small font-weight-bolder opacity-9">
                                            Approval
                                        </th>

                                        <th rowspan="1" colspan="1"
                                            class=" text-center text-secondary small font-weight-bolder opacity-9">
                                            Required
                                        </th>
                                        <th rowspan="1" colspan="1"
                                            class=" text-center text-secondary small font-weight-bolder opacity-9">
                                            Number
                                        </th>
                                        <th rowspan="1" colspan="1"
                                            class=" text-center text-secondary small font-weight-bolder opacity-9">
                                            Required
                                        </th>
                                        <th rowspan="1" colspan="1"
                                            class=" text-center text-secondary small font-weight-bolder opacity-9">
                                            Number
                                        </th>
                                        <th rowspan="1" colspan="1"
                                            class=" text-center text-secondary small font-weight-bolder opacity-9">
                                            Required
                                        </th>
                                        <th rowspan="1" colspan="1"
                                            class=" text-center text-secondary small font-weight-bolder opacity-9">
                                            Number
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($deviations as $deviation)
                                        <tr>
                                            <td class="align-middle text-center text-sm">
                                                {{ $loop->iteration }}
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                {{ $deviation->deviation_date }}
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                {{ $deviation->deviation_no }}
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                {{ $deviation->initiator_name }}
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                {{ $deviation->initiator_department }}
                                            </td>

                                            <td class="align-middle text-center text-sm">
                                                @if (is_null($deviation->verifier_signtime))
                                                    <a href="{{ route('manager.deviaiton.verify', $deviation->id) }}"
                                                        class="btn bg-gradient-info btn-sm mb-0 ms-1 me-1 " role="button"
                                                        aria-pressed="true">Verify</a>
                                                @elseif(!is_null($deviation->verifier_signtime))
                                                    {{ $deviation->verifier_name }}
                                                @else
                                                    Pending
                                                @endif
                                            </td>

                                            <td class="align-middle text-center text-sm">
                                                @if (!is_null($deviation->reviewer_signtime))
                                                    {{ $deviation->reviewer_name }}
                                                @else
                                                    Pending
                                                @endif
                                            </td>

                                            <td class="align-middle text-center text-sm">
                                                @if (!is_null($deviation->approver_signtime))
                                                    {{ $deviation->approver_name }}
                                                @else
                                                    Pending
                                                @endif
                                            </td>

                                            <td class="align-middle text-center text-sm">
                                                @if (!is_null($deviation->root_causes))
                                                    Yes
                                                @else
                                                    Pending
                                                @endif
                                            </td>

                                            <td class="align-middle text-center text-sm">
                                                @if (!is_null($deviation->categorization))
                                                    {{ $deviation->categorization }}
                                                @else
                                                    Pending
                                                @endif
                                            </td>


                                            {{-- --------------- Committe Remarks ------------- --}}
                                            <td class="align-middle text-center text-sm">
                                                @if ($deviation->categorization === 'critical' || $deviation->categorization === 'major')
                                                    @if (
                                                        // Check if the user matches reviewer_name1 and has not recommended yet
                                                        ($deviation->reviewer_name1 === $username && is_null($deviation->recommendation1)) ||
                                                            // Check if the user matches reviewer_name2 and has not recommended yet
                                                            ($deviation->reviewer_name2 === $username && is_null($deviation->recommendation2)) ||
                                                            // Check if the user matches reviewer_name3 has not recommended yet
                                                            ($deviation->reviewer_name3 === $username && is_null($deviation->recommendation3)))
                                                        Pending
                                                    @elseif (
                                                        // Show Yes if they have already recommended
                                                        // Check if the user matches reviewer_name1 and has not recommended yet
                                                        ($deviation->reviewer_name1 === $username && !is_null($deviation->recommendation1)) ||
                                                            // Check if the user matches reviewer_name2 and has not recommended yet
                                                            ($deviation->reviewer_name2 === $username && !is_null($deviation->recommendation2)) ||
                                                            // Check if the user matches reviewer_name3 has not recommended yet
                                                            ($deviation->reviewer_name3 === $username && !is_null($deviation->recommendation3)))
                                                        Yes
                                                    @endif
                                                @else
                                                    Not Applicable
                                                @endif
                                            </td>

                                            {{-- --------------- Committe Approval ------------- --}}
                                            <td class="align-middle text-center text-sm">
                                                @if ($deviation->categorization === 'critical' || $deviation->categorization === 'major')
                                                    @if (
                                                        // Check if the user matches reviewer_name1 and hasn't signed yet
                                                        ($deviation->reviewer_name1 === $username &&
                                                            is_null($deviation->reviewer_signtime1) &&
                                                            !is_null($deviation->recommendation1)) ||
                                                            // Check if the user matches reviewer_name2 and hasn't signed yet
                                                            ($deviation->reviewer_name2 === $username &&
                                                                is_null($deviation->reviewer_signtime2) &&
                                                                !is_null($deviation->recommendation2)) ||
                                                            // Check if the user matches reviewer_name3 and hasn't signed yet
                                                            ($deviation->reviewer_name3 === $username &&
                                                                is_null($deviation->reviewer_signtime3) &&
                                                                !is_null($deviation->recommendation3)))
                                                        <a href="{{ route('manager.deviation.creview', $deviation->id) }}"
                                                            class="btn bg-gradient-info btn-sm mb-0 ms-1 me-1"
                                                            role="button" aria-pressed="true">Review</a>
                                                    @elseif (
                                                        // Show approved if they've already signed
                                                        ($deviation->reviewer_name1 === $username && !is_null($deviation->reviewer_signtime1)) ||
                                                            ($deviation->reviewer_name2 === $username && !is_null($deviation->reviewer_signtime2)) ||
                                                            ($deviation->reviewer_name3 === $username && !is_null($deviation->reviewer_signtime3)))
                                                        Approved
                                                    @else
                                                        Not Applicable
                                                    @endif
                                                @else
                                                    Not Applicable
                                                @endif
                                            </td>

                                            {{-- --------------- Impact Remarks ------------- --}}
                                            <td class="align-middle text-center text-sm">
                                                @if (
                                                    !is_null($deviation->device_effected) ||
                                                        !is_null($deviation->patient_effected) ||
                                                        !is_null($deviation->other_effected))
                                                    Yes
                                                @elseif(is_null($deviation->required_recall) && is_null($deviation->required_capa) && is_null($deviation->required_ccm))
                                                    Pending
                                                @endif
                                            </td>

                                            {{-- --------------- Impact Conirmation ------------- --}}
                                            <td class="align-middle text-center text-sm">
                                                @if (is_null($deviation->confirmer_signtime))
                                                    @if (
                                                        !is_null($deviation->device_effected) ||
                                                            !is_null($deviation->patient_effected) ||
                                                            !is_null($deviation->other_effected))
                                                        <a href="{{ route('manager.deviation.confirm', $deviation->id) }}"
                                                            class="btn bg-gradient-info btn-sm mb-0 ms-1 me-1 "
                                                            role="button" aria-pressed="true">Confirm</a>
                                                    @elseif(is_null($deviation->required_recall) && is_null($deviation->required_capa) && is_null($deviation->required_ccm))
                                                        Pending
                                                    @endif
                                                @elseif (!is_null($deviation->confirmer_signtime))
                                                    {{ $deviation->confirmer_name }}
                                                @endif
                                            </td>

                                            <td class="align-middle text-center text-sm">
                                                @if (is_null($deviation->required_recall))
                                                    Pending
                                                @else
                                                    {{ $deviation->required_recall }}
                                                @endif
                                            </td>

                                            <td class="align-middle text-center text-sm">
                                                @if (is_null($deviation->required_recall) && is_null($deviation->recall_no))
                                                    Pending
                                                @elseif($deviation->required_recall === 'No' && is_null($deviation->recall_no))
                                                    Not Required
                                                @elseif($deviation->required_recall === 'Yes' && !is_null($deviation->recall_no))
                                                    {{ $deviation->recall_no }}
                                                @endif
                                            </td>

                                            <td class="align-middle text-center text-sm">
                                                @if (is_null($deviation->required_capa))
                                                    Pending
                                                @else
                                                    {{ $deviation->required_capa }}
                                                @endif
                                            </td>

                                            <td class="align-middle text-center text-sm">
                                                @if (is_null($deviation->required_capa) && is_null($deviation->capa_no))
                                                    Pending
                                                @elseif($deviation->required_capa === 'No' && is_null($deviation->capa_no))
                                                    Not Required
                                                @elseif($deviation->required_capa === 'Yes' && !is_null($deviation->capa_no))
                                                    {{ $deviation->capa_no }}
                                                @endif
                                            </td>

                                            <td class="align-middle text-center text-sm">
                                                @if (is_null($deviation->required_ccm))
                                                    Pending
                                                @else
                                                    {{ $deviation->required_ccm }}
                                                @endif
                                            </td>

                                            <td class="align-middle text-center text-sm">
                                                @if (is_null($deviation->required_ccm) && is_null($deviation->ccm_no))
                                                    Pending
                                                @elseif($deviation->required_ccm === 'No' && is_null($deviation->ccm_no))
                                                    Not Required
                                                @elseif($deviation->required_ccm === 'Yes' && !is_null($deviation->ccm_no))
                                                    {{ $deviation->ccm_no }}
                                                @endif
                                            </td>

                                            <td class="align-middle text-center text-sm">
                                                @if (!is_null($deviation->closer_signtime))
                                                    {{ $deviation->closer_name }}
                                                @else
                                                    Pending
                                                @endif
                                            </td>

                                            <td>
                                                <div class="d-flex align-items-center">
                                                    @if (!is_null($deviation->closer_signtime))
                                                        <div>
                                                            <a href="{{ route('manager.deviation.download', $deviation->id) }}"
                                                                class="btn bg-gradient-success btn-sm mb-0 ms-1 me-1 "
                                                                role="button" aria-pressed="true">Download</a>
                                                        </div>
                                                    @endif

                                                    <div>
                                                        <a href="{{ route('manager.deviation.print', $deviation->id) }}"
                                                            target="_blank"
                                                            class="btn bg-gradient-secondary btn-sm mb-0 ms-1 me-1 "
                                                            role="button" aria-pressed="true">View</a>
                                                    </div>

                                                    @if (is_null($deviation->verifier_signtime))
                                                        <div>
                                                            <a href="{{ route('manager.deviation.edit', $deviation->id) }}"
                                                                class="btn bg-gradient-warning btn-sm mb-0 ms-1 me-1"
                                                                role="button" aria-pressed="true">Update</a>
                                                        </div>
                                                    @elseif (!is_null($deviation->verifier_signtime) && !is_null($deviation->approver_signtime))
                                                        @if (is_null($deviation->categorization))
                                                            <div>
                                                                <a href="{{ route('manager.deviation.edit', $deviation->id) }}"
                                                                    class="btn bg-gradient-warning btn-sm mb-0 ms-1 me-1"
                                                                    role="button" aria-pressed="true">Update</a>
                                                            </div>
                                                        @elseif (!is_null($deviation->categorization) && is_null($deviation->closer_signtime))
                                                            @if ($deviation->categorization === 'critical' || $deviation->categorization === 'major')
                                                                @if (
                                                                    ($deviation->reviewer_name1 === $username && is_null($deviation->reviewer_signtime1)) ||
                                                                        ($deviation->reviewer_name2 === $username && is_null($deviation->reviewer_signtime2)) ||
                                                                        ($deviation->reviewer_name3 === $username && is_null($deviation->reviewer_signtime3)))
                                                                    <div>
                                                                        <a href="{{ route('manager.deviation.edit', $deviation->id) }}"
                                                                            class="btn bg-gradient-warning btn-sm mb-0 ms-1 me-1"
                                                                            role="button" aria-pressed="true">Update</a>
                                                                    </div>
                                                                @elseif (
                                                                    (($deviation->reviewer_name1 === $username && !is_null($deviation->reviewer_signtime1)) ||
                                                                        ($deviation->reviewer_name2 === $username && !is_null($deviation->reviewer_signtime2)) ||
                                                                        ($deviation->reviewer_name3 === $username && !is_null($deviation->reviewer_signtime3))) &&
                                                                        is_null($deviation->confirmer_signtime))
                                                                    <div>
                                                                        <a href="{{ route('manager.deviation.edit', $deviation->id) }}"
                                                                            class="btn bg-gradient-warning btn-sm mb-0 ms-1 me-1"
                                                                            role="button" aria-pressed="true">Update</a>
                                                                    </div>
                                                                @endif
                                                            @elseif ($deviation->categorization === 'minor' && is_null($deviation->confirmer_signtime))
                                                                <div>
                                                                    <a href="{{ route('manager.deviation.edit', $deviation->id) }}"
                                                                        class="btn bg-gradient-warning btn-sm mb-0 ms-1 me-1"
                                                                        role="button" aria-pressed="true">Update</a>
                                                                </div>
                                                            @endif
                                                        @endif
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
