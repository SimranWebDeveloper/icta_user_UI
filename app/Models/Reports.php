<?php

namespace App\Models;

use Dyrynda\Database\Support\CascadeSoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Reports extends Model
{
    use HasFactory,SoftDeletes, CascadeSoftDeletes;
    protected $table = 'reports';
    protected $fillable = ['departments_id','branches_id', 'user_id' ,'report_date', 'status'];


    public function departments()
    {
        return $this->belongsTo(Departments::class);
    }

    public function branches()
    {
        return $this->belongsTo(Branches::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function reports_subjects()
    {
        return $this->hasMany(ReportsSubjects::class);
    }
}
