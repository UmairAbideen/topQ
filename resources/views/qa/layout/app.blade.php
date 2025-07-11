<!DOCTYPE html>
<html lang="en">

<head>
    @include('qa.layout.common-head')
</head>

<body class="g-sidenav-show  bg-gray-200">

    @include('qa.layout.sidebar')

    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">

        @include('qa.layout.header')

        @yield('main-content')

        @include('qa.layout.footer')

    </main>

    @include('qa.layout.common-end')
</body>

</html>
