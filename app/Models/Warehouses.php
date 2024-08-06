<?php

namespace App\Models;

use Dyrynda\Database\Support\CascadeSoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Warehouses extends Model
{
    use HasFactory,SoftDeletes, CascadeSoftDeletes;
    protected $table = 'warehouses';
    protected $fillable = ['name', 'address', 'status'];

    public function stocks()
    {
        return $this->hasMany(Stocks::class);
    }

    public function products()
    {
        return $this->hasMany(Products::class);
    }


}
