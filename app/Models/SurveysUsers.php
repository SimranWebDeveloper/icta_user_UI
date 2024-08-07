<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SurveysUsers extends Model
{
    use HasFactory;
    protected $table = 'surveys_users';
    protected $timeStamp = false;
    protected $fillable = [
        'surveys_id',
        'users_id',
        'is_answered',
    ];

   

    public function users()
    {
        return $this->belongsTo(User::class, 'users_id');
    }
}
