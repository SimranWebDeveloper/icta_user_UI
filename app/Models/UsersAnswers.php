<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsersAnswers extends Model
{
    use HasFactory;

    protected $table = 'users_answers';
    protected $timeStamp = false;
    protected $fillable = [
        'users_id',
        'surveys_id',
        'surveys_questions_id',
        'answer',
    ];

    public function users()
    {
        return $this->belongsTo(User::class);
    }
}
