<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentAttendance extends Model
{
    use HasFactory;
    protected $table = "student_attendances";
    protected $fillable = [
        "attendance_date",
        "start_time",
        "end_time",
        "content_covered",
        "next_lesson_content",
        "user_id",
        "unit_id",
        "course_id",
        "created_by",
    ];

    public function user(){
        return $this->belongsTo(User::class, "user_id", "id");
    }
    public function server(){
        return $this->belongsTo(User::class, "created_by", "id");
    }
    public function course(){
        return $this->belongsTo(Courses::class, "course_id", "id");
    }
    public function unit(){
        return $this->belongsTo(Units::class, "unit_id", "id");
    }


}
