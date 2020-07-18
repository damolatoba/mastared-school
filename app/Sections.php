<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sections extends Model
{
    protected $fillable = [
        'assignment_id', 'section_name'
    ];

    protected $table = "assignment_sections";
}
