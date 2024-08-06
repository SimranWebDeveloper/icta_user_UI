<?php

namespace App\Models;

use Dyrynda\Database\Support\CascadeSoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comments extends Model
{
    use HasFactory,SoftDeletes, CascadeSoftDeletes;

    public function users()
    {
        return $this->belongsTo(User::class);
    }

    public function kpis()
    {
        return $this->belongsTo(Kpis::class);
    }

}
