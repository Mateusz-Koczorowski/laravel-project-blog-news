<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'release_date',
        'free_content',
        'premium_content',
        'author_id',
        'image_file_name',
        'alt_text',
    ];

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    protected $casts = [
        'release_date' => 'datetime',
    ];

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function isLikedBy($user)
    {
        if (!$user) {
            return false;
        }

        return $this->likes()->where('user_id', $user->id)->exists();
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
