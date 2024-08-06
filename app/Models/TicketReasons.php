<?php

namespace App\Models;

use Dyrynda\Database\Support\CascadeSoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TicketReasons extends Model
{
    use HasFactory,SoftDeletes, CascadeSoftDeletes;
    protected $table = 'ticket_reasons';
    protected $fillable = ['reason', 'status'];

    public function tickets()
    {
        return $this->hasMany(Tickets::class);
    }
}
