<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoomUser extends Model
{
    protected $table = 'room_user';
    protected $fillable = [
        'room_id',
        'user_id',
    ];
}
