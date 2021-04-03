<?php

namespace App\Repositories;

use App\Contracts\TrackContract;
use App\Models\Track;
use App\Traits\ResponseAPI;

class TrackRepository  implements TrackContract
{
    use ResponseAPI;

    /**
     *
     */
    public function index()
    {
        try {
            $tracks = Track::all();

            return $this->success('Get all track success', \App\Http\Resources\TrackResource::collection($tracks), 200);
        } catch (\Exception $err) {
            throw $err;
        }
    }

    /**
     *
     */
    public function show($track)
    {
        try {
            return $this->success('Get track success', \App\Http\Resources\TrackResource::make($track), 200);
        } catch (\Exception $err) {
            throw $err;
        }
    }

    /**
     *
     */
    public function store($request)
    {
        try {
            $track = Track::create($request->all());

            return $this->success('Insert track success', \App\Http\Resources\TrackResource::make($track), 200);
        } catch (\Exception $err) {
            throw $err;
        }
    }

    /**
     *
     */
    public function update($request, $track)
    {
        try {
            foreach ($request->all() as $key => $value) {
                $track[$key] = $value;
            }
            $track->save();

            return $this->success('Update track success', \App\Http\Resources\TrackResource::make($track), 200);
        } catch (\Exception $err) {
            throw $err;
        }
    }

    /**
     *
     */
    public function destroy($track)
    {
        try {
            $track->delete();

            return $this->success('Delete track success', \App\Http\Resources\TrackResource::make($track), 200);
        } catch (\Exception $err) {
            throw $err;
        }
    }

    public function storeMulti($request)
    {
        try {
            $jsonData = json_decode($request['data']);
            $tracks = [];
            foreach ($jsonData as  $value) {
                if (count($tracks) == 0)
                    array_push($tracks, [
                        'route_id' => $value->route_id,
                        'member_id' => $request['member_id'],
                        'name' => $request['name'],
                        'description' => $request['description'],
                        'type' => $request['type'],
                        'is_finished' => $value->status
                    ]);
                else {
                    $checkTrack = false;
                    foreach ($tracks as  $track) {
                        if ($track['route_id'] == $value->route_id) $checkTrack = true;
                    }
                    if (!$checkTrack)   array_push($tracks, [
                        'route_id' => $value->route_id,
                        'member_id' => $request['member_id'],
                        'name' => $request['name'],
                        'description' => $request['description'],
                        'type' => $request['type'],
                        'is_finished' => $value->status
                    ]);
                }
            }
            for ($i = 0; $i < count($tracks); $i++) {
                $tracks[$i]['total_time'] = 0;
                $tracks[$i]['total_distance'] = 0;
                $tracks[$i]['total_elevation'] = 0;
                foreach ($jsonData as  $value) {
                    if ($value->route_id == $tracks[$i]['route_id']) {
                        if ($tracks[$i]['total_time'] < $value->journey_time) $tracks[$i]['total_time'] = $value->journey_time;
                        if ($tracks[$i]['total_distance'] < $value->range) $tracks[$i]['total_distance'] = $value->range;
                        if ($tracks[$i]['total_elevation'] < $value->total_elevation) $tracks[$i]['total_elevation'] = $value->total_elevation;
                    }
                }
            };

            foreach ($tracks as $track) {
                $trackValue = \App\Models\Track::where('route_id', $track['route_id'])->where('member_id', $track['member_id'])->where('is_finished', 0)->get();
                if (count($trackValue) > 0) {
                    $trackData = \App\Models\Track::find($trackValue[0]['id']);
                    $trackData['total_time'] = $track['total_time'];
                    $trackData['total_distance'] = $track['total_distance'];
                    $trackData['total_elevation'] = $track['total_elevation'];
                    $trackData['is_finished'] = $track['is_finished'];
                    $trackData->save();
                } else
                    $trackData =  \App\Models\Track::create((array) $track);
                foreach ($jsonData as  $value) {
                    $trackPoint = (array)$value;
                    if ($value->route_id == $track['route_id']) {
                        unset($trackPoint['id']);
                        $trackPoint['track_id'] = $trackData['id'];
                        $trackPoint['data'] = 'xxx';
                        $trackPoint['is_finished'] =  $trackPoint['status'];

                        \App\Models\TrackPoint::create((array) $trackPoint);
                    }
                }
            }

            $status = true;
            return $this->success('Insert track point success', $status, 200);
        } catch (\Exception $err) {
            throw $err;
        }
    }
}
