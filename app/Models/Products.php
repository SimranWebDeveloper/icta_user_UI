<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Products extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'products';
    protected $fillable = [
        'warehouses_id',
        'categories_id',
        'invoices_id',
        'hand_registers_id',
        'unical_id',
        'material_type',
        'avr_code',
        'serial_number',
        'product_name',
        'price',
        'size',
        'inventory_cost',
        'activity_status',
        'status'
    ];

    public function invoices()
    {
        return $this->belongsTo(Invoices::class);
    }

    public function hand_registers()
    {
        return $this->belongsTo(HandRegisters::class);
    }

    public function categories()
    {
        return $this->belongsTo(Categories::class);
    }

    public function appointments()
    {
        return $this->hasOne(Appointments::class);
    }

    public function warehouses()
    {
        return $this->belongsTo(Warehouses::class);
    }
}
