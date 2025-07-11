<!DOCTYPE html>
<html lang="en">

<head>
    @include('manager.layout.common-head')
</head>

<body class="g-sidenav-show  bg-gray-200">

    @include('manager.layout.sidebar')

    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">

        @include('manager.layout.header')

        @yield('main-content')

        @include('manager.layout.footer')

    </main>

    @include('manager.layout.common-end')
</body>

</html>
