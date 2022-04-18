<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class blogCategory extends Model
{
    use HasFactory;
    public function language_name(){
      return  $this->hasOne(Language::class, 'id', 'language_id'); 
    }
}
