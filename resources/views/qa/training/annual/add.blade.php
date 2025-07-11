@extends('qa.layout.app')

@section('title')
    Annual Training Plan
@endsection

@section('page-name')
    Annual Training Plan
@endsection

@section('active-link-training')
    active bg-gradient-primary
@endsection

@section('main-content')
    <div class="container-fluid py-2">
        <div class="row">
            <div class="col-12">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 my-0 z-index-2">
                        <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                            <h6 class="text-white text-capitalize ps-3">Create Annual Plan </h6>
                        </div>

                        <div class="d-flex justify-content-end pe-0 pt-4">
                            <a href="{{ route('qa.training.plan.view') }}" class="btn bg-gradient-info" role="button"
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

                        @if (session('error'))
                            <div class="alert alert-secondary alert-dismissible text-white fade show" role="alert">
                                <small>{{ session('error') }}</small>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif

                        <form class='px-3' action="{{ route('qa.training.plan.create') }}" method="post">
                            @csrf

                            <div class="row">
                                @for ($i = 1; $i <= 20; $i++)
                                    <div class="col-md-4 px-3">
                                        <div class="input-group input-group-static mb-4">
                                            <label>Training Name {{ $i }}</label>
                                            <textarea name="training_name{{ $i }}" class="form-control" cols="1" rows="1">{{ old('training_name' . $i) }}</textarea>
                                            @error('training_name' . $i)
                                                <div class="text-danger small">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-2 px-3">
                                        <div class="input-group input-group-static mb-4">
                                            <label>Month {{ $i }}</label>
                                            <select name="month{{ $i }}" class="form-control">
                                                <option value="">Select Month</option>
                                                <option value="January"
                                                    {{ old('month' . $i) == 'January' ? 'selected' : '' }}>January</option>
                                                <option value="February"
                                                    {{ old('month' . $i) == 'February' ? 'selected' : '' }}>February
                                                </option>
                                                <option value="March"
                                                    {{ old('month' . $i) == 'March' ? 'selected' : '' }}>March</option>
                                                <option value="April"
                                                    {{ old('month' . $i) == 'April' ? 'selected' : '' }}>April</option>
                                                <option value="May" {{ old('month' . $i) == 'May' ? 'selected' : '' }}>
                                                    May</option>
                                                <option value="June" {{ old('month' . $i) == 'June' ? 'selected' : '' }}>
                                                    June</option>
                                                <option value="July" {{ old('month' . $i) == 'July' ? 'selected' : '' }}>
                                                    July</option>
                                                <option value="August"
                                                    {{ old('month' . $i) == 'August' ? 'selected' : '' }}>August</option>
                                                <option value="September"
                                                    {{ old('month' . $i) == 'September' ? 'selected' : '' }}>September
                                                </option>
                                                <option value="October"
                                                    {{ old('month' . $i) == 'October' ? 'selected' : '' }}>October</option>
                                                <option value="November"
                                                    {{ old('month' . $i) == 'November' ? 'selected' : '' }}>November
                                                </option>
                                                <option value="December"
                                                    {{ old('month' . $i) == 'December' ? 'selected' : '' }}>December
                                                </option>
                                            </select>
                                            @error('month' . $i)
                                                <div class="text-danger small">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                @endfor

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
