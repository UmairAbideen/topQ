@extends('director.layout.app')

@section('title')
    Management Review Agenda
@endsection

@section('page-name')
    Management Review Meeting
@endsection

@section('active-link-mrm')
    active bg-gradient-primary
@endsection

@section('main-content')
    <div class="container-fluid py-2">
        <div class="row">
            <div class="col-12">

                <div class="d-flex justify-content-center">
                    <div class="p-2">
                        <a href="" class="btn bg-gradient-primary btn-sm" role="button" aria-pressed="true">
                            Agenda</a>
                    </div>
                </div>

                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 my-0 z-index-2">
                        <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                            <h6 class="text-white text-capitalize ps-3">Management Review Agenda</h6>
                        </div>
                    </div>

                    <div class="card-body ps-3 pe-2 pb-5 pt-5">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class=" text-center text-secondary small font-weight-bolder opacity-9">
                                            S. No.
                                        </th>
                                        <th class="text-center text-secondary small font-weight-bolder opacity-9">
                                            Meeting No.</th>
                                        <th class="text-center text-secondary small font-weight-bolder opacity-9 ps-2">
                                            Meeting Date</th>
                                        <th class="text-center text-secondary small font-weight-bolder opacity-9">
                                            Review Period</th>
                                        <th class="text-center text-secondary small font-weight-bolder opacity-9">
                                            Prepared By</th>
                                        <th class="text-center text-secondary small font-weight-bolder opacity-9">
                                            Approved By</th>
                                        <th class="text-center text-secondary small font-weight-bolder opacity-9">
                                            Actions</th>
                                        <th class="text-center text-secondary small font-weight-bolder opacity-9">
                                            Minutes</th>
                                        <th class="text-center text-secondary small font-weight-bolder opacity-9">
                                            Attendance</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($agendas as $agenda)
                                        <tr>
                                            <td class="align-middle text-center text-sm">
                                                {{ $loop->iteration }}
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                {{ $agenda->meeting_no }}
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                {{ \Carbon\Carbon::parse($agenda->meeting_date)->format('d/M/Y') }}
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                {{ $agenda->review_period }}
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                @if ($agenda->prepared_by == '')
                                                    Pending
                                                @else
                                                    {{ $agenda->prepared_by }}
                                                @endif
                                            </td>

                                            <td class="align-middle text-center text-sm">
                                                @if (is_null($agenda->prepared_by) && is_null($agenda->approved_by))
                                                    Pending
                                                @elseif(!is_null($agenda->prepared_by) && is_null($agenda->approved_by))
                                                    <a href="{{ route('director.mrm.agenda.approve', $agenda->id) }}"
                                                        class="btn bg-gradient-info btn-sm mb-0 ms-1 me-1 " role="button"
                                                        aria-pressed="true">Approve</a>
                                                @else
                                                    {{ $agenda->approved_by }}
                                                @endif
                                            </td>

                                            <td>
                                                <div class="d-flex align-items-center justify-content-center">
                                                    @if (!is_null($agenda->approved_by))
                                                        <div>
                                                            <a href="{{ route('director.mrm.agenda.download', $agenda->id) }}"
                                                                class="btn bg-gradient-success btn-sm mb-0 ms-1 me-1 "
                                                                role="button" aria-pressed="true">Download</a>
                                                        </div>
                                                    @endif
                                                    <div>
                                                        <a href="{{ route('director.mrm.agenda.print', $agenda->id) }}"
                                                            target="_blank"
                                                            class="btn bg-gradient-secondary btn-sm mb-0 ms-1 me-1"
                                                            role="button" aria-pressed="true">View</a>
                                                    </div>
                                                </div>
                                            </td>

                                            <td class="align-middle text-center text-sm">
                                                <div class="p-2">
                                                    <a href="{{ route('director.mrm.minutes.view', $agenda->id) }}"
                                                        class="btn bg-gradient-secondary btn-sm mb-0 ms-1 me-1" role="button"
                                                        aria-pressed="true">
                                                        View</a>
                                                </div>
                                            </td>

                                            <td class="align-middle text-center text-sm">
                                                <div class="p-2">
                                                    <a href="{{ route('director.mrm.attendance.view', $agenda->id) }}"
                                                        class="btn bg-gradient-secondary btn-sm mb-0 ms-1 me-1" role="button"
                                                        aria-pressed="true">
                                                        View</a>
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


