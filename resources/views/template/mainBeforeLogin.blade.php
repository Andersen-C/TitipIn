<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('Title')</title>
    @vite('resources/css/app.css')
</head>
<body class='bg-gray-50'>
    @include('template.beforeLogin.navbarBeforeLogin')

    @yield('Content')

    @include('template.beforeLogin.footerBeforeLogin')
</body>
</html>