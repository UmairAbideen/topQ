@extends('director.layout.app')

@section('title')
    SC SOPs
@endsection

@section('page-name')
    SC SOPs
@endsection

@section('active-link-documents')
    active bg-gradient-primary
@endsection

@section('main-content')
    <div class="container-fluid py-2">
        <div class="row">
            <div class="col-12">

                <div class="d-flex justify-content-center">
                    <div class="p-2">
                        <a href="{{ route('director.document.policy.view') }}" class="btn btn-outline-secondary btn-sm"
                            role="button" aria-pressed="true">
                            Policy</a>
                    </div>
                    <div class="dropdown p-2">
                        <a class="btn bg-gradient-primary btn-sm" role="button" id="dropdownMenuButton"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            SOPs <i class="bi bi-caret-down-fill"></i>
                        </a>

                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <li><a class="dropdown-item" href="{{ route('director.document.sop.view') }}">Quality
                                    Assuarance</a></li>
                            <li><a class="dropdown-item" href="{{ route('director.document.sop.ts.view') }}">Technical
                                    Service</a></li>
                            <li><a class="dropdown-item bg-light" href="#">Supply Chain</a></li>
                        </ul>
                    </div>
                </div>

                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 my-0 z-index-2">
                        <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                            <h6 class="text-white text-capitalize ps-3">SC SOPs</h6>
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
                                        <th class="text-center text-secondary small font-weight-bolder opacity-9">
                                            Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($sops as $sop)
                                        <tr>
                                            <td class="align-middle text-center text-sm">
                                                {{ $loop->iteration }}
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
                                            <td>
                                                <div class="d-flex justify-content-center align-items-center">
                                                    <div class="d-flex justify-content-center align-items-center">
                                                        <a href="{{ asset($sop->pdf_file) }}"
                                                            class="btn bg-gradient-success btn-sm mb-0 ms-1 me-1 "
                                                            role="button" aria-pressed="true" download>Download</a>
                                                    </div>
                                                    <div>
                                                        <a href="{{ asset($sop->pdf_file) }}" target="_blank"
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
    </div>
@endsection
