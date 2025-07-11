@extends('officer.layout.app')

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

                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 my-0 z-index-2">
                        <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                            <h6 class="text-white text-capitalize ps-3">Training Attendance</h6>
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

                    <div class="card-body ps-3 pe-2 pb-5 pt-4">
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
                                                            <a href="{{ route('officer.training.attendance.traineesign', $item->id) }}"
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
                                            <a href="{{ route('officer.training.attendance.download', $item->id) }}"
                                                class="btn bg-gradient-success btn-sm mb-0 ms-1 me-1 "
                                                role="button" aria-pressed="true">Download</a>
                                        </div>
                                    @endif

                                    <div>
                                        <a href="{{ route('officer.training.attendance.print', $item->id) }}"
                                            target="_blank"
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
