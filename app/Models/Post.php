<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Post extends Model
{
    use HasFactory;
    protected $fillable = [
        'content',
        'user_id',
        'visibility',
    ];
    public function media():BelongsToMany {
        return $this->belongsToMany(Media::class,'post_media');
    }
    public function reposts():HasMany{
        return $this->hasMany(Repost::class);
    }
    public function user():BelongsTo{
        return $this->belongsTo(User::class);
    }
    public $timestamps = true;
}
