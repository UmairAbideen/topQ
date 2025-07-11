@extends('qa.layout.app')

@section('title')
    TS SOPs
@endsection

@section('page-name')
    TS SOPs
@endsection

@section('active-link-documents')
    active bg-gradient-primary
@endsection

@section('main-content')
    <div class="container-fluid py-2">
        <div class="row">
            <div class="col-12">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 my-0 z-index-2">
                        <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                            <h6 class="text-white text-capitalize ps-3">Update TS SOP</h6>
                        </div>

                        <div class="d-flex justify-content-end pe-0 pt-4">
                            <a href="{{ route('qa.document.sop.ts.view') }}" class="btn btn-info" role="button"
                                aria-pressed="true">Go
                                Back</a>
                        </div>

                        <form class='px-3' action="{{ route('qa.document.sop.ts.update', $sop->id) }}" method="post"
                            enctype="multipart/form-data">
                            @csrf

                            @if (session('status'))
                                <div class="alert alert-success alert-dismissible text-white fade show" role="alert">
                                    <small>{{ session('status') }}</small>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif

                            <div class="row">
                                <div class="col-md-6 px-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label>Document Number</label>
                                        <input type="text" name="doc_no" class="form-control"
                                            value="{{ old('doc_no', $sop->doc_no) }}">
                                        @error('doc_no')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 px-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label>Document Name</label>
                                        <input type="text" name="doc_name" class="form-control"
                                            value="{{ old('doc_name', $sop->doc_name) }}">
                                        @error('doc_name')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 px-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label>Revision Number</label>
                                        <input type="text" name="revision_no" class="form-control"
                                            value="{{ old('revision_no', $sop->revision_no) }}">
                                        @error('revision_no')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 px-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label>Effective Date</label>
                                        <input type="date" name="eff_date" class="form-control"
                                            value="{{ old('eff_date', $sop->eff_date) }}">
                                        @error('eff_date')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 px-3">
                                    <div class="align-self-center my-4">
                                        <label>{{ basename($sop->pdf_file) }}.pdf</label><br>
                                        <input type="file" name="pdf_file" class="btn btn-sm bg-gradient-secondary">
                                        @error('pdf_file')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="mt-3">
                                    <button type="submit" class="btn btn-success">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
