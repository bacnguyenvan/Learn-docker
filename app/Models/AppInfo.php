<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class AppInfo extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'app_info';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $guarded = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];
    protected $hidden = ['pivot'];
}
