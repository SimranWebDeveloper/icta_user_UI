<?php

namespace App\Models;

use Dyrynda\Database\Support\CascadeSoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Targets extends Model
{
    use HasFactory,SoftDeletes, CascadeSoftDeletes;

    public function departments()
    {
        return $this->belongsTo(Departments::class);
    }

    public function kpis()
    {
        return $this->hasMany(Kpis::class);
    }
}
