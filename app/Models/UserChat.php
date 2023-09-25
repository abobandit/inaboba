<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\Pivot;

class UserChat extends Pivot
{
    use HasFactory;
    public $incrementing = true;
    protected $table = 'user_chat';

    protected $fillable = [
        'user_id',
        'chat_id'
    ];
    public function messages(): HasMany
    {
        return $this->hasMany(Message::class);
    }

    public $timestamps = true;
}
