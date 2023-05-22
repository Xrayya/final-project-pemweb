<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_user',
        'id_post',
    ];

    public function posts()
    {
        return $this->hasMany(Post::class, 'id_post');
    }

    public function users()
    {
        return $this->hasMany(User::class, 'id_user');
    }
}
