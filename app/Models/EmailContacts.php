<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EmailContacts extends Model
{
    use HasFactory;
    use Sluggable;
    protected $table = "email_contacts";
    protected $fillable = [

        "user_id", "subject", "message", "slug", "status", "priority",
    ];

    public function sluggable(): array
        {
            return [
                'slug' => [
                    'source' => 'subject',
                ]
            ];
    }
    public function user(){
        return $this->belongsTo(User::class, "user_id", "id");
    }
    public function emailreplies(){
        return $this->hasMany(EmailReply::class,"email_contact_id", "id");
    }
}
