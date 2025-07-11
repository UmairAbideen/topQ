@extends('director.layout.app')

@section('title')
    New Employee Training Plan
@endsection

@section('page-name')
    New Employee Training Plan
@endsection

@section('active-link-training')
    active bg-gradient-primary
@endsection

@section('main-content')
    <div class="container-fluid py-2">
        <div class="row">
            <div class="col-12">

                <div class="d-flex justify-content-center">
                    <!-- Attendance Option-->
                    <div class="dropdown p-2">
                        <a class="btn btn-outline-secondary btn-sm" role="button" id="dropdownMenuButton"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Attendance <i class="bi bi-caret-down-fill"></i>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <li><a class="dropdown-item bg-light"
                                    href="{{ route('director.training.attendance.view') }}">Quality
                                    Assuarance</a></li>
                            <li><a class="dropdown-item"
                                    href="{{ route('director.ts.training.attendance.view') }}">Technical
                                    Service</a></li>
                            <li><a class="dropdown-item" href="{{ route('director.sc.training.attendance.view') }}">Supply
                                    Chain</a></li>
                        </ul>
                    </div>

                    <!-- Annual Option-->
                    <div class="dropdown p-2">
                        <a class="btn btn-outline-secondary btn-sm" role="button" id="dropdownMenuButton"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Annual Plan <i class="bi bi-caret-down-fill"></i>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <li><a class="dropdown-item bg-light" href="{{ route('director.training.plan.view') }}">Quality
                                    Assuarance</a></li>
                            <li><a class="dropdown-item" href="{{ route('director.ts.training.plan.view') }}">Technical
                                    Service</a></li>
                            <li><a class="dropdown-item" href="{{ route('director.sc.training.plan.view') }}">Supply
                                    Chain</a>
                            </li>
                        </ul>
                    </div>

                    <!-- New Employee-->
                    <div class="dropdown p-2">
                        <a class="btn bg-gradient-primary btn-sm" role="button" id="dropdownMenuButton"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            New Employee <i class="bi bi-caret-down-fill"></i>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <li><a class="dropdown-item bg-light"
                                    href="{{ route('director.training.new-employee.view') }}">Quality Assuarance</a></li>
                            <li><a class="dropdown-item"
                                    href="{{ route('director.ts.training.new-employee.view') }}">Technical
                                    Service</a></li>
                            <li><a class="dropdown-item" href="{{ route('director.sc.training.new-employee.view') }}">Supply
                                    Chain</a></li>
                        </ul>
                    </div>
                </div>

                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 my-0 z-index-2">
                        <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                            <h6 class="text-white text-capitalize ps-3">New Employee Training Plan - QA</h6>
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
                                            S. No.</th>
                                        <th class="text-center text-secondary small font-weight-bolder opacity-9">
                                            Attendee Name</th>
                                        <th class="text-center text-secondary small font-weight-bolder opacity-9">
                                            Attendee Department</th>
                                        <th class="text-center text-secondary small font-weight-bolder opacity-9">
                                            Joining Date</th>
                                        <th class="text-center text-secondary small font-weight-bolder opacity-9">
                                            Trainer Name</th>
                                        <th class="text-center text-secondary small font-weight-bolder opacity-9">
                                            Trainer Department</th>
                                        <th class="text-center text-secondary small font-weight-bolder opacity-9">
                                            Actions</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($new as $item)
                                        <tr>
                                            <td class="align-middle text-center text-sm">
                                                {{ $loop->iteration }}
                                            </td>
                                            <!-- Attendee Name -->
                                            <td class="align-middle text-center text-sm">
                                                {{ $item->attendee_name }}
                                            </td>

                                            <!-- Attendee Department -->
                                            <td class="align-middle text-center text-sm">
                                                {{ $item->attendee_department }}
                                            </td>

                                            <!-- Joining Date -->
                                            <td class="align-middle text-center text-sm">
                                                {{ \Carbon\Carbon::parse($item->joining_date)->format('d/M/Y') }}
                                            </td>

                                            <td class="align-middle text-center text-sm">
                                                {{ $item->trainer_name }}
                                            </td>

                                            <td class="align-middle text-center text-sm">
                                                {{ $item->trainer_department }}
                                            </td>

                                            <td>
                                                <div class="d-flex justify-content-center align-items-center">
                                                    <div class="d-flex justify-content-center align-items-center">
                                                        <a href="{{ route('director.training.new-employee.download', $item->id) }}"
                                                            class="btn bg-gradient-success btn-sm mb-0 ms-1 me-1 "
                                                            role="button" aria-pressed="true">Download</a>
                                                    </div>
                                                    <div>
                                                        <a href="{{ route('director.training.new-employee.print', $item->id) }}"
                                                            target="_blank"
                                                            class="btn bg-gradient-secondary btn-sm mb-0 ms-1 me-1 "
                                                            role="button" aria-pressed="true">View</a>
                                                    </div>

                                                    {{-- <div>
                                                        <a href="{{ route('qa.training.new-employee.edit', $item->id) }}"
                                                            class="btn bg-gradient-warning btn-sm mb-0 ms-1 me-1"
                                                            role="button" aria-pressed="true">Update</a>
                                                    </div>

                                                    <div>
                                                        <button type="button"
                                                            class="btn bg-gradient-danger btn-sm mb-0 ms-1 me-1"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#modal-delete-{{ $item->id }}">Delete</button>

                                                        <div class="modal fade" id="modal-delete-{{ $item->id }}"
                                                            tabindex="-1" role="dialog"
                                                            aria-labelledby="modal-delete-{{ $item->id }}"
                                                            aria-hidden="true">

                                                            <div class="modal-dialog modal-dialog-centered modal-"
                                                                role="document">

                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h6 class="modal-title font-weight-normal"
                                                                            id="modal-title-default">New Employee Training
                                                                            Plan
                                                                        </h6>
                                                                        <button type="button" class="btn-close text-dark"
                                                                            data-bs-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">×</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <p>Do you want to remove the Plan?</p>
                                                                    </div>
                                                                    <div class="modal-footer">

                                                                        <a href="{{ route('qa.training.new-employee.delete', $item->id) }}"
                                                                            class="btn btn-danger btn-sm mb-0 ms-1 me-1"
                                                                            role="button" aria-pressed="true">Yes</a>

                                                                        <button type="button"
                                                                            class="btn btn-light btn-sm mb-0 ms-1 me-1"
                                                                            data-bs-dismiss="modal">No</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div> --}}
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
