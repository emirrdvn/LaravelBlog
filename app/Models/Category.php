<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function articleCount(){
        return $this->hasMany('App\Models\Article', 'category', 'id')->where('status',1)->count();
    }
    use HasFactory;
}
