<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Notification extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'notification';
    protected $dates = ['delivery_time'];
    protected $guarded = [];

    public function member_notifications()
    {
        return $this->hasMany(MemberNotification::class, 'notification_id', 'id');
    }
}
