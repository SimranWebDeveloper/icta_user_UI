<?php

namespace App\Models;

use Dyrynda\Database\Support\CascadeSoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tickets extends Model
{
    use HasFactory,SoftDeletes, CascadeSoftDeletes;
    protected $table = 'tickets';
    protected $fillable = [
        'user_id',
        'operator_id',
        'helpdesk_id',
        'appointments_id',
        'ticket_reasons_id',
        'ticket_number',
        'status',
        'ticket_status',
        'rate',
        'note'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function operator()
    {
        return $this->belongsTo(User::class, 'operator_id');
    }
    public function helpdesk()
    {
        return $this->belongsTo(User::class, 'helpdesk_id');
    }

    public function appointments()
    {
        return $this->belongsTo(Appointments::class);
    }

    public function ticket_reasons()
    {
        return $this->belongsTo(TicketReasons::class);
    }

    public function ticket_histories(){
        return $this->hasMany(TicketHistories::class);
    }

}
