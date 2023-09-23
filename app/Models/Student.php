<?php

namespace App\Models;

use App\Models\User;
use App\Models\Courses;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Student extends Model
{
    use HasFactory;
    protected $table="students";

    protected $fillable= [

        "courses_id",
        "user_id",
        "admission_number",
        "branch_id",

    ];

    public function user(){
        return $this->belongsTo(User::class, "user_id","id");
    }

    public function branch(){
        return $this->belongsTo(Branches::class, "branch_id","id");
    }


    public function Course(){
        return $this->hasOne(Courses::class, "courses_id","id");
    }
}
