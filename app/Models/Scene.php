<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Scene extends Model
{
    use HasFactory, SoftDeletes;

    protected $casts = [
        'thumbnail' => \App\Casts\File::class,
    ];

    protected $fillable = [
        'name',
        'thumbnail',
    ];
    protected $hidden = ['pivot'];

    public function routes()
    {
        return $this->belongsToMany('App\Models\Route', 'route_scene', 'scene_id', 'route_id')->setEagerLoads([]);
    }
}
