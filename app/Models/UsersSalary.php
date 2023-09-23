<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsersSalary extends Model
{
    use HasFactory;
    protected $table= "users_salaries";
    protected $fillable =[
        "user_id",
        "areas_of_work_id",
        "position_id",
        "salary_type_id",
        "total",
        "created_by",
    ];
    public function area(){
        return $this->belongsTo(AreasOfWork::class,"areas_of_work_id", "id");
    }
    public function user(){
        return $this->belongsTo(User::class,"user_id", "id");
    }
    public function position(){
        return $this->belongsTo(Position::class,"position_id", "id");
    }
    public function salaryType(){
        return $this->belongsTo(SalaryType::class,"salary_type_id", "id");
    }
    public function creator(){
        return $this->belongsTo(User::class,"created_by", "id");
    }
}
