@extends('manager.layout.app')

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
                            <h6 class="text-white text-capitalize ps-3">Update CAPA Form</h6>
                        </div>

                        <div class="d-flex justify-content-end pe-0 pt-4">
                            <a href="{{ route('manager.capa.view') }}" class="btn bg-gradient-info" role="button"
                                aria-pressed="true">Go
                                Back</a>
                        </div>

                        <form class='px-3' action="{{ route('manager.capa.update', $capa->id) }}" method="post">
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
                                <div class="row">
                                    <!------ Case 1 ----->
                                    @if (!is_null($capa->initiator_signtime) && is_null($capa->verifier_signtime))
                                        <p class="ps-3 pt-5 pb-2"><b>CAPA Details</b></p>

                                        <div class="row">
                                            <div class="col-md-4 px-3">
                                                <div class="input-group input-group-static mb-4">
                                                    <label>CAPA Source</label>
                                                    <select class="form-control ps-1" name="source">
                                                        <option selected disabled>--- Select option ---</option>
                                                        <option value="Product Complaint"
                                                            {{ old('source', $capa->source) == 'Product Complaint' ? 'selected' : '' }}>
                                                            Product Complaint</option>
                                                        <option value="Deviation"
                                                            {{ old('source', $capa->source) == 'Deviation' ? 'selected' : '' }}>
                                                            Deviation</option>
                                                        <option value="Quality Audit"
                                                            {{ old('source', $capa->source) == 'Quality Audit' ? 'selected' : '' }}>
                                                            Quality Audit</option>
                                                        <option value="Quality Inspection"
                                                            {{ old('source', $capa->source) == 'Quality Inspection' ? 'selected' : '' }}>
                                                            Quality Inspection</option>
                                                        <option value="Product Recall"
                                                            {{ old('source', $capa->source) == 'Product Recall' ? 'selected' : '' }}>
                                                            Product Recall</option>
                                                        <option value="Regulatory Inspection"
                                                            {{ old('source', $capa->source) == 'Regulatory Inspection' ? 'selected' : '' }}>
                                                            Regulatory Inspection</option>
                                                    </select>
                                                    @error('source')
                                                        <div class="text-danger small">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-8 px-3">
                                                <div class="input-group input-group-static mb-4">
                                                    <label>Description of Deviation</label>
                                                    <textarea name="description" class="form-control" cols="1" rows="1">{{ old('description', $capa->description) }}</textarea>
                                                    @error('description')
                                                        <div class="text-danger small">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <!----- Case 2 ----->
                                    @elseif (!is_null($capa->reviewer_signtime) && !is_null($capa->action1) && is_null($capa->approver_signtime))
                                        <p class="ps-3 pt-5 pb-2"><b>CAPA Implementation</b> (By Department)</p>

                                        @for ($i = 1; $i <= 10; $i++)
                                            <div class="col-md-6 px-3">
                                                <div class="input-group input-group-static mb-4">
                                                    <label>Action {{ $i }}</label>
                                                    <textarea name="action{{ $i }}" class="form-control" cols="1" rows="1">{{ old('action' . $i, $capa->{'action' . $i}) }}</textarea>
                                                    @error('action' . $i)
                                                        <div class="text-danger small">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-2 px-3">
                                                <div class="input-group input-group-static mb-4">
                                                    <label>Responsible {{ $i }}</label>
                                                    <input type="text" name="responsible{{ $i }}"
                                                        class="form-control"
                                                        value="{{ old('responsible' . $i, $capa->{'responsible' . $i}) }}">
                                                    @error('responsible' . $i)
                                                        <div class="text-danger small">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-2 px-3">
                                                <div class="input-group input-group-static mb-4">
                                                    <label>Due Date {{ $i }}</label>
                                                    <input type="date" name="due_date{{ $i }}"
                                                        class="form-control"
                                                        value="{{ old('due_date' . $i, $capa->{'due_date' . $i}) }}">
                                                    @error('due_date' . $i)
                                                        <div class="text-danger small">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-2 px-3">
                                                <div class="input-group input-group-static mb-4">
                                                    <label>Implementation Date {{ $i }}</label>
                                                    <input type="date" name="implementation_date{{ $i }}"
                                                        class="form-control"
                                                        value="{{ old('implementation_date' . $i, $capa->{'implementation_date' . $i}) }}">
                                                    @error('implementation_date' . $i)
                                                        <div class="text-danger small">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        @endfor
                                    @endif
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
