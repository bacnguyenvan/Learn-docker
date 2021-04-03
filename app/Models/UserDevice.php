<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDevice extends Model
{
    use HasFactory;

    protected $table = 'user_device';
    protected $fillable = [
        'device_token',
        'device_agent',
        'fcm_token',
    ];

    public function member_devices()
    {
        return $this->hasMany(MemberDevice::class, 'user_device_id', 'id');
    }

    public function members()
    {
        return $this->belongsToMany(Member::class, 'member_device', 'user_device_id', 'member_id');
    }

    public function updateDeviceInfo($device_token, array $device_info)
    {
        return static::updateOrCreate(
            ['device_token' => $device_token],
            $device_info
        );
    }
}
