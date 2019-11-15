<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BlogPost extends Model
{
    use SoftDeletes;

    public function category(){

        return $this->belongsTo(BlogCategory::class); //отношение post.category_id -> category.id
    }

    public function user(){

        return $this->belongsTo(User::class); //отношение post.user_id -> user.id
    }
}
