<aside
    class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3 bg-gradient-dark"
    id="sidenav-main">

    <div class="sidenav-header d-flex justify-content-center mb-2">
        <a class="navbar-brand m-0" href="" target="_blank">
            <img src="/assets/img/logo-1.png" class="navbar-brand-img" alt="main_logo">
        </a>
    </div>

    <hr class="horizontal light mt-0 mb-3">

    <div class="collapse navbar-collapse w-auto" id="sidenav-collapse-main">
        <ul class="navbar-nav">

            <li class="nav-item">
                <a class="nav-link text-white @yield('active-link-db')" href="{{ route('manager.dashboard') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <span class="nav-link-text ms-1">Dashboard</span>
                    </div>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link text-white @yield('active-link-documents')" href="{{ route('m.document.policy.view') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <span class="nav-link-text ms-1">Documents</span>
                    </div>
                </a>
            </li>

            @if (in_array(Auth::user()->department, ['TS', 'INS', 'DE', 'IOL']))
                <li class="nav-item">
                    <a class="nav-link text-white @yield('active-link-complaint')" href="{{ route('manager.complaint.view') }}">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <span class="nav-link-text ms-1">Product Complaint</span>
                        </div>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link text-white @yield('active-link-feedback')"
                        @if (Auth::user()->department === 'TS') href="{{ route('m.ts.feedback.view') }}"
                            @elseif (Auth::user()->department === 'INS') href="{{ route('m.ins.feedback.view') }}"
                            @elseif (Auth::user()->department === 'IOL') href="{{ route('m.iol.feedback.view') }}"
                            @elseif (Auth::user()->department === 'DE') href="{{ route('m.de.feedback.view') }}" @endif>
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <span class="nav-link-text ms-1">Customer Feedback</span>
                        </div>
                    </a>
                </li>
            @endif

            <li class="nav-item">
                <a class="nav-link text-white @yield('active-link-risk')" href="{{ route('manager.risk.view') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <span class="nav-link-text ms-1">Risk Assessment</span>
                    </div>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link text-white @yield('active-link-mrm')" href="{{ route('manager.mrm.attendance.view') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <span class="nav-link-text ms-1">Management Review Meeting</span>
                    </div>
                </a>
            </li>

            @if (in_array(Auth::user()->department, ['TS', 'SC']))
                <li class="nav-item">
                    <a class="nav-link text-white @yield('active-link-ccm')" href="{{ route('manager.ccm.view') }}">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <span class="nav-link-text ms-1">Change Control Management</span>
                        </div>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link text-white @yield('active-link-dm')" href="{{ route('manager.deviation.view') }}">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <span class="nav-link-text ms-1">Deviation Management</span>
                        </div>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link text-white @yield('active-link-capa')" href="{{ route('manager.capa.view') }}">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <span class="nav-link-text ms-1">Corrective & Preventive Action</span>
                        </div>
                    </a>
                </li>
            @endif

            <li class="nav-item">
                <a class="nav-link text-white @yield('active-link-training')"
                    href="{{ route('manager.training.attendance.view') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <span class="nav-link-text ms-1">Training Management</span>
                    </div>
                </a>
            </li>


            @if (in_array(Auth::user()->department, ['TS', 'SC']))
                <li class="nav-item">
                    <a class="nav-link text-white @yield('active-link-doc')"
                        href="{{ route('manager.doc-control.change.view') }}">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <span class="nav-link-text ms-1">Document Control</span>
                        </div>
                    </a>
                </li>
            @endif


            {{-- <li class="nav-item">
                <a class="nav-link text-white" href="{{route('qa.notification.view')}}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <span class="nav-link-text ms-1">Notification</span>
                    </div>
                </a>
            </li> --}}

            {{--



            <li class="nav-item">
                <a class="nav-link text-white" href="../pages/dashboard.html">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <span class="nav-link-text ms-1">CAPA</span>
                    </div>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link text-white" href="../pages/dashboard.html">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <span class="nav-link-text ms-1">Training</span>
                    </div>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link text-white" href="../pages/dashboard.html">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <span class="nav-link-text ms-1">Vendors</span>
                    </div>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link text-white" href="../pages/dashboard.html">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <span class="nav-link-text ms-1">Internal Audit</span>
                    </div>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link text-white" href="../pages/dashboard.html">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <span class="nav-link-text ms-1">QA Forms</span>
                    </div>
                </a>
            </li> --}}

        </ul>
    </div>
</aside>
