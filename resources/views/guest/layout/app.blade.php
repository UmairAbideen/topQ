<!DOCTYPE html>
<html lang="en">

<head>
    @include('qa.layout.common-head')
</head>

<body class="g-sidenav-show  bg-gray-200">

    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">

        @yield('main-content')

    </main>

    @include('qa.layout.common-end')
</body>

</html>
