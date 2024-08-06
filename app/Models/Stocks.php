<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Stocks extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'stocks';
    protected $fillable = ['warehouses_id','product_unical_code', 'purchase_count', 'stock_count'];

    public function warehouses()
    {
        return $this->belongsTo(Warehouses::class);
    }
}
