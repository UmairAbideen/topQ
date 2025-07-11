<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" data-scroll="true">
    <div class="container-fluid py-1 px-3">

        <nav aria-label="breadcrumb">
            <h6 class="font-weight-bolder mb-0">@yield('page-name')</h6>
        </nav>

        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">

            {{-- <div class="ms-2 ms-md-auto pe-md-3 d-flex align-items-center">
                   <div class="input-group input-group-outline">
                       <label class="form-label">Type here...</label>
                       <input type="text" class="form-control">
                   </div>
               </div> --}}

            <ul class="navbar-nav  justify-content-end ms-2 ms-md-auto pe-md-3 d-flex align-items-center">

                <li class="nav-item d-xl-none p-3 d-flex align-items-center">
                    <a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav">
                        <div class="sidenav-toggler-inner">
                            <i class="sidenav-toggler-line"></i>
                            <i class="sidenav-toggler-line"></i>
                            <i class="sidenav-toggler-line"></i>
                        </div>
                    </a>
                </li>

                {{-- Notifications --}}

                {{-- <li class="nav-item dropdown pe-3 d-flex align-items-center">
                    <a href="" class="nav-link text-body p-0" id="dropdownMenuButton" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        <i class="fa fa-bell cursor-pointer position-relative"></i>
                        @foreach (auth()->user()->notifications as $notification)
                            @if ($notification->read_at == '')
                                <span class="position-absolute p-1 top-15 bg-gradient-primary rounded-circle"></span>
                            @endif
                        @endforeach
                    </a>
                    <ul class="dropdown-menu  dropdown-menu-end  px-2 py-2 me-sm-n4"
                        aria-labelledby="dropdownMenuButton">

                        @foreach (auth()->user()->notifications as $notification)
                            @if ($notification->read_at)
                                <div>
                                    <li class="mb-2">
                                        <a class="dropdown-item border-radius-md"
                                            href="{{ route('qa.complaint.view') }}">
                                            <div class="d-flex py-1">
                                                <div class="my-auto">
                                                    <img src="/assets/img/1 - complaint-icon.jpg"
                                                        class="avatar avatar-sm  me-3 ">
                                                </div>
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="text-sm font-weight-normal mb-1">
                                                        <span
                                                            class="font-weight-bold">{{ $notification->data['object'] }}</span>
                                                        from {{ $notification->data['subject'] }}
                                                    </h6>
                                                    <div class="d-flex justify-content-between position-relative">
                                                        <p class="text-xs text-secondary mb-0">
                                                            <i class="fa fa-clock me-1"></i>
                                                            @php
                                                                echo \Carbon\Carbon::parse(
                                                                    $notification->data['time'],
                                                                )->diffForHumans();
                                                            @endphp
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                </div>
                            @elseif ($notification->read_at == '')
                                <div>
                                    <li class="mb-2">
                                        <a class="dropdown-item bg-gradient-light border-radius-md"
                                            href="{{ route('qa.complaint.view') }}">
                                            <div class="d-flex py-1">
                                                <div class="my-auto">
                                                    <img src="/assets/img/1 - complaint-icon.jpg"
                                                        class="avatar avatar-sm  me-3 ">
                                                </div>
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="text-sm font-weight-normal mb-1">
                                                        <span
                                                            class="font-weight-bold">{{ $notification->data['object'] }}</span>
                                                        from {{ $notification->data['subject'] }}
                                                    </h6>
                                                    <div class="d-flex justify-content-between position-relative">
                                                        <p class="text-xs text-secondary mb-0">
                                                            <i class="fa fa-clock me-1"></i>
                                                            @php
                                                                echo \Carbon\Carbon::parse(
                                                                    $notification->data['time'],
                                                                )->diffForHumans();
                                                            @endphp
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                        <p
                                            class="position-absolute p-0 top-11 bottom-0 end-0 text-xs text-secondary mb-0">
                                            <a class="nav-link"
                                                href="{{ route('qa.complaint.read', $notification->id) }}">
                                                <strong><small>Mark as read</small></strong>
                                            </a>
                                        </p>
                                    </li>
                                </div>
                            @endif
                        @endforeach
                    </ul>
                </li> --}}

                <li class="nav-item d-flex align-items-center">
                    <a href="{{ route('logout') }}" class="nav-link text-body font-weight-bold px-0">
                        <i class="fa fa-power-off me-sm-1"></i>
                        <span class="d-sm-inline d-none">Logout</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
