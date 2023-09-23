<?php

namespace App\Models;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AssignedCourses extends Model
{
    use HasFactory;
    protected $table = "assigned_courses";
    protected $fillable =[
        "courses_id", "user_id",
    ];


static public function getMyCourses($teacher){
    return AssignedCourses::select("assigned_courses.*", "courses.title as course",)
    ->join("courses", "courses.id", "=", "assigned_courses.courses_id")
    ->where("assigned_courses.staff_id", "=", $teacher)
    ->get();
    }

    public  function useR(){
        return  $this->belongsTo(User::class, "user_id", "id");
    }

    public  function assigned_course(){
        return  $this->belongsTo(Courses::class, "courses_id", "id");
    }


}
