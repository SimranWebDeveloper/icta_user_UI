<?php

namespace App\Models;

use Dyrynda\Database\Support\CascadeSoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vendors extends Model
{
    use HasFactory,SoftDeletes, CascadeSoftDeletes;

    protected $table = 'vendors';
    protected $fillable = ['name', 'email', 'relevant_person', 'phone_number' ,'status'];

    public function invoices()
    {
        return $this->hasMany(Invoices::class);
    }

    public function hand_registers()
    {
        return $this->hasMany(HandRegisters::class);
    }

}
