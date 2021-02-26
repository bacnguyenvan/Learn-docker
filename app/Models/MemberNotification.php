<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class MemberNotification extends Model
{
    use  HasFactory, SoftDeletes;

    protected $fillable = [
        'member_id',
        'notification_id',
        'read_at',
    ];
    protected $table = 'member_notification';
    protected $hidden = ['pivot'];
    protected $with = ['notification'];

    public $timestamps = FALSE;

    public function scopeGetNotificationsByMemberId($query, $member_id)
    {
        //Get count notification unread
        $unread_count = DB::table('member_notification')->select(DB::raw('COUNT(member_id) as unread_count'))
            ->where('member_id', $member_id)->where('read_at', null);
        //Add count to Query
        return $query
            ->addSelect([
                '*',
                'unread_count' => $unread_count,
            ])
            ->where('member_id', $member_id);
    }

    public function notification()
    {
        return $this->belongsTo('App\Models\Notification')->setEagerLoads([]);
    }
}
