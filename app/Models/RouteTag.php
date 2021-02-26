<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RouteTag extends Model
{
    use HasFactory;

    protected $table = 'route_tag';
    public $timestamps = FALSE;
    protected $hidden = ['pivot'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'route_id',
        'tag_id',
    ];
}
