<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hello world!</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    @vite('resources/css/app.css')
</head>
<body>
<div class="app h-screen w-full grid  grid-cols-6 text-base">
    <div class="col-span-1 w-full h-full bg-[#262948] relative">
        <div class="w-full py-8 px-4">
            <div class="flex justify-start items-center gap-4">
                <div class="w-12 h-12 rounded-full">
                    @include('components.avatar', ['avatar_path' => 'images/avatar.jpg'])
                </div>
                <div class="font-bold text-lg text-white">
                    @guest()
                        <p>Guest</p>
                    @else
                        <p>{{Auth::user()->name}}</p>
                    @endguest
                </div>
            </div>
        </div>
        <div class="w-full py-4 px-6 text-white font-semibold">
            <div class="flex justify-between items-center py-2">
                <a class="flex justify-start items-center gap-4 hover:text-red-500" href="#">
                    <i class="fa-solid fa-house"></i>
                    <p>Dashboard</p>
                </a>
            </div>
            <div class="flex justify-between items-center py-2">
                <a class="flex justify-start items-center gap-4 hover:text-red-500" href="#" >
                    <i class="fa-solid fa-users"></i>
                    <p>Chat Room</p>
                </a>
                @include('components.countNotification', ['number' => 1])
            </div>
            <div class="flex justify-between items-center py-2">
                <a class="flex justify-start items-center gap-4 hover:text-red-500" href="#">
                    <i class="fa-solid fa-calendar-days"></i>
                    <p>Calendar</p>
                </a>
                @include('components.countNotification', ['number' => 1])
            </div>
        </div>
        <div class="w-full absolute bottom-0 py-8 px-6 text-white font-semibold">
            <a class="flex justify-start items-center gap-4 py-2 hover:text-red-500" href="#">
                <i class="fa-solid fa-gear"></i>
                <p>Setting</p>
            </a>
            <a href="{{ route('logout') }}" class="flex justify-start items-center gap-4 py-2 hover:text-red-500"
               onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                <i class="fa-solid fa-right-from-bracket"></i>
                <p> Logout</p>
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </div>
    </div>
    <div class="col-span-5 w-full h-full bg-[#3c425e]">
        <div class="grid grid-cols-2 gap-1 h-full">
            <!-- column 2-->
            <div class="col-span-1 h-full bg-[#202441] text-white text-base w-full pl-12 pr-12 py-8">
                <div class="font-bold  text-3xl flex justify-between">
                    <div class="flex justify-start items-center gap-4">
                        <i class="fa-solid fa-users"></i>
                        <p> Chat Room</p>
                    </div>
                    <button>
                        <i class="fa-solid fa-plus"></i>
                    </button>
                </div>
                <div class="w-ful pl-4 mt-12">
                    <p class="font-semibold">My rooms</p>

                    @for($i=0; $i<=5; $i++)
                        <a href="#" class="w-full bg-[#262948] hover:bg-[#4289f3] py-3 px-4 my-4 rounded-lg grid grid-cols-3 gap-2 relative">
                            <div class="col-span-1">
                                <div class="flex justify-start items-center gap-4">
                                    <div class="w-8 h-8 rounded-full">
                                        @include('components.avatar', ['avatar_path' => 'images/avatar.jpg'])
                                    </div>
                                    <p class="font-bold"> Weekly MTG </p>
                                </div>
                            </div>
                            <div class="col-span-2">
                                <p> ... ... ... ... ...  ... ... ... ... ...</p>
                            </div>
                            <div class="absolute top-0 right-0 text-sm mr-2 mt-1  flex justify-end items-center gap-4">
                                <p class="text-gray-400">2 min ago</p>
                                @include('components.countNotification', ['number' => 1])
                            </div>
                        </a>
                    @endfor

                </div>
            </div>
            <!-- column 3 -->
            <div class="col-span-1 w-full h-full bg-[#212540]">

            </div>
        </div>
    </div>
</div>
<div class="absolute top-0 left-0 h-screen w-full opacity-50 bg-black">
</div>
<div class="absolute top-0 left-0 h-screen w-full flex justify-center">
    <div class=" w-1/2 h-64  self-center p-4 relative">
        <div class="w-full h-full  bg-white rounded-lg"></div>
        <button class="absolute top-0 right-0 border border-gray-300 bg-gray-300 w-8 h-8 rounded-full text-red-500 hover:text-white hover:bg-red-500 hover:border-red-500">
            <i class="fa-solid fa-xmark"></i>
        </button>
    </div>
</div>
</body>
</html>
