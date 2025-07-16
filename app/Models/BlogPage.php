<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class BlogPage extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'excerpt',
        'content',
        'author_id',
        'is_published',
        'published_at',
        'image_url', // ✅ Add this line
    ];

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }
}
