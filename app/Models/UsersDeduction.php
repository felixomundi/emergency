<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UsersDeduction extends Model
{
    use HasFactory;
    protected $table ="users_deductions";
    protected $fillable = [
       "user_id",
       "deduction_name",
       "effective_date",
       "closing_date",
       "amount",
       "status",
       "created_by",
    ];
    public function user(){
        return $this->belongsTo(User::class, "user_id", "id");
    }
    public function server(){
        return $this->belongsTo(User::class, "created_by", "id");
    }
}
