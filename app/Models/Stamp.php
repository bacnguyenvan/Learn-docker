<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Stamp extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $casts = [
        'thumbnail' => \App\Casts\File::class,
    ];

    protected $with = ['members'];

    protected $fillable = [
        'name',
        'description',
        'latitude',
        'longitude',
        'thumbnail',
        'type',
    ];
    protected $hidden = ['pivot'];

    public function routes()
    {
        return $this->belongsToMany('\App\Models\Route', 'route_stamp', 'stamp_id', 'route_id')->setEagerLoads([]);
    }

    public function member_stamps()
    {
        return $this->hasMany('\App\Models\MemberStamp')->setEagerLoads([]);
    }

    public function members()
    {
        return $this->belongsToMany('App\Models\Member', 'member_stamp', 'stamp_id', 'member_id')->setEagerLoads([]);
    }
}
