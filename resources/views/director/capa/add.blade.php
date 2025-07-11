@extends('qa.layout.app')

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
                            <h6 class="text-white text-capitalize ps-3">Add New Deviation</h6>
                        </div>

                        <div class="d-flex justify-content-end pe-0 pt-4">
                            <a href="{{ route('qa.capa.view') }}" class="btn bg-gradient-info" role="button"
                                aria-pressed="true">Go
                                Back</a>
                        </div>

                        <form class='px-3' action="{{ route('qa.capa.create') }}" method="post">
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
                               <p class="ps-3 pt-5 pb-2"><b>CAPA Details</b></p>

                                <div class="col-md-3 px-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label>CAPA Source</label>
                                        <select class="form-control ps-1" name="source">
                                            <option selected disabled>--- Select option ---</option>
                                            <option value="Product Complaint">Product Complaint</option>
                                            <option value="Deviation">Deviation</option>
                                            <option value="Quality Audit">Quality Audit</option>
                                            <option value="Quality Inspection">Quality Inspection</option>
                                            <option value="Product Recall">Product Recall</option>
                                            <option value="Regulatory Inspection">Regulatory Inspection</option>
                                        </select>
                                        @error('source')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 px-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label>Description of Non-conformity</label>
                                        <input type="text" name="description" class="form-control">
                                        @error('description')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                {{-- <p class="ps-3 pt-5 pb-2"><b>CAPA Implementation Plan</b> (By Department)</p>

                                @for ($i = 1; $i <= 10; $i++)
                                    <div class="col-md-6 px-3">
                                        <div class="input-group input-group-static mb-4">
                                            <label>Action {{ $i }}</label>
                                            <textarea name="action{{ $i }}" class="form-control" cols="1" rows="1"></textarea>
                                            @error('action' . $i)
                                                <div class="text-danger small">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-2 px-3">
                                        <div class="input-group input-group-static mb-4">
                                            <label>Responsible {{ $i }}</label>
                                            <input type="text" name="responsible{{ $i }}"
                                                class="form-control">
                                            @error('responsible' . $i)
                                                <div class="text-danger small">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-2 px-3">
                                        <div class="input-group input-group-static mb-4">
                                            <label>Due Date {{ $i }}</label>
                                            <input type="date" name="due_date{{ $i }}" class="form-control">
                                            @error('due_date' . $i)
                                                <div class="text-danger small">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-2 px-3">
                                        <div class="input-group input-group-static mb-4">
                                            <label>Implementation Date {{ $i }}</label>
                                            <input type="date" name="implementation_date{{ $i }}"
                                                class="form-control">
                                            @error('implementation_date' . $i)
                                                <div class="text-danger small">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                @endfor

                                <p class="ps-3 pt-5 pb-2"><b>Effectiveness Evaluation</b> (By QA)</p>

                                <div class="col-md-6 px-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label>Effectiveness</label>
                                        <input type="text" name="effectiveness" class="form-control">
                                        @error('effectiveness')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div> --}}

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
