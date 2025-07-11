@extends('qa.layout.app')

@section('title')
    Users
@endsection

@section('page-name')
    User Management
@endsection

@section('active-link-users')
    active bg-gradient-primary
@endsection

@section('main-content')
    <div class="container-fluid py-2">
        <div class="row">
            <div class="col-12">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 my-0 z-index-2">
                        <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                            <h6 class="text-white text-capitalize ps-3">Update User</h6>
                        </div>

                        <div class="d-flex justify-content-end pe-0 pt-4">
                            <a href="{{ route('qa.users.view') }}" class="btn bg-gradient-info" role="button"
                                aria-pressed="true">Go
                                Back</a>
                        </div>

                        <form class='px-3' action="{{ route('qa.users.update', $user->id) }}" method="post">
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
                                        <label>Name</label>
                                        <input type="text" name="username" class="form-control"
                                            value="{{ old('username', $user->username) }}">
                                        @error('username')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 px-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label>Email</label>
                                        <input type="text" name="email" class="form-control"
                                            value="{{ old('email', $user->email) }}">
                                        @error('email')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 px-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label>Password</label>
                                        <input type="password" name="password" class="form-control"
                                            value="{{ old('password', $user->password) }}">
                                        @error('password')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 px-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label class="ms-0">Department</label>
                                        <select class="form-control" name="department">
                                            <option value="TS"
                                                {{ old('department', $user->department) == 'TS' ? 'selected' : '' }}>
                                                Technical Service</option>
                                            <option value="INS"
                                                {{ old('department', $user->department) == 'INS' ? 'selected' : '' }}>
                                                Instrumentation</option>
                                            <option value="DE"
                                                {{ old('department', $user->department) == 'DE' ? 'selected' : '' }}>Dry
                                                Eye</option>
                                            <option value="SC"
                                                {{ old('department', $user->department) == 'SC' ? 'selected' : '' }}>Supply
                                                Chain</option>
                                            <option value="IOL"
                                                {{ old('department', $user->department) == 'IOL' ? 'selected' : '' }}>IOL
                                            </option>
                                        </select>
                                        @error('department')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 px-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label>Designation</label>
                                        <input type="text" name="designation" class="form-control"
                                            value="{{ old('designation', $user->designation) }}">
                                        @error('designation')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 px-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label class="ms-0">Role</label>
                                        <select class="form-control" name="role">
                                            <option value="Director"
                                                {{ old('role', $user->role) == 'Director' ? 'selected' : '' }}>Director
                                            </option>
                                            <option value="Manager"
                                                {{ old('role', $user->role) == 'Manager' ? 'selected' : '' }}>Manager
                                            </option>
                                            <option value="Officer"
                                                {{ old('role', $user->role) == 'Officer' ? 'selected' : '' }}>Officer
                                            </option>
                                        </select>
                                        @error('role')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="mt-3">
                                    <button type="submit" class="btn bg-gradient-success">Update</button>
                                </div>
                            </div>


                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
