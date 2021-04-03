<?php 
namespace App\Services;
use Helper;
class LandmarkService{
    public function getInputs($request)
    {
        $inputs = [
            "area_id" => $request->area_id,
            "name" => $request->name,
            "description" => $request->description,
            "category" => $request->category,
            "latitude" => $request->latitude,
            "longitude" => $request->longitude,
            "address" => $request->address,
            "tel" => $request->tel,
            "is_member_benefit" => isset($request->is_member_benefit)?$request->is_member_benefit:0,
            "site_url" => $request->site_url,
            "montbell_friend_shop" => $request->montbell_friend_shop
        ];

        if($request->hasFile('thumbnail')){
            $request->validate([
                'thumbnail' => 'file|max:2048|mimes:jpeg,jpg,png',
            ]);
			
            $filePath = Helper::landmarkImagePath;
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


