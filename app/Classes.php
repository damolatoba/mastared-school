<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Classes extends Model
{
    protected $fillable = [
        'class_name', 'class_level'
    ];

    protected $table = "classes";
}
