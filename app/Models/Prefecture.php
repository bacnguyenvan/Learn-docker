<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Prefecture extends Model
{
        use  HasFactory, SoftDeletes;

        protected $fillable = ['regions_id', 'name'];
        protected $hidden = ['pivot'];

        public function region()
        {
                return $this->belongsTo('App\Models\Region')->setEagerLoads([]);
        }

        public function areas()
        {
                return $this->hasMany('App\Models\Area')->setEagerLoads([]);
        }
}
