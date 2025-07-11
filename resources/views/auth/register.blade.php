<!DOCTYPE html>
<html lang="en">

<head>
    @include('qa.layout.common-head')
</head>

<body class="">
    <main class="main-content  mt-0">
        <section>
            <div class="page-header min-vh-100">
                <div class="container">
                    <div class="row">
                        <div
                            class="col-6 d-lg-flex d-none h-100 my-auto pe-0 position-absolute top-0 start-0 text-center justify-content-center flex-column">
                            <div class="bg-gradient-primary h-100 m-3 px-7 border-radius-lg d-flex flex-column justify-content-center"
                                style="background-image: url('../assets/img/bg-quality.jpg'); background-size: cover; background-position: center;">
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-5 col-md-7 d-flex flex-column ms-auto me-auto ms-lg-auto me-lg-5">
                            <div class="card card-plain">
                                <div class="card-header">
                                    <h4 class="font-weight-bolder">Sign Up</h4>
                                    <p class="mb-0">Enter your email and password to register</p>
                                </div>
                                <div class="card-body">

                                    <form role="form" action="{{ route('register') }}" method="post">
                                        @csrf
                                        <span class="text-danger small">
                                            @error('username')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                        <div class="input-group input-group-dynamic mb-4">
                                            <label class="form-label" >Name</label>
                                            <input type="text" name ="username" class="form-control ps-2"
                                            value="{{ old('username') }}">
                                        </div>
                                        {{-- <div class="input-group input-group-outline mb-3">
                                            <label class="form-label" >Name</label>
                                            <input type="text" name="username" class="form-control"
                                                value="{{ old('username') }}">
                                        </div> --}}

                                        <span class="text-danger small">
                                            @error('email')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                        <div class="input-group input-group-dynamic mb-4">
                                            <label class="form-label" >Email</label>
                                            <input type="email" name ="email" class="form-control ps-2"
                                            value="{{ old('email') }}">
                                        </div>
                                        {{-- <div class="input-group input-group-outline mb-3">
                                            <label class="form-label">Email</label>
                                            <input type="email" name="email" class="form-control"
                                                value="{{ old('email') }}">
                                        </div> --}}

                                        <span class="text-danger small">
                                            @error('password')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                        <div class="input-group input-group-dynamic mb-4">
                                            <label class="form-label">Password</label>
                                            <input type="password" name ="password" class="form-control ps-2">
                                        </div>
                                        {{-- <div class="input-group input-group-outline mb-3">
                                            <label class="form-label">Password</label>
                                            <input type="password" name="password" class="form-control">
                                        </div> --}}

                                        <div class="text-center">
                                            <button type="submit"
                                                class="btn btn-lg bg-gradient-primary btn-lg w-100 mt-4 mb-0">
                                                Sign Up</button>
                                        </div>
                                    </form>

                                </div>
                                <div class="card-footer text-center pt-0 px-lg-2 px-1">
                                    <p class="mb-2 text-sm mx-auto">
                                        Already have an account?
                                        <a href="{{ route('index') }}"
                                            class="text-primary text-gradient font-weight-bold">Sign in</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    {{-- include .js links --}}
    @include('qa.layout.common-end')

</body>

</html>
