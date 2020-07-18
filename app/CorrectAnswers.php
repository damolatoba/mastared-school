<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CorrectAnswers extends Model
{
    protected $fillable = [
        'question_id', 'answer_position'
    ];

    protected $table = "correct_answers";
}
