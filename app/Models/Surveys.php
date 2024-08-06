<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Dyrynda\Database\Support\CascadeSoftDeletes;
use Illuminate\Database\Eloquent\SoftDeletes;


class Surveys extends Model
{
    use HasFactory, CascadeSoftDeletes, SoftDeletes;

    protected $table = "surveys";
    protected $timeStamp = false;
    protected $fillable = [
        'name',
        'is_anonym',
        'expired_at',
        'status'        
    ];

    public function surveys_questions()
    {
        return $this->hasMany(SurveysQuestions::class);
    }

     public function users()
    {
        return $this->belongsToMany(User::class, 'surveys_users', 'surveys_id', 'users_id')
                    ->withTimestamps();
    }

}
