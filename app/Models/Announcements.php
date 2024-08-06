<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Dyrynda\Database\Support\CascadeSoftDeletes;



class Announcements extends Model
{
    use HasFactory, CascadeSoftDeletes,SoftDeletes ;
    protected $table = 'announcements';
    protected $timeStamp = false;
    protected $fillable = [
        'title',
        'content',
        'start_date',
        'end_date',
        'image',
        'status'
    ];
}
