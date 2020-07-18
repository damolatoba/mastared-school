<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Options extends Model
{
    protected $fillable = [
        'question_id', 'option_position', 'option_value'
    ];

    protected $table = "question_options";
}
