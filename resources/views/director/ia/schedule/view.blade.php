@extends('director.layout.app')

@section('title')
    Internal Audit
@endsection

@section('page-name')
    Internal Audit
@endsection

@section('active-link-ia')
    active bg-gradient-primary
@endsection

@section('main-content')
    <div class="container-fluid py-2">
        <div class="row">
            <div class="col-12">

                <div class="d-flex justify-content-center">
                    <div class="p-2">
                        <a href="" class="btn bg-gradient-primary btn-sm" role="button" aria-pressed="true">
                            Schedule</a>
                    </div>
                    <div class="p-2">
                        <a href="{{ route('director.ia.report.view') }}" class="btn btn-outline-secondary btn-sm"
                            role="button" aria-pressed="true">
                            Report</a>
                    </div>
                </div>

                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 my-0 z-index-2">
                        <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                            <h6 class="text-white text-capitalize ps-3">Internal Audit Schedule</h6>
                        </div>
                    </div>

                    <div class="card-body ps-3 pe-2 pb-5 pt-5">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th rowspan=2
                                            class=" text-center text-secondary small font-weight-bolder opacity-9">
                                            S. No.</th>
                                        <th rowspan=2 class="text-center text-secondary small font-weight-bolder opacity-9">
                                            Internal Auditor<small>(s)</small></th>
                                        <th rowspan=2 class="text-center text-secondary small font-weight-bolder opacity-9">
                                            Document Date</th>
                                        <th rowspan=2 class="text-center text-secondary small font-weight-bolder opacity-9">
                                            Prepared By</th>
                                        <th rowspan=2 class="text-center text-secondary small font-weight-bolder opacity-9">
                                            Approved By</th>
                                        <th rowspan=2 class="text-center text-secondary small font-weight-bolder opacity-9">
                                            Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($schedules as $schedule)
                                        <tr>
                                            <td class="align-middle text-center text-sm">
                                                {{ $loop->iteration }}
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                {{ $schedule->internal_auditor1 }}<br>
                                                {{ $schedule->internal_auditor2 }}<br>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                {{ $schedule->doc_date }}
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                @if (is_null($schedule->prepared_by))
                                                    Pending
                                                @else
                                                    {{ $schedule->prepared_by }}
                                                @endif

                                            </td>

                                            <td class="align-middle text-center text-sm">
                                                @if (!is_null($schedule->prepared_by) && is_null($schedule->approved_by))
                                                    <a href="{{ route('director.ia.schedule.approve', $schedule->id) }}"
                                                        class="btn bg-gradient-info btn-sm mb-0 ms-1 me-1 " role="button"
                                                        aria-pressed="true">Approve</a>
                                                @elseif (is_null($schedule->prepared_by))
                                                    Pending
                                                @else
                                                    {{ $schedule->approved_by }}
                                                @endif
                                            </td>

                                            <td>
                                                <div class="d-flex justify-content-center align-items-center">
                                                    @if ($schedule->approved_by)
                                                        <div>
                                                            <a href="{{ route('director.ia.schedule.download', $schedule->id) }}"
                                                                class="btn bg-gradient-success btn-sm mb-0 ms-1 me-1 "
                                                                role="button" aria-pressed="true">Download</a>
                                                        </div>
                                                    @endif
                                                    <div>
                                                        <a href="{{ route('director.ia.schedule.print', $schedule->id) }}"
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
