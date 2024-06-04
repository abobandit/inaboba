<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\Auth;
class Friend extends User
{
    use HasFactory;

    protected $fillable = [
        'status',
        'user_id',
        'friend_id'
    ];
    static public function usersFriends() {
        return Friend::where([['status','accepted'],['user_id',Auth::id()]])->get();
    }
    public $timestamps = true;
}
