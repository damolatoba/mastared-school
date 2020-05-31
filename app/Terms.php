<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Terms extends Model
{
    protected $fillable = [
        'term_name', 'start_date', 'end_date', 'start_term', 'end_term', 'term_status'
    ];

    protected $table = "terms";
}
