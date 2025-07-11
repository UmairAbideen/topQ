@extends('qa.layout.app')

@section('title')
    Internal Audit
@endsection

@section('page-name')
    Internal Audit
@endsection

@section('active-link-ia')
    active bg-gradient-primary
@endsection

@section('main-content')
    <div class="container-fluid py-2">
        <div class="row">
            <div class="col-12">

                <div class="d-flex justify-content-center">
                    <div class="p-2">
                        <a href="{{ route('qa.ia.schedule.view') }}" class="btn btn-outline-secondary btn-sm" role="button"
                            aria-pressed="true">
                            Schedule</a>
                    </div>
                    <div class="p-2">
                        <a href="{{ route('qa.ia.report.view') }}" class="btn bg-gradient-primary btn-sm" role="button"
                            aria-pressed="true">
                            Report</a>
                    </div>
                </div>

                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 my-0 z-index-2">
                        <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                            <h6 class="text-white text-capitalize ps-3">Internal Audit Report</h6>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end pe-3 pt-4">
                        <a href="{{ route('qa.ia.report.form') }}" class="btn bg-gradient-info" role="button"
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
                                        <th rowspan=2
                                            class=" text-center text-secondary small font-weight-bolder opacity-9">
                                            S. No.</th>
                                        <th rowspan=2
                                            class="text-center text-secondary small font-weight-bolder opacity-9 ps-2">
                                            Document Date</th>
                                        <th rowspan=2
                                            class=" text-center text-secondary small font-weight-bolder opacity-9">
                                            Report Number</th>
                                        <th rowspan=2 class="text-center text-secondary small font-weight-bolder opacity-9">
                                            Internal Auditor<small>(s)</small></th>
                                        <th rowspan=2 class="text-center text-secondary small font-weight-bolder opacity-9">
                                            Prepared By</th>
                                        <th rowspan=2 class="text-center text-secondary small font-weight-bolder opacity-9">
                                            Approved By</th>
                                        <th rowspan=2 class="text-center text-secondary small font-weight-bolder opacity-9">
                                            Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($reports as $report)
                                        <tr>
                                            <td class="align-middle text-center text-sm">
                                                {{ $loop->iteration }}
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                {{ $report->doc_date }}
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                {{ $report->report_no }}
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                {{ $report->internal_auditor1 }}<br>
                                                {{ $report->internal_auditor1 }}
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                @if (is_null($report->prepared_by))
                                                    <a href="{{ route('qa.ia.report.prepare', $report->id) }}"
                                                        class="btn bg-gradient-info btn-sm mb-0 ms-1 me-1 " role="button"
                                                        aria-pressed="true">Prepare</a>
                                                @else
                                                    {{ $report->prepared_by }}
                                                @endif
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                @if (is_null($report->approved_by))
                                                    Pending
                                                @else
                                                    {{ $report->approved_by }}
                                                @endif
                                            </td>

                                            {{-- <a href="{{ route('qa.ia.report.approve', $report->id) }}"
                                                class="btn bg-gradient-info btn-sm mb-0 ms-1 me-1 " role="button"
                                                aria-pressed="true">Approve</a> --}}

                                            <td>
                                                <div class="d-flex align-items-center">
                                                    @if ($report->approved_by)
                                                        <div>
                                                            <a href="{{ route('qa.ia.report.download', $report->id) }}"
                                                                class="btn bg-gradient-success btn-sm mb-0 ms-1 me-1 "
                                                                role="button" aria-pressed="true">Download</a>
                                                        </div>
                                                    @endif
                                                    <div>
                                                        <a href="{{ route('qa.ia.report.print', $report->id) }}"
                                                            target="_blank"
                                                            class="btn bg-gradient-secondary btn-sm mb-0 ms-1 me-1 "
                                                            role="button" aria-pressed="true">View</a>
                                                    </div>

                                                    @if (is_null($report->prepared_by))
                                                        <div>
                                                            <a href="{{ route('qa.ia.report.edit', $report->id) }}"
                                                                class="btn bg-gradient-warning btn-sm mb-0 ms-1 me-1"
                                                                role="button" aria-pressed="true">Update</a>
                                                        </div>

                                                        <div>
                                                            <button type="button"
                                                                class="btn bg-gradient-danger btn-sm mb-0 ms-1 me-1"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#modal-delete-{{ $report->id }}">Delete</button>

                                                            <div class="modal fade" id="modal-delete-{{ $report->id }}"
                                                                tabindex="-1" role="dialog"
                                                                aria-labelledby="modal-delete-{{ $report->id }}"
                                                                aria-hidden="true">

                                                                <div class="modal-dialog modal-dialog-centered modal-"
                                                                    role="document">

                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h6 class="modal-title font-weight-normal"
                                                                                id="modal-title-default">Delete Internal
                                                                                Audit
                                                                                Report
                                                                            </h6>
                                                                            <button type="button"
                                                                                class="btn-close text-dark"
                                                                                data-bs-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">×</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <p>Do you want to remove the Report?</p>
                                                                        </div>
                                                                        <div class="modal-footer">

                                                                            <a href="{{ route('qa.ia.report.delete', $report->id) }}"
                                                                                class="btn bg-gradient-danger btn-sm mb-0 ms-1 me-1"
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
