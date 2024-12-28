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
}
