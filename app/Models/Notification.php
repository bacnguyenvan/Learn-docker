<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Notification extends Model
{
    use  HasFactory, SoftDeletes;

    protected $guarded = [
        'deleted_at',
    ];
    protected $hidden = ['pivot'];

    public function notificationTypes()
    {
        return $this->belongsTo('App\Models\NotificationType', 'type_id')->setEagerLoads([]);
    }
}
