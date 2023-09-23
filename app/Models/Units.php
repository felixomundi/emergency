<?php

namespace App\Models;

use App\Models\Staff;
use App\Models\Courses;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Units extends Model
{
    use HasFactory;
    protected $table="units";
    protected $fillable= [
        "unit_code",
        "title",
        "status",
        "courses_id",
        "staff_id",
        "unit_duration",
        "pass_marks",
        "full_marks",
    ];
    public function course(){
        return $this->belongsTo(Courses::class, "courses_id", "id");
    }
    public function staffs(){
        return $this->belongsTo(Staff::class, "staff_id", "id");
    }


}
