@extends('director.layout.app')

@section('title')
    Management Review Minutes
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
                            <h6 class="text-white text-capitalize ps-3">Management Review Minutes</h6>
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
                                            Prepared By</th>
                                        <th class="text-center text-secondary small font-weight-bolder opacity-9">
                                            Approved By</th>
                                        <th class="text-center text-secondary small font-weight-bolder opacity-9">
                                            Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (!empty($agenda->minute))
                                        <tr>
                                            <td class="align-middle text-center text-sm">
                                                {{ $agenda->meeting_no }}
                                            </td>

                                            <td class="align-middle text-center text-sm">
                                                @if (!is_null($agenda->minute) && is_null($agenda->minute->prepared_by))
                                                    Pending
                                                @elseif (!is_null($agenda->minute))
                                                    {{ $agenda->minute->prepared_by }}
                                                @endif
                                            </td>


                                            <td class="align-middle text-center text-sm">
                                                @if (!is_null($agenda->minute->prepared_by) && is_null($agenda->minute->approved_by))
                                                    <a href="{{ route('director.mrm.minutes.approve', $agenda->minute->id) }}"
                                                        class="btn bg-gradient-info btn-sm mb-0 ms-1 me-1 " role="button"
                                                        aria-pressed="true">Approve</a>
                                                @elseif (is_null($agenda->minute->prepared_by) && is_null($agenda->minute->approved_by))
                                                    Pending
                                                @else
                                                    {{ $agenda->minute->approved_by }}
                                                @endif
                                            </td>

                                            <td>
                                                <div class="d-flex align-items-center justify-content-center">
                                                    @if (!is_null($agenda->minute))
                                                        @if (!is_null($agenda->minute->approved_by))
                                                            <div>
                                                                <a href="{{ route('director.mrm.minutes.download', $agenda->minute->id) }}"
                                                                    class="btn bg-gradient-success btn-sm mb-0 ms-1 me-1"
                                                                    role="button" aria-pressed="true">Download</a>
                                                            </div>
                                                        @endif

                                                        <div>
                                                            <a href="{{ route('director.mrm.minutes.print', $agenda->minute->id) }}"
                                                                target="_blank"
                                                                class="btn bg-gradient-secondary btn-sm mb-0 ms-1 me-1"
                                                                role="button" aria-pressed="true">View</a>
                                                        </div>
                                                    @endif
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
