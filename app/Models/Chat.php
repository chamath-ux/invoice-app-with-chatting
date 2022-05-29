<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Chat extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function users()
    {
        return $this->belongsTo(User::class,'sender_id','id');
    }

    public function receivers()
    {
        return $this->hasOne(User::class,'id','receive_user_id');
    }
}
