<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Dyrynda\Database\Support\CascadeSoftDeletes;
use Illuminate\Database\Eloquent\SoftDeletes;

class Meetings extends Model
{
    use HasFactory, CascadeSoftDeletes, SoftDeletes;
    protected $table = 'meetings';
    protected $timeStamp = false;
    protected $fillable = [
        'subject',
        'start_date_time',
        'duration',
        'content',
        'rooms_id',
        'status',
        'type',
        
    ];

    public function rooms()
    {
        return $this->belongsTo(Rooms::class);
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
