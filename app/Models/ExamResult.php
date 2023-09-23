<?php

namespace App\Models;

use App\Models\User;
use App\Models\Units;
use App\Models\Courses;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ExamResult extends Model
{
    use HasFactory;
    protected $table ="exam_results";

    protected $fillable =[

        "student_id",
        "marks",
        "courses_id",
        "unit_id",
    ];

// public function studentresult(){
//     return $this->belongsTo(Student::class, "student_id","id");
// }
public function course_name(){
    return $this->belongsTo(Courses::class, "courses_id", "id");
}

public function users(){
    return $this->belongsTo(User::class, "user_id", "id");
}

public function student_name(){
    return $this->belongsTo(Student::class, "student_id", "id");
}


public function unit_name(){
    return $this->belongsTo(Units::class, "unit_id", "id");
}


}
