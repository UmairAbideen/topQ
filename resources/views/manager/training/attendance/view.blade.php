@extends('manager.layout.app')

@section('title')
    Training Management
@endsection

@section('page-name')
    Training Management
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
                        <a class="btn bg-gradient-primary btn-sm" href="{{ route('manager.training.attendance.view') }}">
                            Attendance <i class="bi bi-caret-down-fill"></i>
                        </a>
                    </div>

                    @if (in_array(Auth::user()->department, ['TS', 'SC']))
                        <!-- Annual Option-->
                        <div class="dropdown p-2">
                            <a class="btn btn-outline-secondary btn-sm" role="button"
                                href="{{ route('manager.training.plan.view') }}">
                                Annual Plan <i class="bi bi-caret-down-fill"></i>
                            </a>
                        </div>

                        <!-- New Employee-->
                        <div class="dropdown p-2">
                            <a class="btn btn-outline-secondary btn-sm"
                                href="{{ route('manager.training.new-employee.view') }}">
                                New Employee <i class="bi bi-caret-down-fill"></i>
                            </a>

                        </div>
                    @endif
                </div>

                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 my-0 z-index-2">
                        <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                            <h6 class="text-white text-capitalize ps-3">Training Attendance</h6>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end pe-3 pt-4">
                        <a href="{{ route('manager.training.attendance.form') }}" class="btn bg-gradient-info"
                            role="button" aria-pressed="true">+
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
                            <table class="table justify-content-center align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-center text-secondary small font-weight-bolder opacity-9">
                                            S. No.</th>
                                        <th class="text-center text-secondary small font-weight-bolder opacity-9">
                                            Name</th>
                                        <th class="text-center text-secondary small font-weight-bolder opacity-9">
                                            Date</th>
                                        <th class="text-center text-secondary small font-weight-bolder opacity-9">
                                            Trainee<br>
                                            Department</th>
                                        <th class="text-center text-secondary small font-weight-bolder opacity-9">
                                            Trainer Name</th>
                                        <th class="text-center text-secondary small font-weight-bolder opacity-9">
                                            Trainer Approval</th>
                                        <th class="text-center text-secondary small font-weight-bolder opacity-9">
                                            Attendance Marked</th>
                                        <th class="text-center text-secondary small font-weight-bolder opacity-9">
                                            Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($training as $item)
                                        <tr>
                                            <td class="align-middle text-center text-sm">
                                                {{ $loop->iteration }}
                                            </td>

                                            <td class="align-middle text-center text-sm">
                                                {{ $item->training_name }}
                                            </td>

                                            <td class="align-middle text-center text-sm">
                                                {{ \Carbon\Carbon::parse($item->date)->format('d/M/Y') }}
                                            </td>

                                            <td class="align-middle text-center text-sm">
                                                {{ $item->department }}
                                            </td>

                                            <td class="align-middle text-center text-sm">
                                                {{ $item->trainer_name }}
                                            </td>

                                            <td class="align-middle text-center text-sm">
                                                @if (!is_null($item->trainer_signtime))
                                                    Approved
                                                @elseif ($username === $item->trainer_name && !is_null($item->to) && is_null($item->trainer_signtime))
                                                    <a href="{{ route('manager.training.attendance.trainersign', $item->id) }}"
                                                        class="btn bg-gradient-info btn-sm mb-0 ms-1 me-1" role="button"
                                                        aria-pressed="true">Sign</a>
                                                @else
                                                    Pending
                                                @endif
                                            </td>

                                            <td class="align-middle text-center text-sm">
                                                @php
                                                    $isHandled = false; // Flag to track if the condition is met
                                                @endphp

                                                @for ($i = 1; $i <= 10; $i++)
                                                    @php
                                                        $absence = 'absence' . $i;
                                                        $attendee_signtime = 'attendee_signtime' . $i;
                                                        $attendee_name = 'attendee_name' . $i;
                                                    @endphp

                                                    @if ($item->$attendee_name === $username)
                                                        @php $isHandled = true; @endphp

                                                        @if ($item->$absence === 'no')
                                                            @if (!is_null($item->$attendee_signtime))
                                                                Yes
                                                                @break

                                                            @elseif (!is_null($item->trainer_signtime) && is_null($item->$attendee_signtime))
                                                                <a href="{{ route('manager.training.attendance.traineesign', $item->id) }}"
                                                                    class="btn bg-gradient-info btn-sm mb-0 ms-1 me-1"
                                                                    role="button" aria-pressed="true">
                                                                    Sign
                                                                </a>
                                                                @break

                                                            @elseif (is_null($item->trainer_signtime) && is_null($item->$attendee_signtime))
                                                                Pending
                                                                @break
                                                            @endif
                                                        @else
                                                            Absent
                                                            @break

                                                        @endif
                                                    @endif
                                                @endfor

                                                @if (!$isHandled)
                                                    Not Required
                                                @endif
                                            </td>


                                            <td>
                                                <div
                                                    class="d-flex justify-content-center justify-content-center align-items-center">


                                                    @if (!is_null($item->trainer_signtime))
                                                        <div
                                                            class="d-flex justify-content-center justify-content-center align-items-center">
                                                            <a href="{{ route('manager.training.attendance.download', $item->id) }}"
                                                                class="btn bg-gradient-success btn-sm mb-0 ms-1 me-1 "
                                                                role="button" aria-pressed="true">Download</a>
                                                        </div>
                                                    @endif

                                                    <div>
                                                        <a href="{{ route('manager.training.attendance.print', $item->id) }}"
                                                            target="_blank"
                                                            class="btn bg-gradient-secondary btn-sm mb-0 ms-1 me-1 "
                                                            role="button" aria-pressed="true">View</a>
                                                    </div>

                                                    @if ($item->trainer_name === $username)
                                                        @if (is_null($item->trainer_signtime))
                                                            <div>
                                                                <a href="{{ route('manager.training.attendance.edit', $item->id) }}"
                                                                    class="btn bg-gradient-warning btn-sm mb-0 ms-1 me-1"
                                                                    role="button" aria-pressed="true">Update</a>
                                                            </div>

                                                            <div>
                                                                <button type="button"
                                                                    class="btn bg-gradient-danger btn-sm mb-0 ms-1 me-1"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#modal-delete-{{ $item->id }}">Delete</button>

                                                                <div class="modal fade"
                                                                    id="modal-delete-{{ $item->id }}" tabindex="-1"
                                                                    role="dialog"
                                                                    aria-labelledby="modal-delete-{{ $item->id }}"
                                                                    aria-hidden="true">

                                                                    <div class="modal-dialog modal-dialog-centered modal-"
                                                                        role="document">

                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h6 class="modal-title font-weight-normal"
                                                                                    id="modal-title-default">Training
                                                                                    Attendance
                                                                                </h6>
                                                                                <button type="button"
                                                                                    class="btn-close text-dark"
                                                                                    data-bs-dismiss="modal"
                                                                                    aria-label="Close">
                                                                                    <span aria-hidden="true">×</span>
                                                                                </button>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <p>Do you want to remove the Attendance?
                                                                                </p>
                                                                            </div>
                                                                            <div class="modal-footer">

                                                                                <a href="{{ route('manager.training.attendance.delete', $item->id) }}"
                                                                                    class="btn btn-danger btn-sm mb-0 ms-1 me-1"
                                                                                    role="button"
                                                                                    aria-pressed="true">Yes</a>

                                                                                <button type="button"
                                                                                    class="btn btn-light btn-sm mb-0 ms-1 me-1"
                                                                                    data-bs-dismiss="modal">No</button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endif
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
