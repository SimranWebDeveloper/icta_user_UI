<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answers extends Model
{
    use HasFactory;

    protected $table = 'answers';
    protected $timeStamp = false;

    protected $fillable = [
        'surveys_questions_id',
        'name',
        'status'
    ];

    public function surveys_questions()
    {
        return $this->belongsTo(SurveysQuestions::class);
    }
}
