@extends('manager.layout.app')

@section('title')
    Change Control Management
@endsection

@section('page-name')
    Change Control Management
@endsection

@section('active-link-ccm')
    active bg-gradient-primary
@endsection

@section('main-content')
    <div class="container-fluid py-2">
        <div class="row">
            <div class="col-12">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 my-0 z-index-2">
                        <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                            <h6 class="text-white text-capitalize ps-3">Change Control Log</h6>
                        </div>
                    </div>

                    @if (session('status'))
                        <div class="px-3 pt-4">
                            <div class="alert alert-secondary alert-dismissible text-white fade show" role="alert">
                                <small>{{ session('status') }}</small>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        </div>
                    @endif

                    <div class="card-body ps-3 pe-2 pb-5 pt-5">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-center text-secondary small font-weight-bolder opacity-9">
                                            S. No.
                                        </th>
                                        <th class="text-center text-secondary small font-weight-bolder opacity-9">
                                            Request No.
                                        </th>
                                        <th class="text-center text-secondary small font-weight-bolder opacity-9">
                                            Logging Date
                                        </th>
                                        <th class="text-center text-secondary small font-weight-bolder opacity-9">
                                            Initiator
                                        </th>
                                        <th class="text-center text-secondary small font-weight-bolder opacity-9">
                                            Department
                                        </th>
                                        <th class="text-center text-secondary small font-weight-bolder opacity-9">
                                            Initiated By
                                        </th>
                                        <th class="text-center text-secondary small font-weight-bolder opacity-9">
                                            Verified By
                                        </th>
                                        <th class=" text-center text-secondary small font-weight-bolder opacity-9">
                                            Review Committee
                                        </th>
                                        <th class="text-center text-secondary small font-weight-bolder opacity-9">
                                            Approved By <br>
                                            Director
                                        </th>
                                        <th rowspan="2"
                                            class=" text-center text-secondary small font-weight-bolder opacity-9">
                                            Closed By <br>
                                            QA
                                        </th>
                                        <th class="text-center text-secondary small font-weight-bolder opacity-9">
                                            Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($changes as $change)
                                        <tr>
                                            <td class="align-middle text-center text-sm">
                                                {{ $loop->iteration }}
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                {{ $change->request_no }}
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                {{ $change->logging_date }}
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                {{ $change->initiator }}
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                {{ $change->department }}
                                            </td>

                                            <td class="align-middle text-center text-sm">
                                                @if (is_null($change->initiator_name))
                                                    Pending
                                                @else
                                                    {{ $change->initiator_name }}
                                                @endif
                                            </td>

                                            <td class="align-middle text-center text-sm">
                                                @if (is_null($change->initiator_name))
                                                    Pending
                                                @elseif(!is_null($change->initiator_name) && is_null($change->verifier_name))
                                                    <a href="{{ route('manager.ccm.verify', $change->id) }}"
                                                        class="btn bg-gradient-info btn-sm mb-0 ms-1 me-1 " role="button"
                                                        aria-pressed="true">Verify</a>
                                                @else
                                                    {{ $change->verifier_name }}
                                                @endif
                                            </td>


                                            <td class="align-middle text-center text-sm">
                                                @if ($change->classification === 'Major')
                                                    @php
                                                        // Initialize flags and counters
                                                        $canReview = false; // To track if the user can review
                                                        $hasSigned = false; // To track if the user has signed
                                                        $allRecommendationsGiven = true; // To check if all reviewers have given recommendations
                                                    @endphp

                                                    {{-- Loop through reviewers (1 to 3) --}}
                                                    @for ($i = 1; $i <= 3; $i++)
                                                        {{-- Check if the current user is a reviewer --}}
                                                        @if ($change->{'reviewer_name' . $i} === $username)
                                                            {{-- Check if the user has given their recommendation --}}
                                                            @if (!is_null($change->{'recommendation' . $i}))
                                                                {{-- If the user hasn't signed yet, they can review --}}
                                                                @if (is_null($change->{'reviewer_signtime' . $i}))
                                                                    @php
                                                                        $canReview = true;
                                                                    @endphp
                                                                @else
                                                                    @php
                                                                        $hasSigned = true;
                                                                    @endphp
                                                                @endif
                                                            @else
                                                                {{-- Recommendation is missing for this reviewer --}}
                                                                @php
                                                                    $allRecommendationsGiven = false;
                                                                @endphp
                                                            @endif
                                                        @endif
                                                    @endfor

                                                    {{-- Display based on conditions --}}
                                                    @if ($canReview)
                                                        <a href="{{ route('manager.ccm.review', $change->id) }}"
                                                            class="btn bg-gradient-info btn-sm mb-0 ms-1 me-1"
                                                            role="button" aria-pressed="true">Review</a>
                                                    @elseif ($allRecommendationsGiven && $hasSigned)
                                                        Approved
                                                    @elseif (!$allRecommendationsGiven)
                                                        Pending
                                                    @else
                                                        Reviewed
                                                    @endif
                                                @else
                                                    Not Applicable
                                                @endif
                                            </td>




                                            <td class="align-middle text-center text-sm">
                                                @if (is_null($change->approver_name))
                                                    Pending
                                                @else
                                                    {{ $change->approver_name }}
                                                @endif
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                @if (is_null($change->closer_name))
                                                    Pending
                                                @else
                                                    {{ $change->closer_name }}
                                                @endif
                                            </td>

                                            <td>
                                                <div class="d-flex justify-content-center align-items-center">
                                                    <div>
                                                        @if (!is_null($change->closer_signtime))
                                                            <a href="{{ route('manager.ccm.download', $change->id) }}"
                                                                class="btn bg-gradient-success btn-sm mb-0 ms-1 me-1 "
                                                                role="button" aria-pressed="true">Download</a>
                                                        @endif
                                                    </div>

                                                    <div>
                                                        <a href="{{ route('manager.ccm.print', $change->id) }}"
                                                            target="_blank"
                                                            class="btn bg-gradient-secondary btn-sm mb-0 ms-1 me-1 "
                                                            role="button" aria-pressed="true">Print</a>
                                                    </div>

                                                    <div>
                                                        @if ($change->department === $userdepart)
                                                            {{-- case 1 --}}
                                                            @if (!is_null($change->initiator_signtime) && is_null($change->verifier_signtime))
                                                                <a href="{{ route('manager.ccm.edit', $change->id) }}"
                                                                    class="btn bg-gradient-warning btn-sm mb-0 ms-1 me-1"
                                                                    role="button" aria-pressed="true">Update</a>
                                                                {{-- case 2 --}}
                                                            @elseif (!is_null($change->verifier_signtime) && $change->classification === 'Major')
                                                                @for ($i = 1; $i <= 3; $i++)
                                                                    @php
                                                                        $reviewer_name = 'reviewer_name' . $i;
                                                                        $reviewer_signtime = 'reviewer_signtime' . $i;
                                                                    @endphp
                                                                    @if ($change->$reviewer_name === $username)
                                                                        @if (is_null($change->$reviewer_signtime))
                                                                            <a href="{{ route('manager.ccm.edit', $change->id) }}"
                                                                                class="btn bg-gradient-warning btn-sm mb-0 ms-1 me-1"
                                                                                role="button"
                                                                                aria-pressed="true">Update</a>
                                                                        @elseif(!is_null($change->$reviewer_signtime) && !is_null($change->approver_signtime) && is_null($change->final_assessment))
                                                                            <a href="{{ route('manager.ccm.edit', $change->id) }}"
                                                                                class="btn bg-gradient-warning btn-sm mb-0 ms-1 me-1"
                                                                                role="button"
                                                                                aria-pressed="true">Update</a>
                                                                        @else
                                                                        @endif
                                                                    @endif
                                                                @endfor
                                                                {{-- case 3 --}}
                                                            @elseif(
                                                                !is_null($change->verifier_signtime) &&
                                                                    $change->classification === 'Minor' &&
                                                                    !is_null($change->approver_signtime) &&
                                                                    is_null($change->final_assessment))
                                                                <a href="{{ route('manager.ccm.edit', $change->id) }}"
                                                                    class="btn bg-gradient-warning btn-sm mb-0 ms-1 me-1"
                                                                    role="button" aria-pressed="true">Update</a>
                                                            @endif
                                                        @endif
                                                    </div>

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
