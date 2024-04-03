@extends('layouts.chatLayout')
@section('title')
    Chat
@endsection
@section('content')
    <form id="sendMess">
        @csrf
        <div class="grid grid-cols-3">
            <div class="col-span-1">
                <div class="flex justify-start items-center gap-4 absolute bottom-0 left-20">
                    <input type="text" name="mes" value="" class="w-96 p-4">
                    <button>submit</button>
                </div>
            </div>
        </div>
    </form>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
        let room_id = {{ $room_id }}
        Pusher.logToConsole = true;

        var pusher = new Pusher('40a39159586441a94da5', {
            cluster: 'ap1'
        });

        var channel = pusher.subscribe('channel-'+room_id);
        channel.bind('chat-event', function(data) {
            alert(JSON.stringify(data));
        });

        $(document).ready(function() {
            // Handle event when form submit
            $('#sendMess').submit(function(e) {
                e.preventDefault();
                console.log("Form submit!")
                $.ajax({
                    type: 'POST',
                    url: '{{ route("sendMes") }}', // Găn route
                    data: $(this).serialize(), // Dữ liệu form
                    success: function(response) {


                    },
                    error: function(error) {
                        // Handle the error response
                        console.log(error);
                        closeModal('addNewRoomFormModal');
                    },
                });

                $('#sendMess')[0].reset();
            });
        });
    </script>
@endsection
