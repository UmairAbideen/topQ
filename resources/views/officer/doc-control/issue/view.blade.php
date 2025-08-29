@extends('officer.layout.app')

@section('title')
    Document Control
@endsection

@section('page-name')
    Document Control
@endsection

@section('active-link-doc')
    active bg-gradient-primary
@endsection

@section('main-content')
    <div class="container-fluid py-2">
        <div class="row">
            <div class="col-12">


                <div class="d-flex flex-wrap justify-content-center">
                    <!-- Option -->
                    <div class="p-2 w-100 w-sm-auto">
                        <a class="btn btn-outline-secondary btn-sm w-100 w-sm-auto" role="button"
                            href="{{ route('officer.doc-control.change.view') }}">
                            Change Request
                        </a>
                    </div>

                    <!-- Option -->
                    <div class="p-2 w-100 w-sm-auto">
                        <a class="btn bg-gradient-primary btn-sm w-100 w-sm-auto" role="button"
                            href="{{ route('officer.doc-control.issue.view') }}">
                            Number Issuance
                        </a>
                    </div>

                    <!-- Option -->
                    <div class="p-2 w-100 w-sm-auto">
                        <a class="btn btn-outline-secondary btn-sm w-100 w-sm-auto" role="button"
                            href="{{ route('officer.doc-control.obsolescence.view') }}">
                            Obsolescence
                        </a>
                    </div>

                    <!-- Option -->
                    <div class="p-2 w-100 w-sm-auto">
                        <a class="btn btn-outline-secondary btn-sm w-100 w-sm-auto" role="button"
                            href="{{ route('officer.doc-control.mi-internal.view') }}">
                            M.I Internal
                        </a>
                    </div>
                </div>


                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 my-0 z-index-2">
                        <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                            <h6 class="text-white text-capitalize ps-3">Document Number Issuance Table</h6>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end pe-3 pt-4">
                        <a href="{{ route('officer.doc-control.issue.form') }}" class="btn bg-gradient-info" role="button"
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
                                            class="text-center text-secondary small font-weight-bolder opacity-9">S. No.
                                        </th>
                                        <th rowspan="2"
                                            class="text-center text-secondary small font-weight-bolder opacity-9">Department
                                        </th>
                                        <th rowspan="2"
                                            class="text-center text-secondary small font-weight-bolder opacity-9">Document
                                            No.</th>
                                        <th rowspan="2"
                                            class="text-center text-secondary small font-weight-bolder opacity-9">Document
                                            Name</th>
                                        <th colspan="3"
                                            class="text-center text-secondary small font-weight-bolder opacity-9">Approvals
                                        </th>
                                        <th rowspan="2"
                                            class="text-center text-secondary small font-weight-bolder opacity-9">Actions
                                        </th>
                                    </tr>

                                    <tr>
                                        <th class="text-center text-secondary small font-weight-bolder opacity-9">Verified
                                            By
                                        </th>
                                        <th class="text-center text-secondary small font-weight-bolder opacity-9">Reviewed
                                            By
                                        </th>
                                        <th class="text-center text-secondary small font-weight-bolder opacity-9">Approved
                                            By
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($issues as $issue)
                                        <tr>
                                            <td class="align-middle text-center text-sm">{{ $loop->iteration }}</td>
                                            <td class="align-middle text-center text-sm">{{ $issue->department }}</td>
                                            <td class="align-middle text-center text-sm">{{ $issue->doc_no }}</td>
                                            <td class="align-middle text-center text-sm">{{ $issue->doc_name }}</td>

                                            <td class="align-middle text-center text-sm">
                                                @if (!is_null($issue->verifier_name))
                                                    {{ $issue->verifier_name }}
                                                @else
                                                    Pending
                                                @endif
                                            </td>

                                            <td class="align-middle text-center text-sm">
                                                @if (!is_null($issue->reviewer_name))
                                                    {{ $issue->reviewer_name }}
                                                @else
                                                    Pending
                                                @endif
                                            </td>

                                            <td class="align-middle text-center text-sm">
                                                @if (!is_null($issue->approver_name))
                                                    {{ $issue->approver_name }}
                                                @else
                                                    Pending
                                                @endif
                                            </td>

                                            <td>
                                                <div class="d-flex justify-content-center align-items-center">
                                                    @if (!is_null($issue->approver_name))
                                                        <div>
                                                            <a href="{{ route('officer.doc-control.issue.download', $issue->id) }}"
                                                                class="btn bg-gradient-success btn-sm mb-0 ms-1 me-1 "
                                                                role="button" aria-pressed="true">Download</a>
                                                        </div>
                                                    @endif

                                                    <div>
                                                        <a href="{{ route('officer.doc-control.issue.print', $issue->id) }}"
                                                            target ="_blank"
                                                            class="btn bg-gradient-secondary btn-sm mb-0 ms-1 me-1 "
                                                            role="button" aria-pressed="true">View</a>
                                                    </div>

                                                    @if (is_null($issue->verifier_name))
                                                        <div>
                                                            <a href="{{ route('officer.doc-control.issue.edit', $issue->id) }}"
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
