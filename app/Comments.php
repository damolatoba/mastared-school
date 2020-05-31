<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    protected $fillable = [
        'course_id', 'user_id', 'comment'
    ];

    protected $table = "comments";
}
