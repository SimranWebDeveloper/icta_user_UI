<?php

namespace App\Models;

use Dyrynda\Database\Support\CascadeSoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kpis extends Model
{
    use HasFactory,SoftDeletes, CascadeSoftDeletes;

    public function targets()
    {
        return $this->belongsTo(Targets::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function comments()
    {
        return $this->hasMany(Comments::class);
    }
}
