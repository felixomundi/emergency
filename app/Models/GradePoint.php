<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GradePoint extends Model
{
    use HasFactory;
    protected $table ="grade_points";
    protected $fillable =[
        "grade_name","grade_point","start_point","end_point","remarks","start_marks","end_marks","fong_id"

    ];

}
