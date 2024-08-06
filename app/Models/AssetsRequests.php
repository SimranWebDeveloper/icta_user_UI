<?php

namespace App\Models;

use Dyrynda\Database\Support\CascadeSoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AssetsRequests extends Model
{
    use HasFactory, SoftDeletes, CascadeSoftDeletes;

    protected $table = 'assets_requests';
    protected $fillable = ['user_id', 'content'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function assets_requests_details()
    {
        return $this->hasMany(AssetsRequestsDetails::class);
    }

}

