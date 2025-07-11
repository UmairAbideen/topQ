@extends('qa.layout.app')

@section('title')
    Documents
@endsection

@section('page-name')
    Documents
@endsection

@section('active-link-documents')
    active bg-gradient-primary
@endsection

@section('main-content')
    <div class="container-fluid py-2">
        <div class="row">
            <div class="col-12">

                <div class="d-flex justify-content-center">
                    <div class="p-2">
                        <a href="" class="btn bg-gradient-primary btn-sm" role="button" aria-pressed="true">
                            Policy</a>
                    </div>

                    <div class="dropdown p-2">
                        <a class="btn btn-outline-secondary btn-sm" role="button" id="dropdownMenuButton"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            SOPs <i class="bi bi-caret-down-fill"></i>
                        </a>

                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <li><a class="dropdown-item" href="{{ route('qa.document.sop.view') }}">Quality Assurance</a>
                            </li>
                            <li><a class="dropdown-item" href="{{ route('qa.document.sop.ts.view') }}">Technical Service</a>
                            </li>
                            <li><a class="dropdown-item" href="{{ route('qa.document.sop.sc.view') }}">Supply Chain</a></li>
                        </ul>
                    </div>

                </div>

                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 my-0 z-index-2">
                        <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                            <h6 class="text-white text-capitalize ps-3">Policy Documents</h6>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end pe-3 pt-4">
                        <a href="{{ route('qa.document.policy.form') }}" class="btn bg-gradient-info" role="button"
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
                                        <th class="text-center text-secondary small font-weight-bolder opacity-9">
                                            S No.</th>
                                        <th class="text-center text-secondary small font-weight-bolder opacity-9">
                                            Document No.</th>
                                        <th class="text-center text-secondary small font-weight-bolder opacity-9">
                                            Name</th>
                                        <th class="text-center text-secondary small font-weight-bolder opacity-9">
                                            Effective Date</th>
                                        <th class="text-center text-secondary small font-weight-bolder opacity-9">
                                            Revision No.</th>
                                        <th class="text-center text-secondary small font-weight-bolder opacity-9">
                                            Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($policies as $policy)
                                        <tr>
                                            <td class="align-middle text-center text-sm">
                                                {{ $loop->iteration }}
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                {{ $policy->doc_no }}
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                {{ $policy->doc_name }}
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                {{ $policy->eff_date }}
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                {{ $policy->revision_no }}
                                            </td>


                                            <td>
                                                <div class="d-flex justify-content-center align-items-center">
                                                    <div>
                                                        <a href="{{ asset($policy->pdf_file) }}"
                                                            class="btn bg-gradient-success btn-sm mb-0 ms-1 me-1 "
                                                            role="button" aria-pressed="true" download>Download</a>
                                                    </div>
                                                    <div>
                                                        <a href="{{ asset($policy->pdf_file) }}" target="_blank"
                                                            class="btn bg-gradient-secondary btn-sm mb-0 ms-1 me-1 "
                                                            role="button" aria-pressed="true">Print</a>
                                                    </div>
                                                    <div>
                                                        <a href="{{ route('qa.document.policy.edit', $policy->id) }}"
                                                            class="btn bg-gradient-warning btn-sm mb-0 ms-1 me-1"
                                                            role="button" aria-pressed="true">Update</a>
                                                    </div>

                                                    <div>
                                                        <button type="button"
                                                            class="btn bg-gradient-danger btn-sm mb-0 ms-1 me-1"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#modal-delete-{{ $policy->id }}">Delete</button>

                                                        <div class="modal fade" id="modal-delete-{{ $policy->id }}"
                                                            tabindex="-1" role="dialog"
                                                            aria-labelledby="modal-delete-{{ $policy->id }}"
                                                            aria-hidden="true">

                                                            <div class="modal-dialog modal-dialog-centered modal-"
                                                                role="document">

                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h6 class="modal-title font-weight-normal"
                                                                            id="modal-title-default">Delete Policy Document
                                                                        </h6>
                                                                        <button type="button" class="btn-close text-dark"
                                                                            data-bs-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">×</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <p>Do you want to remove the Document?</p>
                                                                    </div>
                                                                    <div class="modal-footer">

                                                                        <a href="{{ route('qa.document.policy.delete', $policy->id) }}"
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
