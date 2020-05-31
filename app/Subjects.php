<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subjects extends Model
{
    protected $fillable = [
        'subject', 'status'
    ];

    protected $table ='subjects';
    
}
