<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CourseAttendance extends Model
{
    protected $fillable = [
        'user_id', 'course_id', 'status'
    ];

    protected $table ='course_attendance';
    
}
