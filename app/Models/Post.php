<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Post extends Model
{
    use HasFactory;
    protected $fillable = [
        'content',
        'user_id',
        'visibility',
    ];
    public function photos():BelongsToMany {
        return $this->belongsToMany(Photo::class);
    }
    public $timestamps = true;
}
