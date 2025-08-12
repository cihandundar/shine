<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Giriş Yap</title>
    @vite('resources/css/app.css')
</head>

<body>

    <div class="grid gap-5 grid-cols-12 bg-black h-screen">
        <div class="lg:col-span-6 col-span-12 flex flex-col items-center justify-center w-full p-30">
            <div class="text-4xl text-white mb-8 capitalize">admin login</div>
            <form method="POST" action="{{ route('auth.login.post') }}" class="w-full">
                @csrf
                <div class="relative w-full mb-5">
                    <input type="email" name="email" required placeholder=" "
                        class="outline-none p-4 border border-white w-full rounded-md peer focus:border-white text-white bg-transparent" />
                    <label for="email"
                        class="text-white capitalize absolute left-4 top-4 text-base pointer-events-none bg-black/70 rounded px-1 transition-all duration-200 ease-in-out
        peer-placeholder-shown:top-4 peer-placeholder-shown:left-4 peer-placeholder-shown:text-base peer-placeholder-shown:scale-100
        peer-focus:-top-2 peer-focus:left-3 peer-focus:text-xs peer-focus:scale-90 peer-focus:bg-black/70 peer-focus:px-1
        peer-[&:not(:placeholder-shown)]:-top-2 peer-[&:not(:placeholder-shown)]:left-3 peer-[&:not(:placeholder-shown)]:text-xs
        peer-[&:not(:placeholder-shown)]:scale-90 peer-[&:not(:placeholder-shown)]:bg-black/70 peer-[&:not(:placeholder-shown)]:px-1">
                        Email
                    </label>
                </div>

                <div class="relative w-full mb-5">
                    <input type="password" name="password" required placeholder=" "
                        class="outline-none p-4 border border-white w-full rounded-md peer focus:border-white text-white bg-transparent" />
                    <label for="password"
                        class="text-white capitalize absolute left-4 top-4 text-base pointer-events-none bg-black/70 rounded px-1 transition-all duration-200 ease-in-out
        peer-placeholder-shown:top-4 peer-placeholder-shown:left-4 peer-placeholder-shown:text-base peer-placeholder-shown:scale-100
        peer-focus:-top-2 peer-focus:left-3 peer-focus:text-xs peer-focus:scale-90 peer-focus:bg-black/70 peer-focus:px-1
        peer-[&:not(:placeholder-shown)]:-top-2 peer-[&:not(:placeholder-shown)]:left-3 peer-[&:not(:placeholder-shown)]:text-xs
        peer-[&:not(:placeholder-shown)]:scale-90 peer-[&:not(:placeholder-shown)]:bg-black/70 peer-[&:not(:placeholder-shown)]:px-1">
                        Password
                    </label>
                </div>
                <button type="submit"
                    class="w-full bg-blue-500 text-white py-5 rounded-md hover:bg-blue-600 transition cursor-pointer">
                    Login
                </button>
            </form>
        </div>
        <img src="/front/assets/images/background.jpg" alt="Background Image"
            class="w-full object-cover h-full lg:col-span-6 col-span-12 " />
    </div>
</body>

</html>
