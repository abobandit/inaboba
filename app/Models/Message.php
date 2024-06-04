<?php

namespace App\Models;

use http\Encoding\Stream\Deflate;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class   Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_chat_id',
        'text'
    ];
    public function userChat(): BelongsTo
    {
        return $this->belongsTo(UserChat::class);
    }

    public $timestamps = true;
}
