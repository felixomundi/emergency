<?php

namespace App\Models;

use App\Models\User;
use App\Models\Branches;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Staff extends Model
{
    use HasFactory;
    protected $table = "staff";
    protected $fillable = [

        "user_id",
        "staff_number",
        "experience",
        "qualification",
        "date_joined",
        "branch_id",
    ];
    public function user(){
        return $this->belongsTo(User::class, "user_id","id");
    }

    public function _branch(){
        return $this->belongsTo(Branches::class, "branch_id","id");
    }

// public function assigned(){
//     return $this->belongsTo(Branches::class, "branch_id","id");
// }




static function getStaffId($user){
    $data  = self::select("staff.id")
        ->join("users","users.id", "=","staff.user_id")
        ->where("users.id","=",$user)
        ->get();
        return $data;
}




}
