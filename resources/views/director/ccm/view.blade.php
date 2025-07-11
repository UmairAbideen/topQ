@extends('director.layout.app')

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

                    <div class="d-flex justify-content-end pe-3 pt-4">
                        <a href="{{ route('qa.ccm.form') }}" class="btn bg-gradient-info" role="button" aria-pressed="true">+
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
                                            Approved By
                                        </th>
                                        <th rowspan="2"
                                            class=" text-center text-secondary small font-weight-bolder opacity-9">
                                            Closed By
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
                                                @if (is_null($change->verifier_name))
                                                    Pending
                                                @else
                                                    {{ $change->verifier_name }}
                                                @endif
                                            </td>




                                            <td class="align-middle text-center text-sm">
                                                @if ($change->classification === 'Major')
                                                    @php
                                                        // Flag to track if the current user has taken action
                                                        $actionTaken = false;
                                                        // Count the number of signed reviewers
                                                        $totalSigned = 0;
                                                        // Count the total reviewers
                                                        $totalReviewers = 0;
                                                    @endphp

                                                    {{-- Loop through reviewer names and their corresponding sign times --}}
                                                    @for ($i = 1; $i <= 3; $i++)
                                                        {{-- Check if reviewer name exists --}}
                                                        @if (!is_null($change->{'reviewer_name' . $i}))
                                                            @php $totalReviewers++; @endphp

                                                            {{-- Check if the username matches the current reviewer --}}
                                                            @if ($change->{'reviewer_name' . $i} === $username)
                                                                {{-- If the user hasn't signed yet, show the "Review" button --}}
                                                                @if (is_null($change->{'reviewer_signtime' . $i}))
                                                                    <a href="{{ route('qa.ccm.review', $change->id) }}"
                                                                        class="btn bg-gradient-info btn-sm mb-0 ms-1 me-1"
                                                                        role="button" aria-pressed="true">Review</a>
                                                                    @php $actionTaken = true; @endphp
                                                                @else
                                                                    {{-- Display the username if the user has already signed --}}
                                                                    Partially Approved
                                                                    @php
                                                                        $actionTaken = true;
                                                                        $totalSigned++;
                                                                    @endphp
                                                                @endif
                                                            @else
                                                                {{-- Increment the signed counter if the reviewer has signed --}}
                                                                @if (!is_null($change->{'reviewer_signtime' . $i}))
                                                                    @php $totalSigned++; @endphp
                                                                @endif
                                                            @endif
                                                        @endif
                                                    @endfor

                                                    {{-- Check if the current user has not taken action --}}
                                                    @if (!$actionTaken)
                                                        {{-- Display "Pending" if not all reviewers have signed --}}
                                                        @if ($totalSigned > 0 && $totalSigned != $totalReviewers)
                                                            Partially Approved
                                                        @elseif ($totalSigned != $totalReviewers)
                                                            Pending
                                                        @else
                                                            {{-- Display "Reviewed" if all reviewers have signed --}}
                                                            Reviewed
                                                        @endif
                                                    @endif
                                                @elseif ($change->classification === 'Minor')
                                                    Not Applicable
                                                @else
                                                    Pending
                                                @endif
                                            </td>



                                            <td class="align-middle text-center text-sm">
                                                @if (is_null($change->verifier_name))
                                                    Pending
                                                @elseif (!is_null($change->verifier_name) && is_null($change->approver_name))
                                                    @if (is_null($change->classification))
                                                        Pending
                                                    @elseif ($change->classification === 'Minor')
                                                        <a href="{{ route('director.ccm.approve', $change->id) }}"
                                                            class="btn bg-gradient-info btn-sm mb-0 ms-1 me-1"
                                                            role="button" aria-pressed="true">Approve</a>
                                                    @elseif ($change->classification === 'Major')
                                                        @php
                                                            // Initialize counters
                                                            $totalReviewers = 0; // Number of valid reviewers
                                                            $totalSigned = 0; // Number of signed reviewers
                                                        @endphp

                                                        {{-- Loop through the reviewers (1 to 3) --}}
                                                        @for ($i = 1; $i <= 3; $i++)
                                                            @if (!is_null($change->{'reviewer_name' . $i}))
                                                                @php $totalReviewers++; @endphp

                                                                {{-- Check if the reviewer has signed --}}
                                                                @if (!is_null($change->{'reviewer_signtime' . $i}))
                                                                    @php $totalSigned++; @endphp
                                                                @endif
                                                            @endif
                                                        @endfor

                                                        {{-- Determine if the "Approve" button should be displayed --}}
                                                        @if ($totalReviewers > 0 && $totalSigned === $totalReviewers)
                                                            <a href="{{ route('director.ccm.approve', $change->id) }}"
                                                                class="btn bg-gradient-info btn-sm mb-0 ms-1 me-1"
                                                                role="button" aria-pressed="true">Approve</a>
                                                        @else
                                                            Pending
                                                        @endif
                                                    @endif
                                                @else
                                                    {{ $change->approver_name }}
                                                @endif
                                            </td>




                                            <td class="align-middle text-center text-sm">
                                                @if (is_null($change->approver_name))
                                                    Pending
                                                @elseif(!is_null($change->approver_name) && is_null($change->closer_name))
                                                    Pending
                                                    {{-- <a href="{{ route('qa.ccm.close', $change->id) }}"
                                                        class="btn bg-gradient-info btn-sm mb-0 ms-1 me-1 " role="button"
                                                        aria-pressed="true">Close</a> --}}
                                                @else
                                                    {{ $change->closer_name }}
                                                @endif
                                            </td>

                                            <td>
                                                <div class="d-flex justify-content-center align-items-center">
                                                    <div>
                                                        @if (!is_null($change->closer_signtime))
                                                            <a href="{{ route('director.ccm.download', $change->id) }}"
                                                                class="btn bg-gradient-success btn-sm mb-0 ms-1 me-1 "
                                                                role="button" aria-pressed="true">Download</a>
                                                        @endif
                                                    </div>
                                                    <div>
                                                        <a href="{{ route('director.ccm.print', $change->id) }}"
                                                            target="_blank"
                                                            class="btn bg-gradient-secondary btn-sm mb-0 ms-1 me-1 "
                                                            role="button" aria-pressed="true">View</a>
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
