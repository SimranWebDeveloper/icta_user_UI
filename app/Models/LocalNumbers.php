<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LocalNumbers extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'local_numbers';
    protected $fillable = ['departments_id', 'branches_id', 'rooms_id' , 'user_id' , 'number'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function departments()
    {
        return $this->belongsTo(Departments::class);
    }

    public function branches()
    {
        return $this->belongsTo(Branches::class);
    }

    public function rooms()
    {
        return $this->belongsTo(Rooms::class);
    }
}
