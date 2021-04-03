<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MemberNotification extends Model
{
    use HasFactory;
    use SoftDeletes;

    const STATUS_UNSENT = 0;
    const STATUS_SENT = 1;
    const STATUS_ERROR = 2;

    protected $table = 'member_notification';
    protected $guarded = [];
}
