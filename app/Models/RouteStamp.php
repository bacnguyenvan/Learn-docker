<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RouteStamp extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table = 'route_stamp';
    public $timestamps = FALSE;
    protected $hidden = ['pivot'];

    protected $fillable = [
        'stamp_id',
        'route_id',
    ];
}
