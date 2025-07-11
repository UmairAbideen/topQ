@extends('qa.layout.app')

@section('title')
    Management Review Agenda
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
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 my-0 z-index-2">
                        <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                            <h6 class="text-white text-capitalize ps-3">Add Management Review Agenda</h6>
                        </div>

                        <div class="d-flex justify-content-end pe-0 pt-4">
                            <a href="{{ route('qa.mrm.agenda.view') }}" class="btn bg-gradient-info" role="button"
                                aria-pressed="true">Go
                                Back</a>
                        </div>

                        <form class='px-3' action="{{ route('qa.mrm.agenda.create') }}" method="post">
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
                                <div class="col-md-3 px-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label>Meeting Date</label>
                                        <input type="date" name="meeting_date" class="form-control"
                                            value="{{ old('meeting_date') }}">
                                        @error('meeting_date')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3 px-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label>Review Period</label>
                                        <input type="text" name="review_period" class="form-control"
                                            value="{{ old('review_period') }}" placeholder="Jan'24 - Jun'24">
                                        @error('review_period')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-3 px-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label>Start Time</label>
                                        <input type="time" name="start_time" class="form-control"
                                            value="{{ old('start_time') }}">
                                        @error('start_time')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-3 px-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label>End Time</label>
                                        <input type="time" name="end_time" class="form-control"
                                            value="{{ old('end_time') }}">
                                        @error('end_time')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-3 px-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label>Venue</label>
                                        <input type="text" name="venue" class="form-control"
                                            value="{{ old('venue') }}">
                                        @error('venue')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <hr>

                                <div class="col-md-6 px-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label>Review Item # 1</label>
                                        <textarea name="review_item1" rows="1" cols="50" class="form-control">{{ old('review_item1') }}</textarea>
                                        @error('review_item1')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 px-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label>Review Item # 2</label>
                                        <textarea name="review_item2" rows="1" cols="50" class="form-control">{{ old('review_item2') }}</textarea>
                                        @error('review_item2')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 px-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label>Review Item # 3</label>
                                        <textarea name="review_item3" rows="1" cols="50" class="form-control">{{ old('review_item3') }}</textarea>
                                        @error('review_item3')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 px-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label>Review Item # 4</label>
                                        <textarea name="review_item4" rows="1" cols="50" class="form-control">{{ old('review_item4') }}</textarea>
                                        @error('review_item4')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 px-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label>Review Item # 5</label>
                                        <textarea name="review_item5" rows="1" cols="50" class="form-control">{{ old('review_item5') }}</textarea>
                                        @error('review_item5')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 px-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label>Review Item # 6</label>
                                        <textarea name="review_item6" rows="1" cols="50" class="form-control">{{ old('review_item6') }}</textarea>
                                        @error('review_item6')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 px-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label>Review Item # 7</label>
                                        <textarea name="review_item7" rows="1" cols="50" class="form-control">{{ old('review_item7') }}</textarea>
                                        @error('review_item7')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 px-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label>Review Item # 8</label>
                                        <textarea name="review_item8" rows="1" cols="50" class="form-control">{{ old('review_item8') }}</textarea>
                                        @error('review_item8')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 px-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label>Review Item # 9</label>
                                        <textarea name="review_item9" rows="1" cols="50" class="form-control">{{ old('review_item9') }}</textarea>
                                        @error('review_item9')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 px-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label>Review Item # 10</label>
                                        <textarea name="review_item10" rows="1" cols="50" class="form-control">{{ old('review_item10') }}</textarea>
                                        @error('review_item10')
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
