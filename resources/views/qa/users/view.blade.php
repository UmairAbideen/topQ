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
                            <h6 class="text-white text-capitalize ps-3">Users Table</h6>
                        </div>
                    </div>


                    <div class="d-flex flex-wrap justify-content-between align-items-center pt-3 ps-2">
                        <!-- Left group -->
                        <div class="d-flex flex-wrap align-items-center w-100 w-sm-auto">
                            <!-- Export -->
                            <div class="p-2 pe-sm-4 flex-grow-1 pb-3">
                                <a href="{{ route('qa.users.export.excel') }}" class="btn bg-gradient-info w-100 w-sm-auto"
                                    role="button" aria-pressed="true">
                                    Export
                                </a>
                            </div>

                            <!-- Import -->
                            <form action="{{ route('qa.users.import.excel') }}" method="post"
                                class="d-flex flex-wrap justify-content-center align-items-center w-100 w-sm-auto"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="p-2">
                                    <input type="file" name="excel_file" class="btn btn-sm bg-gradient-secondary">
                                </div>
                                <div class="p-2">
                                    <input type="submit" value="Import Excel Sheet" class="btn bg-gradient-info">
                                </div>
                            </form>
                        </div>

                        <!-- Right button -->
                        <div class="p-2 pe-3 ms-sm-auto w-100 w-sm-auto">
                            <a href="{{ route('qa.users.usersform') }}" class="btn bg-gradient-info w-100 w-sm-auto"
                                role="button" aria-pressed="true">
                                + Add New
                            </a>
                        </div>
                    </div>


                    @if (session('status'))
                        <div class="px-3">
                            <div class="alert alert-secondary alert-dismissible text-white fade show" role="alert">
                                <small>{{ session('status') }}</small>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        </div>
                    @endif

                    <div class="card-body ps-3 pe-2 pb-5 pt-3">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0" id="myTable">
                                <thead>
                                    <tr>
                                        <th class="text-center text-secondary small font-weight-bolder opacity-9">
                                            S. No.
                                        </th>
                                        <th class="text-center text-secondary small font-weight-bolder opacity-9">
                                            Name</th>
                                        <th class="text-center text-secondary small font-weight-bolder opacity-9 ps-2">
                                            Email</th>
                                        <th class="text-center text-secondary small font-weight-bolder opacity-9">
                                            Role</th>
                                        <th class="text-center text-secondary small font-weight-bolder opacity-9">
                                            Department</th>
                                        <th class="text-center text-secondary small font-weight-bolder opacity-9">
                                            Designation</th>
                                        <th class="text-center text-secondary small font-weight-bolder opacity-9">
                                            Approval</th>
                                        <th class="text-center text-secondary small font-weight-bolder opacity-9">
                                            Status</th>
                                        <th class="text-center text-secondary small font-weight-bolder opacity-9">
                                            Actions</th>
                                </thead>

                                <tbody>
                                    @foreach ($users as $item)
                                        <tr>
                                            <td class="align-middle text-center text-sm">
                                                {{ $loop->iteration }}
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                {{ $item->username }}
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                {{ $item->email }}
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                {{ $item->role }}
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                {{ $item->department }}
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                {{ $item->designation }}
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                {{ $item->approval }}
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                {{ $item->status }}
                                            </td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div>
                                                        <a href="{{ route('qa.users.single', $item->id) }}"
                                                            class="btn bg-gradient-secondary btn-sm mb-0 ms-1 me-1 "
                                                            role="button" aria-pressed="true">View</a>
                                                    </div>
                                                    <div>
                                                        <a href="{{ route('qa.users.edit', $item->id) }}"
                                                            class="btn bg-gradient-warning btn-sm mb-0 ms-1 me-1"
                                                            role="button" aria-pressed="true">Update</a>
                                                    </div>

                                                    <div>
                                                        <button type="button"
                                                            class="btn bg-gradient-danger btn-sm mb-0 ms-1 me-1"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#modal-delete-{{ $item->id }}">Delete</button>

                                                        <div class="modal fade" id="modal-delete-{{ $item->id }}"
                                                            tabindex="-1" role="dialog"
                                                            aria-labelledby="modal-delete-{{ $item->id }}"
                                                            aria-hidden="true">

                                                            <div class="modal-dialog modal-dialog-centered modal-"
                                                                role="document">

                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h6 class="modal-title font-weight-normal"
                                                                            id="modal-title-default">User Deletion
                                                                        </h6>
                                                                        <button type="button" class="btn-close text-dark"
                                                                            data-bs-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">×</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <p>Do you want to remove the user?</p>
                                                                    </div>
                                                                    <div class="modal-footer">

                                                                        <a href="{{ route('qa.users.delete', $item->id) }}"
                                                                            class="btn btn-danger btn-sm mb-0 ms-1 me-1"
                                                                            role="button" aria-pressed="true">Yes</a>

                                                                        <button type="button"
                                                                            class="btn btn-light btn-sm mb-0 ms-1 me-1"
                                                                            data-bs-dismiss="modal">No</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <ul id="pagination" class="pagination pagination-primary justify-content-center">
                        <!-- Pagination links will be generated dynamically using JavaScript -->
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
