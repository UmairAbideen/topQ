@extends('qa.layout.app')

@section('title')
    Customer Feedback
@endsection

@section('page-name')
    Customer Feedback
@endsection

@section('active-link-feedback')
    active bg-gradient-primary
@endsection

@section('main-content')
    <div class="container-fluid py-2">
        <div class="row">
            <div class="col-12">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 my-0 z-index-2">
                        <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                            <h6 class="text-white text-capitalize ps-3">Customer Feedback Table</h6>
                        </div>
                    </div>


                    <div class="d-flex ms-2 pt-2">
                        <div class="p-2 pe-3 pt-3 ms-auto">
                            <a href="{{ route('qa.feedback.export.excel') }}" class="btn bg-gradient-info" role="button"
                                aria-pressed="true">
                                Export to Excel
                            </a>
                        </div>
                    </div>

                    {{-- <div class="d-flex justify-content-end pe-3 pt-4">
                        <a href="{{ route('qa.feedback.form') }}" class="btn bg-gradient-info" role="button"
                            aria-pressed="true">+
                            Add New</a>
                    </div> --}}

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


                    <div class="card-body ps-3 pe-2 pb-4 pt-1">
                        <div class="table-responsive p-0">
                            <table class="table justify-content-center align-items-center mb-0" id="myTable">
                                <thead>
                                    <tr>
                                        <th class="text-center text-secondary small font-weight-bolder opacity-9">
                                            S. No.</th>
                                        <th class="text-center text-secondary small font-weight-bolder opacity-9">
                                            Name</th>
                                        <th class="text-center text-secondary small font-weight-bolder opacity-9 ps-2">
                                            Designation</th>
                                        <th class="text-center text-secondary small font-weight-bolder opacity-9">
                                            Organization</th>
                                        <th class="text-center text-secondary small font-weight-bolder opacity-9">
                                            Email</th>
                                        <th class="text-center text-secondary small font-weight-bolder opacity-9">
                                            Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($feedbacks as $feedback)
                                        <tr>
                                            <td class="align-middle text-center text-sm">
                                                {{ $loop->iteration }}
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                {{ $feedback->name }}
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                {{ $feedback->designation }}
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                {{ $feedback->organization }}
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                {{ $feedback->email }}
                                            </td>
                                            <td>
                                                <div class="d-flex justify-content-center align-items-center">
                                                    <div>
                                                        <a href="{{ route('qa.feedback.download', $feedback->id) }}"
                                                            class="btn bg-gradient-success btn-sm mb-0 ms-1 me-1 "
                                                            role="button" aria-pressed="true">Download</a>
                                                    </div>
                                                    <div>
                                                        <a href="{{ route('qa.feedback.print', $feedback->id) }}"
                                                            target="_blank"
                                                            class="btn bg-gradient-secondary btn-sm mb-0 ms-1 me-1 "
                                                            role="button" aria-pressed="true">Print</a>
                                                    </div>
                                                    {{-- <div>
                                                        <a href="" class="btn bg-gradient-warning btn-sm mb-0 ms-1 me-1"
                                                            role="button" aria-pressed="true">Update</a>
                                                    </div> --}}

                                                    <div>
                                                        <button type="button"
                                                            class="btn bg-gradient-danger btn-sm mb-0 ms-1 me-1"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#modal-delete-{{ $feedback->id }}">Delete</button>

                                                        <div class="modal fade" id="modal-delete-{{ $feedback->id }}"
                                                            tabindex="-1" role="dialog"
                                                            aria-labelledby="modal-delete-{{ $feedback->id }}"
                                                            aria-hidden="true">

                                                            <div class="modal-dialog modal-dialog-centered modal-"
                                                                role="document">

                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h6 class="modal-title font-weight-normal"
                                                                            id="modal-title-default">Feedback
                                                                            Deletion
                                                                        </h6>
                                                                        <button type="button" class="btn-close text-dark"
                                                                            data-bs-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">×</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <p>Do you want to remove the Customer Feedback?</p>
                                                                    </div>
                                                                    <div class="modal-footer">

                                                                        <a href="{{ route('qa.feedback.delete', $feedback->id) }}"
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
        <script>
            $(document).ready(function() {
                $('#myTable').DataTable({
                    "paging": true,
                    "searching": true,
                    "ordering": true,
                    "info": true,
                    "responsive": true,
                });
            });

            $(document).ready(function() {
                var table = $('#myTable').DataTable();

                // Add Bootstrap spacing classes
                $('#myTable_length').addClass('mt-3 mb-2 ms-2'); // entries
                $('#myTable_filter').addClass('mt-3 mb-2 me-2'); // Search box
                $('#myTable_paginate').addClass('mt-3 me-2'); // Pagination
                $('#myTable_info').addClass('mt-3 ms-3'); // Info text
            });
        </script>
    </div>
@endsection
