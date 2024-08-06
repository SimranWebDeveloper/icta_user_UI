<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PHPUnit\Framework\Attributes\Ticket;

class TicketHistories extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'ticket_histories';
    protected $fillable = [
        'tickets_id',
        'subject',
        'description',
        'class'
    ];

    public function ticket()
    {
        return $this->belongsTo(Tickets::class, 'tickets_id');
    }
}
