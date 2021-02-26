<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Activity extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'name'
    ];
    protected $hidden = ['pivot'];

    public function routes()
    {
        return $this->belongsToMany('App\Models\Route', 'route_activity', 'activity_id', 'route_id')->setEagerLoads([]);
    }
}
