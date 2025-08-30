<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <title>@yield('title', 'Shine')</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css">
    @vite('resources/css/app.css')

</head>

<body class="min-h-screen bg-gray-100">

    @include('admin.partials.header')
    
    <div class="flex min-h-screen">
        @include('admin.partials.sidebar')
        
        <main class="flex-1 min-h-screen">
            @yield('content')
        </main>
    </div>

    @include('admin.partials.footer')

    @include('admin.partials.script')
    
    @yield('scripts')

</body>

</html>
