@extends('officer.layout.app')

@section('title')
    Change Control Management
@endsection

@section('page-name')
    Change Control Management
@endsection

@section('active-link-ccm')
    active bg-gradient-primary
@endsection

@section('main-content')
    <div class="container-fluid py-2">
        <div class="row">
            <div class="col-12">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 my-0 z-index-2">
                        <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                            <h6 class="text-white text-capitalize ps-3">Add Change Request</h6>
                        </div>

                        <div class="d-flex justify-content-end pe-0 pt-4">
                            <a href="{{ route('officer.ccm.view') }}" class="btn bg-gradient-info" role="button"
                                aria-pressed="true">Go
                                Back</a>
                        </div>

                        @if (session('status'))
                            <div class="alert alert-success alert-dismissible text-white fade show" role="alert">
                                <small>{{ session('status') }}</small>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif

                        <form class='px-3' action="{{ route('officer.ccm.create') }}" method="post">
                            @csrf

                            <div class="row">
                                <p class="ps-3 pt-5 pb-2"><b>Description of Change</b></p>

                                <div class="col-md-6 px-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label>Description</label>
                                        <input type="text" name="description" class="form-control"
                                            value="{{ old('description') }}">
                                        @error('description')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 px-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label>Justification</label>
                                        <input type="text" name="justification" class="form-control"
                                            value="{{ old('justification') }}">
                                        @error('justification')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 px-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label>Area</label>
                                        <input type="text" name="area" class="form-control"
                                            value="{{ old('area') }}">
                                        @error('area')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 px-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label>Impact</label>
                                        <input type="text" name="impact" class="form-control"
                                            value="{{ old('impact') }}">
                                        @error('impact')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 px-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label>Action # 1</label>
                                        <input type="text" name="action1" class="form-control"
                                            value="{{ old('action1') }}">
                                        @error('action1')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 px-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label>Action # 2</label>
                                        <input type="text" name="action2" class="form-control"
                                            value="{{ old('action2') }}">
                                        @error('action2')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 px-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label>Action # 3</label>
                                        <input type="text" name="action3" class="form-control"
                                            value="{{ old('action3') }}">
                                        @error('action3')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 px-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label class="ms-0">Priority</label>
                                        <select class="form-control" name="priority">
                                            <option selected disabled>--- Select Priority ---</option>
                                            <option value="Low" {{ old('priority') == 'Low' ? 'selected' : '' }}>Low
                                            </option>
                                            <option value="Medium" {{ old('priority') == 'Medium' ? 'selected' : '' }}>
                                                Medium</option>
                                            <option value="High" {{ old('priority') == 'High' ? 'selected' : '' }}>High
                                            </option>
                                        </select>
                                        @error('priority')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 px-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label>Required Date</label>
                                        <input type="date" name="required_date" class="form-control"
                                            value="{{ old('required_date') }}">
                                        @error('required_date')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <p class="ps-3 pt-5 pb-2"><b>Dcouments Effected By Change</b></p>

                                <div class="col-md-6 px-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label>Document Effected Name # 1</label>
                                        <input type="text" name="effected_doc1" class="form-control"
                                            value="{{ old('effected_doc1') }}">
                                        @error('effected_doc1')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 px-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label>Document Number # 1</label>
                                        <input type="text" name="doc_no1" class="form-control"
                                            value="{{ old('doc_no1') }}">
                                        @error('doc_no1')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 px-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label>Document Effected Name # 2</label>
                                        <input type="text" name="effected_doc2" class="form-control"
                                            value="{{ old('effected_doc2') }}">
                                        @error('effected_doc2')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 px-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label>Document Number # 2</label>
                                        <input type="text" name="doc_no2" class="form-control"
                                            value="{{ old('doc_no2') }}">
                                        @error('doc_no2')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 px-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label>Document Effected Name # 3</label>
                                        <input type="text" name="effected_doc3" class="form-control"
                                            value="{{ old('effected_doc3') }}">
                                        @error('effected_doc3')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 px-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label>Document Number # 3</label>
                                        <input type="text" name="doc_no3" class="form-control"
                                            value="{{ old('doc_no3') }}">
                                        @error('doc_no3')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mt-3">
                                    <button type="submit" class="btn bg-gradient-success">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
