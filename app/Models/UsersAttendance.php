<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsersAttendance extends Model
{
    use HasFactory;
    protected $table = "users_attendances";
    protected $fillable = [
        "attendance_date",
        "user_id",
        "created_by",
        "status",
    ];
    public function user(){
        return $this->belongsTo(User::class, "user_id", "id");
    }
    public function server(){
        return $this->belongsTo(User::class, "created_by", "id");
    }
}
