<!DOCTYPE html>
<html lang="en">

<head>
    @include('qa.Layout.common-head')
</head>

<body class="g-sidenav-show  bg-gray-200">

    @include('qa.Layout.sidebar')

    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">

        @include('qa.Layout.header')

        @yield('main-content')

        @include('qa.Layout.footer')

    </main>

    @include('qa.Layout.common-end')
</body>

</html>
