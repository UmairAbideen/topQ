<!DOCTYPE html>
<html lang="en">

<head>
    @include('manager.Layout.common-head')
</head>

<body class="g-sidenav-show  bg-gray-200">

    @include('manager.Layout.sidebar')

    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">

        @include('manager.Layout.header')

        @yield('main-content')

        @include('manager.Layout.footer')

    </main>

    @include('manager.Layout.common-end')
</body>

</html>
