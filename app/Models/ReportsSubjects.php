<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ReportsSubjects extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'reports_subjects';
    protected $fillable = [
        'reports_id',
        'project_name',
        'subject'
    ];

    public function reports()
    {
        return $this->belongsTo(Reports::class);
    }
}
