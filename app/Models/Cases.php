<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cases extends Model
{
    use HasFactory;
    protected $table = "cases";
    protected $fillable = [
        "user_id",
        "sub_county_id",
        "status",
        "title",
        "message",
    ];
}
