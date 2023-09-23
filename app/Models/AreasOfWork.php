<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AreasOfWork extends Model
{
    use HasFactory;
    protected $table = "areas_of_works";
    protected $fillable= [
        "name",
        "status",
    ];
}
