<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;
    protected $table = "departments";
    protected $fillable= [
        "name",
        "status",
    ];
    public function positions(){
        return $this->belongsTo(Position::class, "department_id", "id");
    }
}
