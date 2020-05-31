<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = [
        'title', 'subject_id', 'user_id', 'class_id', 'authorname', 'description', 'start_date', 'video'
    ];

    protected $table ='courses';

    public function users()
    {
        return $this->belongsToMany('App\User', 'user_course', 'course_id');
    }

    public function enrollments()
    {
        return $this->hasMany('App\Enrollments');
    }

    public function userCourse()
    {
        return $this->hasMany('App\UserCourse');
    }
    
}
