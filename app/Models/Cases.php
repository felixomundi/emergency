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
 
    public function user(){
        return $this->belongsTo(User::class, "user_id", "id");
    }
    public function subcounty(){
        return $this->belongsTo(SubCounty::class, "sub_county_id", "id");
    }
    

}
