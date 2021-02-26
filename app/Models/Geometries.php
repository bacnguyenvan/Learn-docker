<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Geometries extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $timestamps = FALSE;

    protected $hidden = ['pivot'];

    protected $guarded = [
        'id',
    ];
}
