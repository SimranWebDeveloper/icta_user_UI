<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bookings extends Model
{
    use HasFactory;
    protected $table = 'bookings';
    protected $fillable = ['users_id', 'rooms_id', 'start_date_time', 'end_date_time'];

    public function users()
    {
        return $this->belongsTo(User::class);
    }

    public function rooms()
    {
        return $this->belongsTo(Rooms::class);
    }

}
