<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tag extends Model
{
    use  HasFactory, SoftDeletes;

    const KEYWORD_ACTIVE = 1;

    protected $fillable = [
        'name','column_space','is_keyword'
    ];
    protected $hidden = ['pivot'];

    public function routes()
    {
        return $this->belongsToMany('App\Models\Route', 'route_tag', 'tag_id', 'route_id')->setEagerLoads([]);
    }

    public static function getListTagsActive()
    {
        return self::where('is_keyword',self::KEYWORD_ACTIVE)->get();
    }
}
