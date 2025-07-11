<!DOCTYPE html>
<html lang="en">

<head>
    @include('officer.Layout.common-head')
</head>

<body class="g-sidenav-show  bg-gray-200">

    @include('officer.Layout.sidebar')

    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">

        @include('officer.Layout.header')

        @yield('main-content')

        @include('officer.Layout.footer')

    </main>

    @include('officer.Layout.common-end')
</body>

</html>
