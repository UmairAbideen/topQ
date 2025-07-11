@extends('director.layout.app')

@section('title')
    Product Recall
@endsection

@section('page-name')
    Product Recall
@endsection

@section('active-link-recall')
    active bg-gradient-primary
@endsection

@section('main-content')
    <div class="container-fluid py-2">
        <div class="row">
            <div class="col-12">

                <div class="d-flex justify-content-center">
                    <div class="p-2">
                        <a href="#" class="btn bg-gradient-primary btn-sm" role="button" aria-pressed="true">
                            Information</a>
                    </div>
                    <div class="p-2">
                        <a href="{{ route('director.closure.view') }}" class="btn btn-outline-secondary btn-sm"
                            role="button" aria-pressed="true">
                            Closure</a>
                    </div>
                </div>

                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 my-0 z-index-2">
                        <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                            <h6 class="text-white text-capitalize ps-3">Recall Log</h6>
                        </div>
                    </div>

                    <div class="card-body ps-3 pe-2 pb-5 pt-5">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-center text-secondary small font-weight-bolder opacity-9">
                                            S. No.
                                        </th>

                                        <th class=" text-center text-secondary small font-weight-bolder opacity-9">
                                            Organization
                                        </th>
                                        <th class=" text-center text-secondary small font-weight-bolder opacity-9">
                                            Receipt Date
                                        </th>
                                        <th class=" text-center text-secondary small font-weight-bolder opacity-9">
                                            Product Name
                                        </th>
                                        <th class=" text-center text-secondary small font-weight-bolder opacity-9">
                                            Reviewed By
                                        </th>
                                        <th class=" text-center text-secondary small font-weight-bolder opacity-9">
                                            Approved By
                                        </th>
                                        <th class="text-center text-secondary small font-weight-bolder opacity-9">
                                            Actions
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($recalls as $recall)
                                        <tr>
                                            <td class="align-middle text-center text-sm">
                                                {{ $loop->iteration }}
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                {{ $recall->organization }}
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                {{ $recall->receipt_date }}
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                {{ $recall->product_name }}
                                            </td>

                                            <td class="align-middle text-center text-sm">
                                                @if (is_null($recall->reviewer_signtime))
                                                    Pending
                                                @else
                                                    {{ $recall->reviewer_name }}
                                                @endif
                                            </td>

                                            <td class="align-middle text-center text-sm">
                                                @if (!is_null($recall->reviewer_signtime) && is_null($recall->approver_signtime))
                                                    <a href="{{ route('director.recall.approve', $recall->id) }}"
                                                        class="btn bg-gradient-info btn-sm mb-0 ms-1 me-1 " role="button"
                                                        aria-pressed="true">Approve</a>
                                                @elseif(is_null($recall->approver_signtime))
                                                    Pending
                                                @else
                                                    {{ $recall->approver_name }}
                                                @endif
                                            </td>

                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div>
                                                        <a href="{{ route('director.recall.info.download', $recall->id) }}"
                                                            class="btn bg-gradient-success btn-sm mb-0 ms-1 me-1 "
                                                            role="button" aria-pressed="true">Download</a>
                                                    </div>
                                                    <div>
                                                        <a href="{{ route('director.recall.info.print', $recall->id) }}"
                                                            target="_blank"
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
