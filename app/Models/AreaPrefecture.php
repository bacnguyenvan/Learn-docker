<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AreaPrefecture extends Model
{
    use HasFactory;

    protected $table = 'area_prefecture';
    protected $fillable = ['area_id', 'prefecture_id'];
}
