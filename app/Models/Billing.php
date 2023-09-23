<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Billing extends Model
{
    use HasFactory;
    protected $table = "billings";
    protected $fillable= [
        "user_id",
        "courses_id",
        "net_days",
        "due_date",
        "total_fees",
        "remarks",
        "billing_date",
        "served_by"
    ];
    public function user(){
        return $this->belongsTo(User::class, "user_id", "id");
    }
    public function user_course(){
        return $this->belongsTo(Courses::class, "courses_id", "id");
    }
    public function biller(){
        return $this->belongsTo(User::class, "served_by", "id");
    }


}
