<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class County extends Model
{
    use HasFactory;
    protected $table = "counties";
    protected $fillable = [
        "name",
    ];
    public function subcounty(){
        return $this->hasMany(SubCounty::class, "county_id", "id");
    }
}
