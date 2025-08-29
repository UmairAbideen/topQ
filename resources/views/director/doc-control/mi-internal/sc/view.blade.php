@extends('director.layout.app')

@section('title')
    Document Control
@endsection

@section('page-name')
    Document Control
@endsection

@section('active-link-doc')
    active bg-gradient-primary
@endsection

@section('main-content')
    <div class="container-fluid py-2">
        <div class="row">
            <div class="col-12">


                <div class="d-flex flex-wrap justify-content-center">
                    <!-- Option -->
                    <div class="dropdown  p-2 w-100 w-sm-auto">
                        <a class="btn btn-outline-secondary btn-sm w-100 w-sm-auto" role="button" id="dropdownMenuButton1"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Change Request <i class="bi bi-caret-down-fill"></i>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                            <li><a class="dropdown-item" href="{{ route('director.doc-control.change.view') }}">Quality
                                    Assurance</a></li>
                            <li><a class="dropdown-item" href="{{ route('director.ts.doc-control.change.view') }}">Technical
                                    Service</a></li>
                            <li><a class="dropdown-item" href="{{ route('director.sc.doc-control.change.view') }}">Supply
                                    Chain</a></li>
                        </ul>
                    </div>

                    <!-- Option -->
                    <div class="dropdown p-2 w-100 w-sm-auto">
                        <a class="btn btn-outline-secondary btn-sm w-100 w-sm-auto" role="button" id="dropdownMenuButton2"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Number Issuance <i class="bi bi-caret-down-fill"></i>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
                            <li><a class="dropdown-item" href="{{ route('director.doc-control.issue.view') }}">Quality
                                    Assuarance</a></li>
                            <li><a class="dropdown-item" href="{{ route('director.ts.doc-control.issue.view') }}">Technical
                                    Service</a></li>
                            <li><a class="dropdown-item" href="{{ route('director.sc.doc-control.issue.view') }}">Supply
                                    Chain</a></li>
                        </ul>
                    </div>

                    <!-- Option -->
                    <div class="dropdown p-2 w-100 w-sm-auto">
                        <a class="btn btn-outline-secondary btn-sm w-100 w-sm-auto" role="button" id="dropdownMenuButton3"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Obsolescence <i class="bi bi-caret-down-fill"></i>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton3">
                            <li><a class="dropdown-item"
                                    href="{{ route('director.doc-control.obsolescence.view') }}">Quality Assuarance</a></li>
                            <li><a class="dropdown-item"
                                    href="{{ route('director.ts.doc-control.obsolescence.view') }}">Technical Service</a>
                            </li>
                            <li><a class="dropdown-item"
                                    href="{{ route('director.sc.doc-control.obsolescence.view') }}">Supply Chain</a></li>
                        </ul>
                    </div>

                    <!-- Option -->
                    <div class="dropdown p-2 w-100 w-sm-auto">
                        <a class="btn bg-gradient-primary btn-sm w-100 w-sm-auto" role="button" id="dropdownMenuButton4"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            M.I Internal <i class="bi bi-caret-down-fill"></i>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton4">
                            <li><a class="dropdown-item" href="{{ route('director.doc-control.mi-internal.view') }}">Quality
                                    Assuarance</a></li>
                            <li><a class="dropdown-item"
                                    href="{{ route('director.ts.doc-control.mi-internal.view') }}">Technical Service</a>
                            </li>
                            <li><a class="dropdown-item bg-light"
                                    href="{{ route('director.sc.doc-control.mi-internal.view') }}">Supply Chain</a></li>
                        </ul>
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


                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 my-0 z-index-2">
                        <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                            <h6 class="text-white text-capitalize ps-3">Master Index - Internal Documents</h6>
                        </div>
                    </div>

                    <div class="card-body ps-3 pe-2 pb-5 pt-5">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-center text-secondary small font-weight-bolder opacity-9">
                                            S No.</th>
                                        <th class="text-center text-secondary small font-weight-bolder opacity-9">
                                            Document No.</th>
                                        <th class="text-center text-secondary small font-weight-bolder opacity-9">
                                            Name</th>
                                        <th class="text-center text-secondary small font-weight-bolder opacity-9">
                                            Effective Date</th>
                                        <th class="text-center text-secondary small font-weight-bolder opacity-9">
                                            Revision No.</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $counter = 1; @endphp
                                    {{-- Loop through SOPs --}}
                                    @foreach ($sops as $sop)
                                        <tr>
                                            <td class="align-middle text-center text-sm">
                                                {{ $counter++ }}
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                {{ $sop->doc_no }}
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                {{ $sop->doc_name }}
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                {{ $sop->eff_date }}
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                {{ $sop->revision_no }}
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
    </div>
    </div>
@endsection
