@extends('director.layout.app')

@section('title')
    Risk Assessment
@endsection

@section('page-name')
    Risk Assessment
@endsection

@section('active-link-risk')
    active bg-gradient-primary
@endsection

@section('main-content')
    <div class="container-fluid py-2">
        <div class="row">
            <div class="col-12">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 my-0 z-index-2">
                        <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                            <h6 class="text-white text-capitalize ps-3">Risk Assessment Table</h6>
                        </div>
                    </div>

                    <div class="card-body ps-3 pe-2 pb-5 pt-5">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th rowspan=2 class="text-center text-secondary small font-weight-bolder opacity-9">
                                            S. No.</th>
                                        <th rowspan=2 class="text-center text-secondary small font-weight-bolder opacity-9">
                                            QRE No.</th>
                                        <th rowspan=2
                                            class="text-center text-secondary small font-weight-bolder opacity-9 ps-2">
                                            Date</th>
                                        <th rowspan=2 class="text-center text-secondary small font-weight-bolder opacity-9">
                                            Department</th>
                                        <th rowspan=2 class="text-center text-secondary small font-weight-bolder opacity-9">
                                            Co-ordinator</th>
                                        <th rowspan=2 class="text-center text-secondary small font-weight-bolder opacity-9">
                                            Area</th>
                                        <th colspan=3 class="text-center text-secondary small font-weight-bolder opacity-9">
                                            Approvals</th>
                                        <th rowspan=2 class="text-center text-secondary small font-weight-bolder opacity-9">
                                            Actions</th>
                                    </tr>
                                    <tr>
                                        <th class="text-center text-secondary small font-weight-bolder opacity-9">
                                            Manager</th>
                                        <th class="text-center text-secondary small font-weight-bolder opacity-9">
                                            RA & QA</th>
                                        <th class="text-center text-secondary small font-weight-bolder opacity-9">
                                            Director</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($risks as $risk)
                                        <tr>
                                            <td class="align-middle text-center text-sm">
                                                {{ $loop->iteration }}
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                {{ $risk->qre_no }}
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                {{ \Carbon\Carbon::parse($risk->receipt_date)->format('d/M/Y') }}
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                {{ $risk->department }}
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                {{ $risk->coordinator }}
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                {{ $risk->area }}
                                            </td>

                                            {{-- Show buttons only after criticality is calcualted --}}
                                            @if ($risk->criticality_after)
                                                <td class="align-middle text-center text-sm">
                                                    {{-- Check if verified_by is empty --}}
                                                    @if (is_null($risk->verifier_signtime))
                                                        Pending
                                                    @else
                                                        {{ $risk->verifier_name }}
                                                    @endif
                                                </td>
                                                <td class="align-middle text-center text-sm">
                                                    {{-- Show Review button only if verified_by is filled and reviewed_by is null --}}
                                                    @if (is_null($risk->reviewer_signtime))
                                                        Pending
                                                    @else
                                                        {{ $risk->reviewer_name }}
                                                    @endif
                                                </td>
                                                <td class="align-middle text-center text-sm">
                                                    {{-- Show Approve button only if verified_by and reviewed_by are filled and approved_by is null --}}
                                                    @if (is_null($risk->reviewer_signtime) && is_null($risk->approver_signtime))
                                                        Pending
                                                    @elseif(!is_null($risk->reviewer_signtime) && is_null($risk->approver_signtime))
                                                        <a href="{{ route('director.risk.approve', $risk->id) }}"
                                                            class="btn bg-gradient-info btn-sm mb-0 ms-1 me-1"
                                                            role="button" aria-pressed="true">Approve</a>
                                                    @else
                                                        {{ $risk->approver_name }}
                                                    @endif
                                                </td>
                                            @else
                                                <td class="align-middle text-center text-sm">
                                                    Pending
                                                </td>

                                                <td class="align-middle text-center text-sm">
                                                    Pending
                                                </td>

                                                <td class="align-middle text-center text-sm">
                                                    Pending
                                                </td>
                                            @endif

                                            <td>
                                                <div class="d-flex align-items-center justify-content-center">
                                                    @if (!is_null($risk->approver_signtime))
                                                        <div>
                                                            <a href="{{ route('director.risk.download', $risk->id) }}"
                                                                class="btn bg-gradient-success btn-sm mb-0 ms-1 me-1 "
                                                                role="button" aria-pressed="true">Download</a>
                                                        </div>
                                                    @endif

                                                    <div>
                                                        <a href="{{ route('director.risk.print', $risk->id) }}"
                                                            target ="_blank"
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
