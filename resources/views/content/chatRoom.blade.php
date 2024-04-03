@extends('layouts.chatLayout')
@section('title')
    Chat Room
@endsection
@section('content')
    <div class="grid grid-cols-3 gap-1 h-full">
        <!-- column 2-->
        <div class="col-span-2 h-full bg-[#202441] text-white text-base w-full pl-12 pr-12 py-8">
            <div class="font-bold text-3xl flex justify-between">
                <div class="flex justify-start items-center gap-4">
                    <i class="fa-solid fa-users"></i>
                    <p> Chat Room</p>
                </div>
                <div class="flex justify-end items-center gap-4">
                    <button type="button" onclick="openModal('searchRoomModal')" class="text-white hover:text-orange-400">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </button>
                    <button type="button" onclick="openModal('addNewRoomFormModal')" class="text-white hover:text-orange-400">
                        <i class="fa-solid fa-plus"></i>
                    </button>
                </div>

            </div>
            <div class="w-ful pl-4 mt-12">
                <p class="font-semibold">My rooms</p>
                <div class="w-full" id="rooms_list">
                    @foreach($rooms as $room)
                        <a href="#" class="w-full bg-[#262948] hover:bg-[#4289f3] py-3 px-4 my-4 rounded-lg grid grid-cols-3 gap-2 relative">
                            <div class="col-span-1">
                                <div class="flex justify-start items-center gap-4">
                                    <div class="w-8 h-8 rounded-full">
                                        @include('components.avatar', ['avatar_path' => $room->icon ?? 'images/avatar.jpg'])
                                    </div>
                                    <p class="font-bold">{{$room->name}}</p>
                                </div>
                            </div>
                            <div class="col-span-2">
                                <p> {{$room->description}}</p>
                            </div>
                            <div class="absolute top-0 right-0 text-sm mr-2 mt-1  flex justify-end items-center gap-4">
                                <p class="text-gray-400">2 min ago</p>
                                @include('components.countNotification', ['number' => 1])
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>

            <div class="w-ful pl-4 mt-12">
                <p class="font-semibold">Joined rooms</p>
                <div class="w-full" id="joined_rooms_list">
                    @foreach($joined_rooms as $room)
                        <a href="#" class="w-full bg-[#262948] hover:bg-[#4289f3] py-3 px-4 my-4 rounded-lg grid grid-cols-3 gap-2 relative">
                            <div class="col-span-1">
                                <div class="flex justify-start items-center gap-4">
                                    <div class="w-8 h-8 rounded-full">
                                        @include('components.avatar', ['avatar_path' => $room->icon ?? 'images/avatar.jpg'])
                                    </div>
                                    <p class="font-bold">{{$room->name}}</p>
                                </div>
                            </div>
                            <div class="col-span-2">
                                <p> {{$room->description}}</p>
                            </div>
                            <div class="absolute top-0 right-0 text-sm mr-2 mt-1  flex justify-end items-center gap-4">
                                <p class="text-gray-400">2 min ago</p>
                                @include('components.countNotification', ['number' => 1])
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
        <!-- column 3 -->
        <div class="col-span-1 w-full h-full bg-[#212540] pl-12 pr-12 py-8">
            <div class="w-full py-2 px-4 bg-red-200">
                <
            </div>
        </div>
    </div>
    <!-- add New Room Form Modal -->
    @include('components.modals.roomFormModal')
    @include('components.modals.searchRoomModal')

    <!-- Import CDN jquery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- Call Ajax handle -->
    <script>
        $(document).ready(function() {
            // Handle event when form submit
            $('#createRoomForm').submit(function(e) {
                e.preventDefault();
                console.log("Form submit!")
                $.ajax({
                    type: 'POST',
                    url: '{{ route("room.store") }}', // Găn route
                    data: $(this).serialize(), // Dữ liệu form
                    success: function(response) {
                        // Handle the success response
                        turnOnNotification(response.message, "success");
                        const room = response.room;
                        if (!room)  return;

                        if (room.icon === null){
                            room.icon = '/images/avatar.jpg';
                        }
                        if (room.description == null){
                            room.description = '';
                        }
                        let html =
                            `<a href="#" class="w-full bg-[#262948] hover:bg-[#4289f3] py-3 px-4 my-4 rounded-lg grid grid-cols-3 gap-2 relative">
                            <div class="col-span-1">
                                <div class="flex justify-start items-center gap-4">
                                    <div class="w-8 h-8 rounded-full">
                                        <img src="${room.icon}" alt="avatar" class="w-full h-full rounded-full border-2 border-red-500" />
                                    </div>
                                    <p class="font-bold">${room.name}</p>
                                </div>
                            </div>
                            <div class="col-span-2">
                                <p>${room.description}</p>
                            </div>
                        </a>`;

                        // Add to top of room list
                        $('#rooms_list').prepend(html);

                        closeModal('addNewRoomFormModal');

                    },
                    error: function(error) {
                        // Handle the error response
                        console.log(error);
                        closeModal('addNewRoomFormModal');
                    },
                });

                $('#createRoomForm')[0].reset();
            });
        });
    </script>
@endsection
