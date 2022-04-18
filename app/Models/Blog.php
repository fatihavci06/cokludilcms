<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;
    public function language_name(){
      return  $this->hasOne(Language::class, 'id', 'language_id'); 
    }
    public function categories(){
      return  $this->hasMany(blogandCategory::class, 'blog_id', 'id'); 
    }
}
