<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Member extends Authenticatable
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'montbell_login_user_id',
        'login_token',
        'member_mbc_no',
        'member_web_no',
        'member_name',
        'mbc_yukokigen_year_month',
        'mbc_update_flg',
        'premium_card_name',
        'card_name',
        'card_category_name',
        'card_img',
        'card_type_renewal_flg',
        'card_type_reenter_flg',
        'member_points',
        'support_card_img',
        'barcode_string',
        'barcode_retention_seconds',
    ];
    protected $hidden = ['pivot'];

    protected $with = ['stamps'];

    public function tracks()
    {
        return $this->hasMany('App\Models\Track')->setEagerLoads([]);
    }

    public function memberDevices()
    {
        return $this->hasMany('App\Models\MemberDevice')->setEagerLoads([]);
    }

    public function stamps()
    {
        return $this->belongsToMany('App\Models\Stamp', 'member_stamp', 'member_id', 'stamp_id')->setEagerLoads([]);
    }

    public function member_stamps()
    {
        return $this->hasMany('App\Models\MemberStamp')->setEagerLoads([]);
    }
}
