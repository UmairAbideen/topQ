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
                            <h6 class="text-white text-capitalize ps-3">Deviation Log</h6>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end pe-3 pt-4">
                        <a href="{{ route('qa.deviation.form') }}" class="btn bg-gradient-info" role="button"
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
                                                @if (!is_null($deviation->verifier_signtime))
                                                    {{ $deviation->verifier_name }}
                                                @else
                                                    Pending
                                                @endif
                                            </td>

                                            <td class="align-middle text-center text-sm">
                                                @if (!is_null($deviation->verifier_signtime) && is_null($deviation->reviewer_signtime))
                                                    <a href="{{ route('qa.deviation.review', $deviation->id) }}"
                                                        class="btn bg-gradient-info btn-sm mb-0 ms-1 me-1 " role="button"
                                                        aria-pressed="true">Review</a>
                                                @elseif(!is_null($deviation->reviewer_signtime))
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
                                                @php
                                                    // Determine the status based on the categorization and user actions
                                                    $status = 'Not Applicable'; // Default status

                                                    if (
                                                        $deviation->categorization === 'critical' ||
                                                        $deviation->categorization === 'major'
                                                    ) {
                                                        $status = 'Not Required'; // Default status for critical/major deviations

                                                        for ($i = 1; $i <= 3; $i++) {
                                                            $reviewerNameField = 'reviewer_name' . $i;
                                                            $recommendationField = 'recommendation' . $i;

                                                            if ($deviation->$reviewerNameField === $username) {
                                                                if (is_null($deviation->$recommendationField)) {
                                                                    $status = 'Pending';
                                                                } else {
                                                                    $status = 'Yes';
                                                                }
                                                                break; // Stop checking once the user's status is determined
                                                            }
                                                        }
                                                    }
                                                @endphp

                                                {{ $status }}
                                            </td>



                                            {{-- --------------- Committe Approval ------------- --}}
                                            <td class="align-middle text-center text-sm">
                                                @php
                                                    $status = 'Not Applicable'; // Default status

                                                    if (in_array($deviation->categorization, ['critical', 'major'])) {
                                                        for ($i = 1; $i <= 3; $i++) {
                                                            $reviewerName = $deviation->{'reviewer_name' . $i};
                                                            $reviewerSigntime = $deviation->{'reviewer_signtime' . $i};
                                                            $recommendation = $deviation->{'recommendation' . $i};

                                                            // If user is a reviewer and hasn't signed yet but has given a recommendation, show Review button
        if (
            $reviewerName === $username &&
            is_null($reviewerSigntime) &&
            !is_null($recommendation)
        ) {
            $status =
                '<a href="' .
                route('qa.deviation.creview', $deviation->id) .
                '"
                                                                                                                                class="btn bg-gradient-info btn-sm mb-0 ms-1 me-1"
                                                                                                                                role="button" aria-pressed="true">Review</a>';
            break;
        }

        // If user has already signed, show Approved
        if (
            $reviewerName === $username &&
            !is_null($reviewerSigntime)
        ) {
            $status = 'Approved';
                                                                break;
                                                            }
                                                        }
                                                    }
                                                @endphp

                                                {!! $status !!} {{-- Use {!! !!} to render HTML correctly --}}
                                            </td>




                                            {{-- --------------- Impact Provided ------------- --}}
                                            <td class="align-middle text-center text-sm">
                                                @if (
                                                    !is_null($deviation->device_effected) &&
                                                        !is_null($deviation->patient_effected) &&
                                                        !is_null($deviation->other_effected))
                                                    Yes
                                                @elseif(is_null($deviation->required_recall) && is_null($deviation->required_capa) && is_null($deviation->required_ccm))
                                                    Pending
                                                @endif
                                            </td>


                                            {{-- --------------- Impact Evaluation ------------- --}}
                                            <td class="align-middle text-center text-sm">
                                                @if (is_null($deviation->confirmer_signtime))
                                                    {{-- Check if categorization is critical or major --}}
                                                    @if (in_array($deviation->categorization, ['critical', 'major']))
                                                        @php
                                                            // Collect reviewers and their sign times
                                                            $reviewers = [
                                                                [
                                                                    'name' => $deviation->reviewer_name1,
                                                                    'signtime' => $deviation->reviewer_signtime1,
                                                                ],
                                                                [
                                                                    'name' => $deviation->reviewer_name2,
                                                                    'signtime' => $deviation->reviewer_signtime2,
                                                                ],
                                                                [
                                                                    'name' => $deviation->reviewer_name3,
                                                                    'signtime' => $deviation->reviewer_signtime3,
                                                                ],
                                                            ];

                                                            // Check if all assigned reviewers have signed
                                                            $allReviewersSigned = true;
                                                            foreach ($reviewers as $reviewer) {
                                                                if (
                                                                    !is_null($reviewer['name']) &&
                                                                    is_null($reviewer['signtime'])
                                                                ) {
                                                                    $allReviewersSigned = false;
                                                                    break;
                                                                }
                                                            }
                                                        @endphp

                                                        {{-- Show Confirm button if all reviewers signed --}}
                                                        @if (
                                                            $allReviewersSigned &&
                                                                !is_null($deviation->device_effected) &&
                                                                !is_null($deviation->patient_effected) &&
                                                                !is_null($deviation->other_effected))
                                                            <a href="{{ route('qa.deviation.confirm', $deviation->id) }}"
                                                                class="btn bg-gradient-info btn-sm mb-0 ms-1 me-1"
                                                                role="button" aria-pressed="true">Confirm</a>
                                                        @else
                                                            Pending
                                                        @endif
                                                    @elseif (
                                                        $deviation->categorization === 'minor' &&
                                                            !is_null($deviation->device_effected) &&
                                                            !is_null($deviation->patient_effected) &&
                                                            !is_null($deviation->other_effected))
                                                        {{-- Minor deviations can be confirmed without reviewers --}}
                                                        <a href="{{ route('qa.deviation.confirm', $deviation->id) }}"
                                                            class="btn bg-gradient-info btn-sm mb-0 ms-1 me-1"
                                                            role="button" aria-pressed="true">Confirm</a>
                                                    @else
                                                        Pending
                                                    @endif
                                                @else
                                                    {{-- Show confirmer name if already signed --}}
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
                                                            <a href="{{ route('qa.deviation.download', $deviation->id) }}"
                                                                class="btn bg-gradient-success btn-sm mb-0 ms-1 me-1 "
                                                                role="button" aria-pressed="true">Download</a>
                                                        </div>
                                                    @endif

                                                    <div>
                                                        <a href="{{ route('qa.deviation.print', $deviation->id) }}"
                                                            target="_blank"
                                                            class="btn bg-gradient-secondary btn-sm mb-0 ms-1 me-1 "
                                                            role="button" aria-pressed="true">View</a>
                                                    </div>

                                                    <div>
                                                        <a href="{{ route('qa.deviation.edit', $deviation->id) }}"
                                                            class="btn bg-gradient-warning btn-sm mb-0 ms-1 me-1"
                                                            role="button" aria-pressed="true">Update</a>
                                                    </div>

                                                    @if (is_null($deviation->closer_signtime))
                                                        <div>
                                                            <button type="button"
                                                                class="btn bg-gradient-danger btn-sm mb-0 ms-1 me-1"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#modal-delete-{{ $deviation->id }}">Delete</button>

                                                            <div class="modal fade"
                                                                id="modal-delete-{{ $deviation->id }}" tabindex="-1"
                                                                role="dialog"
                                                                aria-labelledby="modal-delete-{{ $deviation->id }}"
                                                                aria-hidden="true">

                                                                <div class="modal-dialog modal-dialog-centered modal-"
                                                                    role="document">

                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h6 class="modal-title font-weight-normal"
                                                                                id="modal-title-default">Deviation Form
                                                                                Deletion
                                                                            </h6>
                                                                            <button type="button"
                                                                                class="btn-close text-dark"
                                                                                data-bs-dismiss="modal"
                                                                                aria-label="Close">
                                                                                <span aria-hidden="true">×</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <p>Do you want to remove Deviation Form?</p>
                                                                        </div>
                                                                        <div class="modal-footer">

                                                                            <a href="{{ route('qa.deviation.delete', $deviation->id) }}"
                                                                                class="btn btn-danger btn-sm mb-0 ms-1 me-1"
                                                                                role="button" aria-pressed="true">Yes</a>

                                                                            <button type="button"
                                                                                class="btn btn-light btn-sm mb-0 ms-1 me-1"
                                                                                data-bs-dismiss="modal">No</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
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
