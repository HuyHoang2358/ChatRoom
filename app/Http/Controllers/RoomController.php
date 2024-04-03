<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\JsonResponse;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Contracts\View\Factory;
class RoomController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:web');
    }

    public function index(): View|Application|Factory
    {
        $joined_rooms = Auth::user()->rooms;
        $rooms = Room::where('owner_id','=', Auth::user()->id)->get();
       /* echo "<pre>";
        print_r($rooms[0]->users);
        echo "</pre>";
        exit();*/

        return view('content.chatRoom', ['rooms' => $rooms,'joined_rooms' => $joined_rooms]);
    }

    public function storeRoom(Request $request): JsonResponse
    {
        $input = $request->all();

        // TODO: Create a new room
        $room = Room::create([
            'name' => $input['room_name'],
            'icon' => $input['room_icon'],
            'description' => $input['room_description'],
            'owner_id' => Auth::user()->id
        ]);
        $message = "Created new Room";

        return response()->json(["message" => $message, "room" => $room], 200);
    }

    public function search(Request $request): JsonResponse
    {
        $search_room_name = $request->input('search_room_name');

        $user = Auth::user();

        $user ? $owner_room_ids = $user->myRooms->pluck('id') : $owner_room_ids = [];
        $joined_room_ids = $user->rooms->pluck('id'); // [1,2,3]
        // concat joined_room_ids with owner_room_ids
        $joined_room_ids = $joined_room_ids->merge($owner_room_ids);
        if ($search_room_name != ""){
            $query = "";
            for($i=0;$i<strlen($search_room_name);$i++){
                $query = $query.'%'.$search_room_name[$i];
            }
            $rooms = Room::whereNotIn('id', $joined_room_ids)->where('name', 'like', $query.'%')->get();
        } else {
            $rooms = Room::whereNotIn('id', $joined_room_ids)->get();
        }
        return response()->json($rooms, 200);
    }

    public function join(Request $request): JsonResponse
    {
        $user = Auth::user();
        $input = $request->all();
        $room = Room::find($input['room_id']);

        if($user && $room){
            $room->users()->attach($user->id);
        }

        $message = "You have joined the room";

        return response()->json(["message" => $message, "room" => $room], 200);
    }
}
