<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    public function courses(){ // can call function like $this->courses
        return $this->belongsToMany(Course::class);
    }

    public function searchName(string $name){
        return $this->where("name","like","%".$name."%")->get();
    }
}
