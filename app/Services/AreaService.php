<?php 
namespace App\Services;
use App\Http\Helpers\Helper;
class AreaService{
    public function getRequest($request)
    {
        $inputs = [
            'prefecture_id' => $request->prefecture_id,
            'number' => $request->number,
            'name' => $request->name,
            'slogan' => $request->slogan,
            'description' => $request->description,
            'latitude' => $request->latitude,
            'longtitude' => $request->longtitude,
            'zoom_level' => $request->zoom_level,
            'catalog_file' => $request->catalog_file,
            'map_file' => $request->map_file,
            'latitude_in_region' => $request->latitude_in_region,
            'longtitude_in_region' => $request->longtitude_in_region,
        ];

        return $inputs;
    }

    public function createAreaPhotos($request,$area)
    {
        if($request->hasFile('images')){
            $filePath = Helper::areaImagePath;
            
            foreach($request->images as $index => $file){
                $fileName = $filePath.$file->getClientOriginalName();
                $file->move($filePath,$fileName);
                
                \App\Models\AreaPhoto::create([
                    'area_id' => $area['id'],
                    'url' => $fileName,
                    'caption' => !empty($request->captions[$index])?$request->captions[$index]:''
                ]);
            }
        }
    }

    public function updateAreaPhotos($request,$area)
    {
        $filePath = Helper::areaImagePath;

        $photosKey = $request->photosKey; 
        $photosKeyArray = !empty($photosKey)? explode("|",trim($photosKey,"|")):[];
        
        foreach($photosKeyArray as $key){
            $idKey = $key . '_id';   
            $imgKey = $key . '_url'; 
            $captionKey = $key . '_caption'; 
            
            if($request->hasFile($imgKey)){ 
                $request->validate([
                    $imgKey => 'file|max:2048|mimes:jpeg,jpg,png',
                ] );
                $file = $request->file($imgKey);
                $fileName = $filePath.$file->getClientOriginalName();
                $file->move($filePath,$fileName);
                
                $url = $fileName;
            }else{
                $url = $request->$imgKey;
            }

            if(empty($request->$idKey)){ 
                \App\Models\AreaPhoto::create([
                    'area_id' => $area->id,
                    'url' => $url,
                    'caption' => $request->$captionKey
                ]);
            }else{
                \App\Models\AreaPhoto::find($request->$idKey)->update([
                    'url' => $url,
                    'caption' => $request->$captionKey
                ]);
            }
        }
    }
}