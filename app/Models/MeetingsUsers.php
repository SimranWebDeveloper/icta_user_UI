<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MeetingsUsers extends Model
{
    use HasFactory;

    protected $table = 'meetings_users';
    protected $timeStamp = false;
    protected $fillable = [
        'meetings_id',
        'users_id',
        'participation_status',
    ];

    public function rooms()
    {
        return $this->belongsTo(Meetings::class);
    }

    public function users()
    {
        return $this->belongsTo(User::class, 'users_id');
    }
}
