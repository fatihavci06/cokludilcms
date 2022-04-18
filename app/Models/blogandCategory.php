<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class blogandCategory extends Model
{
    use HasFactory;
    public function category_name(){
      return  $this->hasOne(blogCategory::class, 'id', 'category_id'); 
    }
}
