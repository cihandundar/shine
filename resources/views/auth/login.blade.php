<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Giriş Yap</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <form method="POST" action="{{ route('auth.login.post') }}">
        @csrf
        <div class="">
            <label for="Email">Email</label>
            <input type="email" placeholder="Email">
        </div>
        <div class="">
            <label for="password">Password</label>
            <input type="email" placeholder="Password">
        </div>
        <button type="submit">Login</button>
    </form>
</body>

</html>
