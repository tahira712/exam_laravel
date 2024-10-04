<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Tag; 

class Blog extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'content', 'category_id', 'tag_id', 'image'];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function tag()
    {
        return $this->belongsTo(Tag::class, 'tag_id');
    }
}
