<?php

namespace App\Services;
use Helper;
use App\Requests\PointPutRequest;
class PointService
{
    public function getRequest($request)
    {
    	$inputs = [
    		'name' => $request->name,
    		'number' => $request->number,
    		'start_finish' => $request->start_finish,
    		'description' => $request->description,
    		'address' => $request->address,
    		'heading' => $request->heading,
    		'tel' => $request->tel,
    		'latitude' => $request->latitude,
    		'longitude' => $request->longitude,
			'distance_get_stamp' => $request->distance_get_stamp,
    		'distance_to_next' => $request->distance_to_next,
    		'time_to_next' => $request->time_to_next,
    		'is_member_benefit' => $request->input('is_member_benefit',0), 
    		'site_url' => $request->site_url,
    		'montbell_friend_shop' => $request->montbell_friend_shop
    	];

    	if($request->hasFile('thumbnail')){
            $request->validate([
                'thumbnail' => 'file|max:2048|mimes:jpeg,jpg,png',
            ]);
			
            $filePath = Helper::pointImagePath;
            $file = $request->thumbnail;
            $fileName = $filePath.$file->getClientOriginalName();
            $file->move($filePath,$fileName);
            $inputs['thumbnail'] = $fileName;

			
        }

        if(!empty($request->support)){
        	$inputs['support'] = implode("/",$request->support);
        }
    	return $inputs;
    }

}
