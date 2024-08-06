<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SurveysQuestions extends Model
{
    use HasFactory;
    protected $timestamp = false;
    protected $table = 'surveys_questions';
    protected $fillable = [
        'surveys_id',
        'question',
        'input_type',
        'status'
    ];

    public function surveys()
    {
        return $this->belongsTo(Surveys::class);
    }

    public function answers()
    {
        return $this->hasMany(Answers::class);
    }
}
