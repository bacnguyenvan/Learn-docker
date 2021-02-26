<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tag extends Model
{
    use  HasFactory, SoftDeletes;

    protected $fillable = [
        'name'
    ];
    protected $hidden = ['pivot'];

    public function routes()
    {
        return $this->belongsToMany('App\Models\Route', 'route_tag', 'tag_id', 'route_id')->setEagerLoads([]);
    }
}
