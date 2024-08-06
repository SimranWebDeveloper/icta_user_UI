<?php

namespace App\Models;

use Dyrynda\Database\Support\CascadeSoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kpi_positions extends Model
{
    use HasFactory, CascadeSoftDeletes;
    protected $table = 'kpi_positions';
    protected $fillable = [
        'departments_id',
        'branches_id',
        'branches_id',
        'name',
        'status'
    ];

    public function departments()
    {
        return $this->belongsTo(Departments::class);
    }

    public function branches()
    {
        return $this->belongsTo(Branches::class);
    }
}
