<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Area extends Model
{
    use HasFactory, SoftDeletes;

    public $table = 'areas';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [
        'id',
        'deleted_at',
        'created_at',
        'updated_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'created_at',
        'updated_at',
        'pivot'
    ];

    protected $with = ['prefecture','photos'];

    public function prefecture()
    {
        return $this->belongsTo('App\Models\Prefecture')->setEagerLoads([]);
    }

    public function routes()
    {
        return $this->hasMany('App\Models\Route')->setEagerLoads([]);
    }

    public function photos()
    {
        return $this->hasMany('App\Models\AreaPhoto')->setEagerLoads([]);
    }
}
