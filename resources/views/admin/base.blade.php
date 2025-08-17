<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <title>@yield('title', 'Shine')</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css">
    @vite('resources/css/app.css')

</head>

<body>

    @include('admin.partials.header')
    @include('admin.partials.sidebar')



    @yield('content')

    @include('admin.partials.footer')

    @include('admin.partials.script')

</body>

</html>
