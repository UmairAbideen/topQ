<!DOCTYPE html>
<html lang="en">

<head>
    @include('director.Layout.common-head')
</head>

<body class="g-sidenav-show  bg-gray-200">

    @include('director.Layout.sidebar')

    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">

        @include('director.Layout.header')

        @yield('main-content')

        @include('director.Layout.footer')

    </main>

    @include('director.Layout.common-end')
</body>

</html>
