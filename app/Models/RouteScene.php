<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RouteScene extends Model
{
    use HasFactory;

    protected $table = 'route_scene';
    public $timestamps = FALSE;
    protected $hidden = ['pivot'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'route_id',
        'scene_id',
    ];
}
