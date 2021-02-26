<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RoutePoint extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table = 'route_point';
    public $timestamps = FALSE;
    protected $hidden = ['pivot'];

    protected $fillable = [
        'point_id',
        'route_id',
    ];
}
