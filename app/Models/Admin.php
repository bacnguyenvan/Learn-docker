<?php

namespace App\Models;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Admin extends Authenticatable
{
	use HasApiTokens, HasFactory, Notifiable, SoftDeletes;
	
	protected $tables = 'admins';
    
    protected $fillable = [
        'name','email','password','access_token','level','access_token'
    ];

    public static function getAdminByAccessToken($token)
    {
        $admin = self::whereNotNull('access_token')->where('access_token', $token)->first();
        return $admin;
    }
    public static function checkTokenValid($token)
    {
    	$check = self::getAdminByAccessToken($token);
    	if(!empty($check)) return true;
    	return false;
    }

    public static function removeAccessToken($token)
    {
        $admin = self::getAdminByAccessToken($token);
        if(!empty($admin)){
            $admin->update(['access_token' => null]);
            return true;
        }

        return false;
    }

}
