<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use App\Models\Blog;
class Tag extends Model
{
    protected $fillable = ['name'];

    public function blogs()
    {
        return $this->hasMany(Blog::class, 'tag_id');
    }
}
