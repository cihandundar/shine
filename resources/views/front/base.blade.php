<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <title>News Website</title>

    @vite('resources/css/app.css')

</head>

<body>

    @include('front.partials.header')

    @yield('content')

    @include('front.partials.footer')

    @include('front.partials.script')

</body>

</html>
