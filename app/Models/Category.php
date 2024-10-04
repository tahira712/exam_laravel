<?php

namespace App\Models; 

use Illuminate\Database\Eloquent\Model;
use App\Models\Blog; 

class Category extends Model
{
    protected $fillable = ['name'];

    public function blogs()
    {
        return $this->hasMany(Blog::class, 'category_id');
    }
}
