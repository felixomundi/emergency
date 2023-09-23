<?php

namespace App\Models;

use App\Models\Units;
use App\Models\Student;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Courses extends Model
{
    use HasFactory;
    protected $table = "courses";
    protected $fillable =[

        "title", "status","course_duration",
    ];

    public function units(){
        return $this->hasMany(Units::class, "courses_id", "id");
    }

    public function _students(){
        return $this->belongsTo(Student::class, "courses_id", "id");
    }


    static public function getMyCourses($user){
        $return  = Courses::select("courses.id", "courses.title as course", "assigned_courses.created_at as created_at")
        ->join("assigned_courses","assigned_courses.courses_id", "=", "courses.id")
        ->where("assigned_courses.user_id","=", [$user]);
    $return = $return ->orderBy("courses.id", "desc")->get();
    return $return;
    }

 static  public function getSubjects($course_id){
        return  Courses::select(
            "units.id as id",
            "units.title as title",
        // "units.pass_marks as pass_mark","units.full_marks as full_mark",
     )
        ->join("units", "units.courses_id", "=", "courses.id")
        ->where("courses.id", "=", $course_id)
        ->where("units.status","=", [0])
        ->get();
        }

    static public function getStudentUnits($studentCourseId){
return Courses::select("units.title as title", "units.unit_code as unit_code","units.unit_duration as unit_duration")
    ->join("units","units.courses_id", "=", "courses.id")
    ->where("courses.id", "=", $studentCourseId)
    ->where("units.status", "=", 0)
    ->get();
    }
}
