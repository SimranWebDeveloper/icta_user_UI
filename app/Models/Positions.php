<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Positions extends Model
{
    use HasFactory,SoftDeletes, SoftDeletes;
    protected $table = 'positions';
    protected $fillable = ['departments_id', 'branches_id', 'name', 'count', 'report_receiver' ,'status'];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function departments()
    {
        return $this->belongsTo(Departments::class);
    }

    public function branches()
    {
        return $this->belongsTo(Branches::class);
    }
}
