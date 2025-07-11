@extends('director.layout.app')

@section('title')
    Product Complaint
@endsection

@section('page-name')
    Product Complaint
@endsection

@section('active-link-complaint')
    active bg-gradient-primary
@endsection

@section('main-content')
    <div class="container-fluid py-2">
        <div class="row">
            <div class="col-12">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 my-0 z-index-2">
                        <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                            <h6 class="text-white text-capitalize ps-3">Complaint Table</h6>
                        </div>
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

                    <div class="card-body ps-3 pe-2 pb-5 pt-5">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0" id="myTable">
                                <thead>
                                    <tr>
                                        <th rowspan="2"
                                            class=" text-center text-secondary small font-weight-bolder opacity-9">
                                            S. No.
                                        </th>
                                        <th rowspan="2"
                                            class="text-center text-secondary small font-weight-bolder opacity-9">
                                            Complaint No.</th>
                                        <th rowspan="2"
                                            class="text-center text-secondary small font-weight-bolder opacity-9 ps-2">
                                            Date</th>
                                        <th rowspan="2"
                                            class="text-center text-secondary small font-weight-bolder opacity-9">
                                            Customer</th>
                                        <th rowspan="2"
                                            class="text-center text-secondary small font-weight-bolder opacity-9">
                                            Complaint Category</th>
                                        <th colspan="2"
                                            class="text-center text-secondary small font-weight-bolder opacity-9">
                                            Company Associate</th>
                                        <th rowspan="2"
                                            class="text-center text-secondary small font-weight-bolder opacity-9">
                                            Actions</th>
                                    </tr>
                                    <tr>
                                        <th class="text-center text-secondary small font-weight-bolder opacity-9">
                                            Name</th>
                                        <th class="text-center text-secondary small font-weight-bolder opacity-9">
                                            Email</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($complaints as $complaint)
                                        <tr>
                                            <td class="align-middle text-center text-sm">
                                                {{ $loop->iteration }}
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                {{ $complaint->complaint_no }}
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                {{ $complaint->receipt_date }}
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                {{ $complaint->customer }}
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                {{ $complaint->category }}
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                {{ $complaint->associate_name }}
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                {{ $complaint->associate_email }}
                                            </td>
                                            <td>
                                                <div class="d-flex align-items-center justify-content-center">
                                                    <div>
                                                        <a href="{{ route('director.complaint.download', $complaint->id) }}"
                                                            class="btn bg-gradient-success btn-sm mb-0 ms-1 me-1 "
                                                            role="button" aria-pressed="true">Download</a>
                                                    </div>
                                                    <div>
                                                        <a href="{{ route('director.complaint.print', $complaint->id) }}"
                                                            target="_blank"
                                                            class="btn bg-gradient-secondary btn-sm mb-0 ms-1 me-1 "
                                                            role="button" aria-pressed="true">Print</a>
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
