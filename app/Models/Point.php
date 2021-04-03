<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Point extends Model
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
    protected $hidden = ['pivot'];

    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
    ];
}
