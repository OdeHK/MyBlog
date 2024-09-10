<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>

    @include('admin.layout.style')

    @stack('style')
</head>

<body>
    <div class="wrapper">
        {{--Navigation--}}
        @include('admin.layout.header')

        @yield('content')
    </div>

    {{--Script--}}
    @include('admin.layout.script')

    @stack('script')
</body>

</html>