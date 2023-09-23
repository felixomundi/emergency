<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmailReply extends Model
{
    use HasFactory;
    protected $table = "email_replies";
    protected $fillable = [

        "email_contact_id", "response"
    ];
}
