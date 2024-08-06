<?php

namespace App\Models;

use Dyrynda\Database\Support\CascadeSoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Rooms extends Model
{
    use HasFactory,SoftDeletes, CascadeSoftDeletes;

    protected $table = 'rooms';
    protected $fillable = ['name', 'status'];

    public function local_numbers()
    {
        return $this->hasMany(LocalNumbers::class);
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }

}
