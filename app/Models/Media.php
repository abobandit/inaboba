<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Media extends Model
{
    use HasFactory;

    protected $fillable = [
        'path',
        'title',
        'description',
        'album_id'
    ];

    public function posts(): BelongsToMany
    {
        return $this->belongsToMany(Post::class,'post_media');
    }

    public function album(): BelongsTo
    {
        return $this->belongsTo(Album::class);
    }

    public $timestamps = true;
}
