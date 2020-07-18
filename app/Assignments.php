<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Assignments extends Model
{
    protected $fillable = [
        'teacher_id', 'lecture_id', 'subject_id', 'class_id', 'publish_status', 'assignment_type', 'has_sections', 'answerable_questions'
    ];

    protected $table = "assignments";
}
