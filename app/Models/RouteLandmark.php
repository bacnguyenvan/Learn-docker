<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RouteLandmark extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table = 'route_landmark';
    public $timestamps = FALSE;
    protected $hidden = ['pivot'];

    protected $fillable = [
        'route_id',
        'landmark_id',
    ];
}
