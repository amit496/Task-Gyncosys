<!DOCTYPE html>
<html lang="en" dir="ltr" data-nav-layout="vertical" class="light" data-header-styles="light" data-menu-styles="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @include('admin.layout.allcss')
    @yield('css')

</head>
<body>
    <div class="page">
        @include('admin.layout.left-sidebar')
        @include('admin.layout.header')
        <div class="content">
            <div class="main-content">
                @yield('content')
            </div>
        </div>
        @include('admin.layout.footer')
    </div>
    @include('admin.layout.alljs')
    @yield('script')
</body>
</html>
