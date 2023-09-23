<?php

namespace App\Models;

use App\Models\FeeCategory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FeeStructure extends Model
{
    use HasFactory;
    protected $table='fee_structures';
    protected $fillable = [

        "courses_id",
        "fee_category",
        "user_id",
        "amount",
    ];

    public function user(){
        return $this->belongsTo(User::class, "user_id", "id");
    }
    public function course(){
        return $this->belongsTo(Courses::class, "courses_id", "id");
    }
    public function fee_category_name(){
        return $this->belongsTo(FeeCategory::class, "fee_category", "id");
    }
}
