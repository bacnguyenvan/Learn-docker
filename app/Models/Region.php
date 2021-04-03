<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Region extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'name'
    ];
    protected $hidden = ['pivot'];

    public function prefectures()
    {
        return $this->hasMany('App\Models\Prefecture')->setEagerLoads([]);
    }
}
