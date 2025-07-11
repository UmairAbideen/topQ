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

                {{-- --------------------------------------- Notification start ------------------------------------- --}}


                <!-- Notification Dropdown -->
                {{-- <li class="nav-item dropdown pe-3 d-flex align-items-center"> --}}
                    <!-- Bell Icon (Dropdown Trigger) -->
                    {{-- <a href="" class="nav-link text-body p-0" id="dropdownMenuButton" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        <i class="fa fa-bell cursor-pointer position-relative"></i> --}}

                        <!-- Notification Badge (Shows if there are unread notifications) -->
                        {{-- @if (auth()->user()->unreadNotifications->count() > 0)
                            <span class="position-absolute p-1 top-15 bg-gradient-primary rounded-circle"></span>
                        @endif
                    </a> --}}

                    <!-- Dropdown Menu -->
                    {{-- <ul class="dropdown-menu dropdown-menu-end px-2 py-2 me-sm-n4" aria-labelledby="dropdownMenuButton"> --}}
                        <!-- Loop through all notifications -->
                        {{-- @foreach (auth()->user()->notifications->take(7) as $notification)
                            <div>
                                <li class="mb-2"> --}}
                                    <!-- Notification Link -->
                                    {{-- <a class="dropdown-item border-radius-md {{ $notification->read_at ? '' : 'bg-gradient-light' }}"
                                        href="{{ $notification->data['object'] === 'Complaint' ? route('qa.complaint.view') : route('qa.risk.view') }}">

                                        <div class="d-flex py-1"> --}}
                                            <!-- Notification Icon -->
                                            {{-- <div class="my-auto">
                                                <img src="/assets/img/1 - complaint-icon.jpg"
                                                    class="avatar avatar-sm me-3">
                                            </div> --}}
                                            <!-- Notification Text -->
                                            {{-- <div class="d-flex flex-column justify-content-center">
                                                <h6 class="text-sm font-weight-normal mb-1">
                                                    <span
                                                        class="font-weight-bold">{{ $notification->data['object'] }}</span>
                                                    from {{ $notification->data['subject'] }}
                                                </h6> --}}
                                                <!-- Relative time of the notification -->
                                                {{-- <p class="text-xs text-secondary mb-0">
                                                    <i class="fa fa-clock me-1"></i>
                                                    {{ \Carbon\Carbon::parse($notification->data['time'])->diffForHumans() }}
                                                </p>
                                            </div>
                                        </div>
                                    </a> --}}

                                    <!-- Mark as Read Button for Unread Notifications -->
                                    {{-- @if (!$notification->read_at)
                                        <p
                                            class="position-absolute p-0 top-11 bottom-0 end-0 text-xs text-secondary mb-0">
                                            <a class="nav-link"
                                                href="{{ route('qa.complaint.read', $notification->id) }}"> --}}

                                                {{-- href="{{ $notification->data['object'] === 'complaint' ? route('qa.complaint.read') : route('qa.risk.read') }}"> --}}
                                                {{-- <strong><small>Mark as read</small></strong>
                                            </a>
                                        </p>
                                    @endif
                                </li>
                            </div>
                        @endforeach
                    </ul>
                </li> --}}

                {{-- --------------------------------------   Notification ends  ------------------------------------- --}}


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
