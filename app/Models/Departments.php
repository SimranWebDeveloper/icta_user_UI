<?php

namespace App\Models;

use Dyrynda\Database\Support\CascadeSoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Departments extends Model
{
    use HasFactory,SoftDeletes, CascadeSoftDeletes;

    protected $table = 'departments';
    protected $fillable = ['institution','name', 'status'];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function branches()
    {
        return $this->hasMany(Branches::class);
    }

    public function reports()
    {
        return $this->hasMany(Reports::class);
    }

    public function local_numbers()
    {
        return $this->hasMany(LocalNumbers::class);
    }

    public function positions()
    {
        return $this->hasMany(Positions::class);
    }

    public function kpi_positions()
    {
        return $this->hasMany(Kpi_positions::class);
    }

    public function targets()
    {
        return $this->hasMany(Targets::class);
    }
}
