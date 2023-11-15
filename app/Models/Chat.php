<?php

namespace App\Models;

use App\Http\Resources\UserChatResource;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Chat extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'isPrivate',
    ];

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'user_chat')
            ->using(UserChat::class)
            ->withPivot(['id']);
    }
    public function userChats():HasMany{
        return $this->hasMany(UserChat::class);
    }
    public $timestamps = true;
}
