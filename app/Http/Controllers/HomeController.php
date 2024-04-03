<?php

namespace App\Http\Controllers;

use App\Events\MessageSent;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
  /*  public function __construct()
    {
        $this->middleware('auth');
    }*/

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function chat(){
        return view('content.chat', ["room_id" => 1]);
    }

    public function sendMes(Request $request){
        $room_id = 1;
        event(new MessageSent($request->all()["mes"], $room_id));
    }
}
