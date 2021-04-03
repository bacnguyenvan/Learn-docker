<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MemberDevice extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'member_device';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'member_id',
        'user_device_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['pivot'];

    public function user_device()
    {
        return $this->belongsTo(UserDevice::class, 'user_device_id', 'id');
    }
}
