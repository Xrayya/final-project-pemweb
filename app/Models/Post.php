<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'post',
        'parent',
        'user_id'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function parent()
    {
        return $this->belongsTo(Post::class, 'parent');
    }

    public function likes()
    {
        return $this->hasMany(Like::class, 'id_post');
    }
}
