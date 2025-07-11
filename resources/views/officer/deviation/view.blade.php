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
                            <h6 class="text-white text-capitalize ps-3">Deviation Log</h6>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end pe-3 pt-4">
                        <a href="{{ route('officer.deviation.form') }}" class="btn bg-gradient-info" role="button"
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
                                                    Pending
                                                @elseif(!is_null($deviation->verifier_signtime))
                                                    {{ $deviation->verifier_name }}
                                                @endif
                                            </td>

                                            <td class="align-middle text-center text-sm">
                                                @if (is_null($deviation->reviewer_signtime))
                                                    Pending
                                                @elseif(!is_null($deviation->reviewer_signtime))
                                                    {{ $deviation->reviewer_name }}
                                                @endif
                                            </td>

                                            <td class="align-middle text-center text-sm">
                                                @if (is_null($deviation->approver_signtime))
                                                    Pending
                                                @elseif(!is_null($deviation->approver_signtime))
                                                    {{ $deviation->approver_name }}
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
                                                        (!is_null($deviation->reviewer_name1) && is_null($deviation->recommendation1)) ||
                                                            // Check if the user matches reviewer_name2 and has not recommended yet
                                                            (!is_null($deviation->reviewer_name2) && is_null($deviation->recommendation2)) ||
                                                            // Check if the user matches reviewer_name3 has not recommended yet
                                                            (!is_null($deviation->reviewer_name3) && is_null($deviation->recommendation3)))
                                                        Pending
                                                    @elseif (
                                                        // Show Yes if they have already recommended
                                                        // Check if the user matches reviewer_name1 and has not recommended yet
                                                        (!is_null($deviation->reviewer_name1) && !is_null($deviation->recommendation1)) ||
                                                            // Check if the user matches reviewer_name2 and has not recommended yet
                                                            (!is_null($deviation->reviewer_name2) && !is_null($deviation->recommendation2)) ||
                                                            // Check if the user matches reviewer_name3 has not recommended yet
                                                            (!is_null($deviation->reviewer_name3) && !is_null($deviation->recommendation3)))
                                                        Yes
                                                    @endif
                                                @else
                                                    Not Applicable
                                                @endif
                                            </td>

                                            {{-- --------------- Committe Approval ------------- --}}

                                            <td class="align-middle text-center text-sm">
                                                @if ($deviation->categorization === 'critical' || $deviation->categorization === 'major')
                                                    @php
                                                        // Count reviewers and signatures
                                                        $totalReviewers = 0;
                                                        $totalSignatures = 0;

                                                        if (!is_null($deviation->reviewer_name1)) {
                                                            $totalReviewers++;
                                                        }
                                                        if (!is_null($deviation->reviewer_name2)) {
                                                            $totalReviewers++;
                                                        }
                                                        if (!is_null($deviation->reviewer_name3)) {
                                                            $totalReviewers++;
                                                        }

                                                        if (!is_null($deviation->reviewer_signtime1)) {
                                                            $totalSignatures++;
                                                        }
                                                        if (!is_null($deviation->reviewer_signtime2)) {
                                                            $totalSignatures++;
                                                        }
                                                        if (!is_null($deviation->reviewer_signtime3)) {
                                                            $totalSignatures++;
                                                        }
                                                    @endphp

                                                    @if ($totalSignatures === 0)
                                                        Pending
                                                    @elseif ($totalSignatures < $totalReviewers)
                                                        Partially Approved
                                                    @elseif ($totalSignatures === $totalReviewers)
                                                        Approved
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
                                                    @if ($deviation->categorization == 'critical' || $deviation->categorization == 'major')
                                                        @if (
                                                            // Check if three users mentioned and if they have signed yet
                                                            (!is_null($deviation->reviewer_name1) &&
                                                                !is_null($deviation->reviewer_signtime1) &&
                                                                (!is_null($deviation->reviewer_name2) && !is_null($deviation->reviewer_signtime2)) &&
                                                                (!is_null($deviation->reviewer_name3) && !is_null($deviation->reviewer_signtime3))) ||
                                                                // Check if two users mentioned and if they has signed yet
                                                                (!is_null($deviation->reviewer_name1) &&
                                                                    !is_null($deviation->reviewer_signtime1) &&
                                                                    (!is_null($deviation->reviewer_name2) && !is_null($deviation->reviewer_signtime2))) ||
                                                                // Check if one user mentioned and if he has signed yet
                                                                (!is_null($deviation->reviewer_name1) && !is_null($deviation->reviewer_signtime1)))
                                                            Pending
                                                        @else
                                                            Pending
                                                        @endif
                                                    @else
                                                        Pending
                                                    @endif
                                                @elseif (!is_null($deviation->confirmer_name))
                                                    {{ $deviation->confirmer_name }}
                                                @else
                                                    Pending
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
                                                            <a href="{{ route('officer.deviation.download', $deviation->id) }}"
                                                                class="btn bg-gradient-success btn-sm mb-0 ms-1 me-1 "
                                                                role="button" aria-pressed="true">Download</a>
                                                        </div>
                                                    @endif
                                                    <div>
                                                        <a href="{{ route('officer.deviation.print', $deviation->id) }}"
                                                            target="_blank"
                                                            class="btn bg-gradient-secondary btn-sm mb-0 ms-1 me-1 "
                                                            role="button" aria-pressed="true">View</a>
                                                    </div>
                                                    @if (is_null($deviation->verifier_signtime))
                                                        <div>
                                                            <a href="{{ route('officer.deviation.edit', $deviation->id) }}"
                                                                class="btn bg-gradient-warning btn-sm mb-0 ms-1 me-1"
                                                                role="button" aria-pressed="true">Update</a>
                                                        </div>
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
