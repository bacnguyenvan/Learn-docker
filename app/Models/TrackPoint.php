<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrackPoint extends Model
{
    use HasFactory;
    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
    ];
    protected $hidden = ['pivot'];

    public function track()
    {
        return $this->belongsTo('App\Models\Track')->setEagerLoads([]);
    }
}
