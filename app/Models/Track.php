<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Track extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'route_id',
        'member_id',
        'name',
        'description',
        'type',
        'total_time',
        'total_distance',
        'max_elevation'
    ];
    protected $hidden = ['pivot'];
    protected $with = ['trackPoints', 'route'];

    public function member()
    {
        return $this->belongsTo('App\Models\Member')->setEagerLoads([]);
    }

    public function trackPoints()
    {
        return $this->hasMany('App\Models\TrackPoint')->setEagerLoads([]);
    }

    public function route()
    {
        return $this->belongsTo('App\Models\Route')->setEagerLoads([]);
    }

    /**
     * Get track (total distance, total elevation, total time) bt Member Id
     *
     * @param  mixed $query
     * @param  mixed $member_id
     * @return void
     */
    public function scopeGetTrackByMemberId($query, $member_id)
    {
        //Get total Elevation
        $sumElevation = DB::table('tracks')->select(DB::raw('SUM(max_elevation) as sum_elevation'))
            ->where('member_id', $member_id);
        //Get total Distance
        $sumDistance = DB::table('tracks')->select(DB::raw('SUM(total_distance) as sum_distance'))
            ->where('member_id', $member_id);
        //Get total Time
        $sumTime = DB::table('tracks')->select(DB::raw('SUM(total_time) as sum_time'))
            ->where('member_id', $member_id);
        //Add Total to Query
        return $query
            ->addSelect([
                '*',
                'sum_distance' => $sumDistance,
                'sum_time' => $sumTime,
                'sum_elevation' => $sumElevation
            ])
            ->where('member_id', $member_id);
    }
}
