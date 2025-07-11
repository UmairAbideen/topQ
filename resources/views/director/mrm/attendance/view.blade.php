@extends('director.layout.app')

@section('title')
    Management Review Attendance
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
                        <a href="{{ route('director.mrm.agenda.view') }}" class="btn btn-outline-secondary btn-sm"
                            role="button" aria-pressed="true">
                            Agenda</a>
                    </div>
                </div>

                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 my-0 z-index-2">
                        <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                            <h6 class="text-white text-capitalize ps-3">Management Review Attendance</h6>
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
                                            Meeting No.</th>
                                        <th class="text-center text-secondary small font-weight-bolder opacity-9">
                                            Signature</th>
                                        <th class="text-center text-secondary small font-weight-bolder opacity-9">
                                            Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (!empty($agenda->attendance))
                                        <tr>
                                            <td class="align-middle text-center text-sm">
                                                {{ $agenda->meeting_no }}
                                            </td>

                                            <td class="align-middle text-center text-sm">
                                                @php
                                                    $statusShown = false; // Track if any status (Sign, Signed, Pending) has been shown
                                                @endphp

                                                {{-- Ensure attendance is not null --}}
                                                @if ($agenda->attendance)
                                                    @for ($i = 1; $i <= 8; $i++)
                                                        {{-- Check if the authenticated user's name matches any name$i --}}
                                                        @if ($agenda->attendance->{"name$i"} == Auth::user()->username)
                                                            {{-- If user's name exists and signature is not done, show button --}}
                                                            @if (is_null($agenda->attendance->{"signature$i"}))
                                                                <a href="{{ route('director.mrm.attendance.sign', $agenda->attendance->id) }}"
                                                                    class="btn bg-gradient-info btn-sm mb-0 ms-1 me-1"
                                                                    role="button" aria-pressed="true">Sign</a>
                                                                @php $statusShown = true; @endphp
                                                            @else
                                                                Signed
                                                                @php $statusShown = true; @endphp
                                                            @endif
                                                            {{-- Exit the loop once we find the matching user --}}
                                                        @break
                                                    @endif
                                                @endfor

                                                {{-- Show "Pending" if no status has been shown and there are missing signatures --}}
                                                @if (!$statusShown)
                                                    @for ($i = 1; $i <= 8; $i++)
                                                        @if (is_null($agenda->attendance->{"signature$i"}))
                                                            Pending
                                                            @php $statusShown = true; @endphp
                                                        @break
                                                    @endif
                                                @endfor
                                            @endif
                                        @else
                                            No Attendance Data Available
                                        @endif
                                    </td>


                                    <td>
                                        <div class="d-flex justify-content-center align-items-center">
                                            <div class="d-flex justify-content-center align-items-center">
                                                <a href="{{ route('director.mrm.attendance.download', $agenda->attendance->id) }}"
                                                    class="btn bg-gradient-success btn-sm mb-0 ms-1 me-1 "
                                                    role="button" aria-pressed="true">Download</a>
                                            </div>
                                            <div>
                                                <a href="{{ route('director.mrm.attendance.print', $agenda->attendance->id) }}"
                                                    target="_blank"
                                                    class="btn bg-gradient-secondary btn-sm mb-0 ms-1 me-1 "
                                                    role="button" aria-pressed="true">View</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @else
                                <td colspan="4" class="align-middle text-center text-sm">
                                    No record available
                                </td>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
