@extends('manager.layout.app')

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

                <div class="d-flex justify-content-center">
                    <!-- Option-->
                    <div class="dropdown p-2">
                        <a class="btn bg-gradient-primary btn-sm" role="button" id="dropdownMenuButton"
                            href="{{ route('manager.doc-control.change.view') }}">
                            Change Request</a>
                    </div>

                    <!-- Option-->
                    <div class="dropdown p-2">
                        <a class="btn btn-outline-secondary btn-sm" role="button" id="dropdownMenuButton"
                            href="{{ route('manager.doc-control.issue.view') }}">
                            Number Issuance</a>
                    </div>

                    <!--  Option-->
                    <div class="dropdown p-2">
                        <a class="btn btn-outline-secondary btn-sm" role="button" id="dropdownMenuButton"
                            href="{{ route('manager.doc-control.obsolescence.view') }}">
                            Obsolescence</a>
                    </div>

                    <!-- Option-->
                    <div class="dropdown p-2">
                        <a class="btn btn-outline-secondary btn-sm" role="button" id="dropdownMenuButton"
                            href="{{ route('manager.doc-control.mi-internal.view') }}">
                            M.I Internal</a>
                    </div>
                </div>

                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 my-0 z-index-2">
                        <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                            <h6 class="text-white text-capitalize ps-3">Document Change Request Table</h6>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end pe-3 pt-4">
                        <a href="{{ route('manager.doc-control.change.form') }}" class="btn bg-gradient-info" role="button"
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
                                            class="text-center text-secondary small font-weight-bolder opacity-9">Change No.
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
                                        <th class="text-center text-secondary small font-weight-bolder opacity-9">Verified
                                            By</th>
                                        <th class="text-center text-secondary small font-weight-bolder opacity-9">Approved
                                            By</th>
                                        <th rowspan="2"
                                            class="text-center text-secondary small font-weight-bolder opacity-9">Actions
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($changes as $change)
                                        <tr>
                                            <td class="align-middle text-center text-sm">{{ $loop->iteration }}</td>
                                            <td class="align-middle text-center text-sm">{{ $change->change_no }}</td>
                                            <td class="align-middle text-center text-sm">{{ $change->department }}</td>
                                            <td class="align-middle text-center text-sm">{{ $change->doc_no }}</td>
                                            <td class="align-middle text-center text-sm">{{ $change->doc_name }}</td>


                                            <td class="align-middle text-center text-sm">
                                                @if (is_null($change->verifier_name))
                                                    <a href="{{ route('manager.doc-control.change.verify', $change->id) }}"
                                                        class="btn bg-gradient-info btn-sm mb-0 ms-1 me-1 " role="button"
                                                        aria-pressed="true">Verify</a>
                                                @elseif(!is_null($change->verifier_name))
                                                    {{ $change->verifier_name }}
                                                @else
                                                    Pending
                                                @endif
                                            </td>


                                            <td class="align-middle text-center text-sm">
                                                @if (!is_null($change->approver_name))
                                                    {{ $change->approver_name }}
                                                @else
                                                    Pending
                                                @endif
                                            </td>

                                            <td>
                                                <div class="d-flex justify-content-center align-items-center">
                                                    @if (!is_null($change->approver_name))
                                                        <div>
                                                            <a href="{{ route('manager.doc-control.change.download', $change->id) }}"
                                                                class="btn bg-gradient-success btn-sm mb-0 ms-1 me-1 "
                                                                role="button" aria-pressed="true">Download</a>
                                                        </div>
                                                    @endif

                                                    <div>
                                                        <a href="{{ route('manager.doc-control.change.print', $change->id) }}"
                                                            target ="_blank"
                                                            class="btn bg-gradient-secondary btn-sm mb-0 ms-1 me-1 "
                                                            role="button" aria-pressed="true">View</a>
                                                    </div>

                                                    @if (is_null($change->verifier_name))
                                                        <div>
                                                            <a href="{{ route('manager.doc-control.change.edit', $change->id) }}"
                                                                class="btn bg-gradient-warning btn-sm mb-0 ms-1 me-1"
                                                                role="button" aria-pressed="true">Update</a>
                                                        </div>

                                                        <div>
                                                            <button type="button"
                                                                class="btn bg-gradient-danger btn-sm mb-0 ms-1 me-1"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#modal-delete-{{ $change->id }}">Delete</button>

                                                            <div class="modal fade" id="modal-delete-{{ $change->id }}"
                                                                tabindex="-1" role="dialog"
                                                                aria-labelledby="modal-delete-{{ $change->id }}"
                                                                aria-hidden="true">

                                                                <div class="modal-dialog modal-dialog-centered modal-"
                                                                    role="document">

                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h6 class="modal-title font-weight-normal"
                                                                                id="modal-title-default">Change Request
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
                                                                            <p>Do you want to remove the Document?</p>
                                                                        </div>
                                                                        <div class="modal-footer">

                                                                            <a href="{{ route('manager.doc-control.change.delete', $change->id) }}"
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
