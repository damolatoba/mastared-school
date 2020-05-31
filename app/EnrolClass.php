<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EnrolClass extends Model
{
    protected $fillable = [
        'user_id', 'class_id', 'term_id'
    ];

    protected $table = "enrol_class";
}
