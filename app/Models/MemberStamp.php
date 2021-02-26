<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class MemberStamp extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'member_stamp';

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

    protected $with = ['member', 'route', 'stamp'];

    public function member()
    {
        return $this->belongsTo('App\Models\Member')->setEagerLoads([]);
    }

    public function route()
    {
        return $this->belongsTo('App\Models\Route')->setEagerLoads([]);
    }

    public function stamp()
    {
        return $this->belongsTo('App\Models\Stamp')->setEagerLoads([]);
    }
}
