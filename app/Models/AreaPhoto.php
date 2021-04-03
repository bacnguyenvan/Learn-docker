<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class AreaPhoto extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'area_photos';
    protected $fillable = ['area_id','url','caption'];
    public static function deleteAreas($area_id)
    {
        return self::where('area_id',$area_id)->delete();
    }
}
