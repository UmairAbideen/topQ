<!DOCTYPE html>
<html lang="en">

<head>
    @include('officer.layout.common-head')
</head>

<body class="g-sidenav-show  bg-gray-200">

    @include('officer.layout.sidebar')

    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">

        @include('officer.layout.header')

        @yield('main-content')

        @include('officer.layout.footer')

    </main>

    @include('officer.layout.common-end')
</body>

</html>
