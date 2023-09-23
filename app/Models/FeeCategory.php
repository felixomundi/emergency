<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeeCategory extends Model
{
    use HasFactory;
    protected $table='fee_categories';
    protected $fillable = [
        "name",
        "user_id",
    ];

   public function user_cred(){
    return $this->belongsTo(User::class, "user_id", "id");
    }

}