<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    use HasFactory;
    protected $table = "positions";
    protected $fillable = [
        "name",
        "status",
        "department_id",
    ];
    public function department(){
        return $this->belongsTo(Department::class, "department_id", "id");
    }
}
