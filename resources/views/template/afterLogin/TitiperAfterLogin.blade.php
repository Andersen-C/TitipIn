<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('Title')</title>
    @vite('resources/css/app.css')
</head>

<body class='bg-gray-50 min-h-screen flex flex-col'>

    @include('template.afterLogin.navbarTitiperAfterLogin')

    <main class="flex-grow w-full">
        @yield('Content')
    </main>

    @include('template.afterLogin.footerAfterLogin')

</body>

</html>
