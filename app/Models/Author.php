<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Author extends Model
{
    use HasFactory;
    public function article(){
        return $this->hasMany(Article::class);
    }

    public function likeName(string $name = null){
        return $this->where("name","like","%".$name."%")->get();
    }
}
