<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;
    protected $table = 'rooms';
    protected $fillable = [
        'name',
        'icon',
        'owner_id'
    ];
    protected $with = ['owner'];

    public function owner(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'owner_id', 'id');
    }

    public function users(): \Illuminate\Database\Eloquent\Relations\MorphMany
    {
        return $this->morphMany(User::class, 'roomable');
    }
}
