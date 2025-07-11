@extends('director.layout.app')

@section('title')
    CAPA
@endsection

@section('page-name')
    CAPA
@endsection

@section('active-link-capa')
    active bg-gradient-primary
@endsection

@section('main-content')
    <div class="container-fluid py-2">
        <div class="row">
            <div class="col-12">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 my-0 z-index-2">
                        <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                            <h6 class="text-white text-capitalize ps-3">CAPA Log</h6>
                        </div>
                    </div>

                    @if (session('status'))
                        <div class="px-3 pt-5">
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
                                        <th rowspan=2 class="text-center text-secondary small font-weight-bolder opacity-9">
                                            S. No.
                                        </th>
                                        <th rowspan=2 class="text-center text-secondary small font-weight-bolder opacity-9">
                                            CAPA No.
                                        </th>
                                        <th rowspan=2 class="text-center text-secondary small font-weight-bolder opacity-9">
                                            Initiation Date
                                        </th>
                                        <th rowspan=2 class="text-center text-secondary small font-weight-bolder opacity-9">
                                            Department
                                        </th>
                                        <th rowspan=2 class="text-center text-secondary small font-weight-bolder opacity-9">
                                            CAPA Source
                                        </th>
                                        <th colspan=3 class="text-center text-secondary small font-weight-bolder opacity-9">
                                            Approvals
                                        </th>
                                        <th colspan=2 class="text-center text-secondary small font-weight-bolder opacity-9">
                                            CAPA Implementation Plan
                                        </th>
                                        <th colspan=2 class="text-center text-secondary small font-weight-bolder opacity-9">
                                            Close-out (By QA)
                                        </th>
                                        <th rowspan=2 class="text-center text-secondary small font-weight-bolder opacity-9">
                                            Actions
                                        </th>
                                    </tr>
                                    <tr>
                                        <th class="text-center text-secondary small font-weight-bolder opacity-9">
                                            Initiator
                                        </th>
                                        <th class="text-center text-secondary small font-weight-bolder opacity-9">
                                            Manager
                                        </th>
                                        <th class="text-center text-secondary small font-weight-bolder opacity-9">
                                            QA
                                        </th>
                                        <th class="text-center text-secondary small font-weight-bolder opacity-9">
                                            Identified<br>(By Department)
                                        </th>
                                        <th class="text-center text-secondary small font-weight-bolder opacity-9">
                                            Approval<br>(By QA)
                                        </th>
                                        <th class="text-center text-secondary small font-weight-bolder opacity-9">
                                            Effectiveness<br>Evaluated
                                        </th>
                                        <th class="text-center text-secondary small font-weight-bolder opacity-9">
                                            Closure
                                        </th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($capas as $capa)
                                        <tr>
                                            <td class="align-middle text-center text-sm">
                                                {{ $loop->iteration }}
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                {{ $capa->capa_no }}
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                {{ $capa->initiation_date }}
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                {{ $capa->department }}
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                {{ $capa->source }}
                                            </td>

                                            <td class="align-middle text-center text-sm">
                                                @if (!is_null($capa->initiator_signtime))
                                                    {{ $capa->initiator_name }}
                                                @else
                                                    Pending
                                                @endif
                                            </td>

                                            <td class="align-middle text-center text-sm">

                                                @if (!is_null($capa->initiator_signtime))
                                                    @if (is_null($capa->verifier_signtime))
                                                        @if ($capa->department === 'QA')
                                                            <a href="{{ route('director.capa.verify', $capa->id) }}"
                                                                class="btn bg-gradient-info btn-sm mb-0 ms-1 me-1 "
                                                                role="button" aria-pressed="true">Verify</a>
                                                        @else
                                                            Pending
                                                        @endif
                                                    @elseif(!is_null($capa->verifier_signtime))
                                                        {{ $capa->verifier_name }}
                                                    @endif
                                                @else
                                                    Pending
                                                @endif
                                            </td>

                                            <td class="align-middle text-center text-sm">
                                                @if($capa->department === 'QA')
                                                    Not Required
                                                @elseif (!is_null($capa->reviewer_signtime))
                                                    {{ $capa->reviewer_name }}
                                                @else
                                                    Pending
                                                @endif
                                            </td>

                                            <td class="align-middle text-center text-sm">
                                                @if (!is_null($capa->action1))
                                                    Yes
                                                @else
                                                    Pending
                                                @endif
                                            </td>


                                            <td class="align-middle text-center text-sm">
                                                @if (!is_null($capa->approver_signtime))
                                                    {{ $capa->approver_name }}
                                                @else
                                                    Pending
                                                @endif
                                            </td>

                                            <td class="align-middle text-center text-sm">
                                                @if (!is_null($capa->effectiveness))
                                                    Yes
                                                @else
                                                    Pending
                                                @endif
                                            </td>


                                            <td class="align-middle text-center text-sm">
                                                @if (!is_null($capa->closer_signtime))
                                                    {{ $capa->closer_name }}
                                                @else
                                                    Pending
                                                @endif
                                            </td>


                                            <td>
                                                <div class="d-flex justify-content-center align-items-center">
                                                    @if (!is_null($capa->closer_signtime))
                                                        <div>
                                                            <a href="{{ route('director.capa.download', $capa->id) }}"
                                                                class="btn bg-gradient-success btn-sm mb-0 ms-1 me-1 "
                                                                role="button" aria-pressed="true">Download</a>
                                                        </div>
                                                    @endif

                                                    <div>
                                                        <a href="{{ route('director.capa.print', $capa->id) }}" target ="_blank"
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
