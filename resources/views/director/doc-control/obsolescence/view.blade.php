@extends('director.layout.app')

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
                    <div class="dropdown p-2 w-100 w-sm-auto">
                        <a class="btn btn-outline-secondary btn-sm w-100 w-sm-auto" role="button" id="dropdownMenuButton1"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Change Request <i class="bi bi-caret-down-fill"></i>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                            <li><a class="dropdown-item" href="{{ route('director.doc-control.change.view') }}">Quality
                                    Assurance</a></li>
                            <li><a class="dropdown-item" href="{{ route('director.ts.doc-control.change.view') }}">Technical
                                    Service</a></li>
                            <li><a class="dropdown-item" href="{{ route('director.sc.doc-control.change.view') }}">Supply
                                    Chain</a></li>
                        </ul>
                    </div>

                    <!-- Option -->
                    <div class="dropdown p-2 w-100 w-sm-auto">
                        <a class="btn btn-outline-secondary btn-sm w-100 w-sm-auto" role="button" id="dropdownMenuButton2"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Number Issuance <i class="bi bi-caret-down-fill"></i>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
                            <li><a class="dropdown-item"
                                    href="{{ route('director.doc-control.issue.view') }}">Quality
                                    Assuarance</a></li>
                            <li><a class="dropdown-item" href="{{ route('director.ts.doc-control.issue.view') }}">Technical
                                    Service</a></li>
                            <li><a class="dropdown-item" href="{{ route('director.sc.doc-control.issue.view') }}">Supply
                                    Chain</a></li>
                        </ul>
                    </div>

                    <!-- Option -->
                    <div class="dropdown p-2 w-100 w-sm-auto">
                        <a class="btn bg-gradient-primary btn-sm w-100 w-sm-auto" role="button" id="dropdownMenuButton3"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Obsolescence <i class="bi bi-caret-down-fill"></i>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton3">
                            <li><a class="dropdown-item bg-light"
                                    href="{{ route('director.doc-control.obsolescence.view') }}">Quality Assuarance</a></li>
                            <li><a class="dropdown-item"
                                    href="{{ route('director.ts.doc-control.obsolescence.view') }}">Technical Service</a>
                            </li>
                            <li><a class="dropdown-item"
                                    href="{{ route('director.sc.doc-control.obsolescence.view') }}">Supply Chain</a></li>
                        </ul>
                    </div>

                    <!-- Option -->
                    <div class="dropdown p-2 w-100 w-sm-auto">
                        <a class="btn btn-outline-secondary btn-sm w-100 w-sm-auto" role="button" id="dropdownMenuButton4"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            M.I Internal <i class="bi bi-caret-down-fill"></i>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton4">
                            <li><a class="dropdown-item" href="{{ route('director.doc-control.mi-internal.view') }}">Quality
                                    Assuarance</a></li>
                            <li><a class="dropdown-item"
                                    href="{{ route('director.ts.doc-control.mi-internal.view') }}">Technical Service</a>
                            </li>
                            <li><a class="dropdown-item"
                                    href="{{ route('director.sc.doc-control.mi-internal.view') }}">Supply Chain</a></li>
                        </ul>
                    </div>
                </div>


                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 my-0 z-index-2">
                        <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                            <h6 class="text-white text-capitalize ps-3">Document Obsolescence Table</h6>
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
                                    @foreach ($obs as $ob)
                                        <tr>
                                            <td class="align-middle text-center text-sm">{{ $loop->iteration }}</td>
                                            <td class="align-middle text-center text-sm">{{ $ob->department }}</td>
                                            <td class="align-middle text-center text-sm">{{ $ob->doc_no }}</td>
                                            <td class="align-middle text-center text-sm">{{ $ob->doc_name }}</td>

                                            <td class="align-middle text-center text-sm">
                                                @if (!is_null($ob->verifier_name))
                                                    {{ $ob->verifier_name }}
                                                @else
                                                    Pending
                                                @endif
                                            </td>


                                            <td class="align-middle text-center text-sm">
                                                @if (!is_null($ob->reviewer_name))
                                                    {{ $ob->reviewer_name }}
                                                @else
                                                    Pending
                                                @endif
                                            </td>


                                            <td class="align-middle text-center text-sm">
                                                @if (!is_null($ob->reviewer_name) && is_null($ob->approver_name))
                                                    <a href="{{ route('director.doc-control.obsolescence.approve', $ob->id) }}"
                                                        class="btn bg-gradient-info btn-sm mb-0 ms-1 me-1 " role="button"
                                                        aria-pressed="true">Approve</a>
                                                @elseif (!is_null($ob->approver_name))
                                                    {{ $ob->approver_name }}
                                                @else
                                                    Pending
                                                @endif
                                            </td>

                                            <td>
                                                <div class="d-flex justify-content-center align-items-center">
                                                    @if (!is_null($ob->approver_name))
                                                        <div>
                                                            <a href="{{ route('director.doc-control.obsolescence.download', $ob->id) }}"
                                                                class="btn bg-gradient-success btn-sm mb-0 ms-1 me-1 "
                                                                role="button" aria-pressed="true">Download</a>
                                                        </div>
                                                    @endif

                                                    <div>
                                                        <a href="{{ route('director.doc-control.obsolescence.print', $ob->id) }}"
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
