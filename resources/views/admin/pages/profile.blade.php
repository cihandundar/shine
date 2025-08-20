@extends('admin.base')

@section('title', 'User Profile')

@section('content')
    <section class="container max-w-screen-xl mx-auto py-[75px]">
        <div class="grid grid-cols-12">
            @if ($user->profile_image)
                <div class="col-span-2 flex flex-col items-center gap-1">
                    <img src="{{ asset($user->profile_image) }}" alt=""
                        class="w-[100px] h-[100px] object-cover rounded-full">
                    <div class="text-xl">
                        {{ $user->name }}
                    </div>
                    <div class="text-sm">
                        {{ $user->email }}
                    </div>
                </div>
            @else
                <div class="col-span-2 text-2xl flex items-center justify-center bg-gray-200 rounded-full h-16 w-16">
                    <i class="fa-solid fa-user "></i>
                </div>
            @endif
            <div class="col-span-10">
                @if (session('success'))
                    <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded">
                        {{ session('success') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data"
                    class="grid grid-cols-12 gap-5 w-full">
                    @csrf
                    <div class="col-span-6 relative">
                        <input type="text" name="name" placeholder=" " value="{{ $user->name }}"
                            class="outline-none p-4 border border-black w-full rounded-md peer focus:border-black text-black bg-transparent" />
                        <label for="name"
                            class="text-black capitalize absolute left-4 top-4 text-base pointer-events-none bg-white rounded px-1 transition-all duration-200 ease-in-out
    peer-placeholder-shown:top-4 peer-placeholder-shown:left-4 peer-placeholder-shown:text-base peer-placeholder-shown:scale-100
    peer-focus:-top-2 peer-focus:left-3 peer-focus:text-xs peer-focus:scale-90 peer-focus:bg-white peer-focus:px-1
    peer-[&:not(:placeholder-shown)]:-top-2 peer-[&:not(:placeholder-shown)]:left-3 peer-[&:not(:placeholder-shown)]:text-xs
    peer-[&:not(:placeholder-shown)]:scale-90 peer-[&:not(:placeholder-shown)]:bg-white peer-[&:not(:placeholder-shown)]:px-1">
                            Username
                        </label>
                    </div>
                    <div class="col-span-6 relative">
                        <input type="email" name="email" placeholder=" " value="{{ $user->email }}"
                            class="outline-none p-4 border border-black w-full rounded-md peer focus:border-black text-black bg-transparent" />
                        <label for="email"
                            class="text-black capitalize absolute left-4 top-4 text-base pointer-events-none bg-white rounded px-1 transition-all duration-200 ease-in-out
    peer-placeholder-shown:top-4 peer-placeholder-shown:left-4 peer-placeholder-shown:text-base peer-placeholder-shown:scale-100
    peer-focus:-top-2 peer-focus:left-3 peer-focus:text-xs peer-focus:scale-90 peer-focus:bg-white peer-focus:px-1
    peer-[&:not(:placeholder-shown)]:-top-2 peer-[&:not(:placeholder-shown)]:left-3 peer-[&:not(:placeholder-shown)]:text-xs
    peer-[&:not(:placeholder-shown)]:scale-90 peer-[&:not(:placeholder-shown)]:bg-white peer-[&:not(:placeholder-shown)]:px-1">
                            Email
                        </label>
                    </div>
                    <div class="col-span-6 relative">
                        <input type="password" name="password" placeholder=" "
                            class="outline-none p-4 border border-black w-full rounded-md peer focus:border-black text-black bg-transparent" />
                        <label for="password"
                            class="text-black capitalize absolute left-4 top-4 text-base pointer-events-none bg-white rounded px-1 transition-all duration-200 ease-in-out
    peer-placeholder-shown:top-4 peer-placeholder-shown:left-4 peer-placeholder-shown:text-base peer-placeholder-shown:scale-100
    peer-focus:-top-2 peer-focus:left-3 peer-focus:text-xs peer-focus:scale-90 peer-focus:bg-white peer-focus:px-1
    peer-[&:not(:placeholder-shown)]:-top-2 peer-[&:not(:placeholder-shown)]:left-3 peer-[&:not(:placeholder-shown)]:text-xs
    peer-[&:not(:placeholder-shown)]:scale-90 peer-[&:not(:placeholder-shown)]:bg-white peer-[&:not(:placeholder-shown)]:px-1">
                            Password
                        </label>
                    </div>
                    <div class="col-span-6 relative">
                        <input type="password" name="password_confirmation" placeholder=" "
                            class="outline-none p-4 border border-black w-full rounded-md peer focus:border-black text-black bg-transparent" />
                        <label for="password_confirmation"
                            class="text-black capitalize absolute left-4 top-4 text-base pointer-events-none bg-white rounded px-1 transition-all duration-200 ease-in-out
    peer-placeholder-shown:top-4 peer-placeholder-shown:left-4 peer-placeholder-shown:text-base peer-placeholder-shown:scale-100
    peer-focus:-top-2 peer-focus:left-3 peer-focus:text-xs peer-focus:scale-90 peer-focus:bg-white peer-focus:px-1
    peer-[&:not(:placeholder-shown)]:-top-2 peer-[&:not(:placeholder-shown)]:left-3 peer-[&:not(:placeholder-shown)]:text-xs
    peer-[&:not(:placeholder-shown)]:scale-90 peer-[&:not(:placeholder-shown)]:bg-white peer-[&:not(:placeholder-shown)]:px-1">
                            Confirm Password
                        </label>
                    </div>

                    <div class="col-span-6">
                        <input type="file" name="profileImage"
                            class="w-full border-1 rounded-md p-4 border-black cursor-pointer">
                    </div>

                    <div class="col-span-12 flex justify-end">
                        <button type="submit"
                            class="px-6 py-3 bg-green-500 text-white rounded-md hover:bg-green-600 transition cursor-pointer">
                            Update
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
