<!DOCTYPE html>
<html lang="en">

<head>
    @include('qa.Layout.common-head')
</head>

<body class="bg-gray-200">

    <main class="main-content  mt-0">
        <div class="page-header align-items-start min-vh-100"
            style="background-image: url('https://images.unsplash.com/photo-1497294815431-9365093b7331?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1950&q=80');">
            <span class="mask bg-gradient-dark opacity-6"></span>
            <div class="container my-auto">
                <div class="row">
                    <div class="col-lg-4 col-md-8 col-12 mx-auto">
                        <div class="card z-index-0 fadeIn3 fadeInBottom">

                            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                                <div class="bg-gradient-primary shadow-primary border-radius-lg py-3 pe-1">

                                    <img src="../assets/img/logo-3.png" class="mx-auto d-block" width='150'>
                                    <h5 class="text-white font-weight-bolder text-center mt-3 mb-0">Log in</h5>

                                </div>
                            </div>

                            <div class="card-body">

                                <form role="form" action="{{ route('login') }}" method="post" class="text-start">
                                    @csrf
                                    @if (session('status'))
                                        <div class="alert alert-success alert-dismissible text-white fade show"
                                            role="alert">
                                            <small>{{ session('status') }}</small>
                                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                    @endif

                                    @if (session('pending'))
                                        <div class="alert alert-secondary alert-dismissible text-white fade show"
                                            role="alert">
                                            <small>{{ session('pending') }}</small>
                                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                    @endif

                                    @if (session('activation'))
                                        <div class="alert alert-primary alert-dismissible text-white fade show"
                                            role="alert">
                                            <small>{{ session('activation') }}</small>
                                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                    @endif

                                    @if (session('error'))
                                        <div class="alert alert-warning alert-dismissible text-white fade show"
                                            role="alert">
                                            <small>{{ session('error') }}</small>
                                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                    @endif

                                    @if (session('logout'))
                                        <div class="alert alert-info alert-dismissible text-white fade show"
                                            role="alert">
                                            <small>{{ session('logout') }}</small>
                                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                    @endif

                                    <span class="text-danger small mb-2">
                                        @error('email')
                                            {{ $message }}
                                        @enderror
                                    </span>

                                    <div class="input-group input-group-dynamic mb-4">
                                        <input type="email" name="email" class="form-control ps-2"
                                            placeholder="Email" aria-label="Email" value="{{ old('email') }}"
                                            aria-describedby="basic-addon1">
                                    </div>


                                    <span class="text-danger small mb-2">
                                        @error('password')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                    <div class="input-group input-group-dynamic mb-4">
                                        <input type="password" name ="password" class="form-control ps-2"
                                            placeholder="Password" aria-describedby="basic-addon1">
                                    </div>

                                    <div class="text-center">
                                        <button type="submit" class="btn bg-gradient-primary w-100 my-4 mb-2">Log
                                            in</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <footer class="footer position-absolute bottom-4 py-2 w-100">
                <div class="container">
                    <div class="row align-items-center justify-content-lg-between">
                        <div class="copyright text-center text-sm text-muted">
                            Powered By MEDZNTECH
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </main>

    @include('qa.Layout.common-end')

</body>

</html>
