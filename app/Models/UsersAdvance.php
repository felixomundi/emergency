<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UsersAdvance extends Model
{
    use HasFactory;
    protected $table ="users_advances";
    protected $fillable = [
       "user_id",
       "period",
       "installment",
       "effective_date",
       "closing_date",
       "amount",
       "status",
       "created_by",
       "purpose_id",
       "duration",

    ];
    public function user(){
        return $this->belongsTo(User::class, "user_id", "id");
    }
    public function server(){
        return $this->belongsTo(User::class, "created_by", "id");
    }
    public function purpose(){
        return $this->belongsTo(Purpose::class, "purpose_id", "id");
    }
}
