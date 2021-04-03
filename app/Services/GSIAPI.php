<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use App\Traits\ResponseAPI;

class GSIAPI
{
    use ResponseAPI;

    function getElevation($latitude, $longtitude)
    {
        try{
            $url = config('api.map.elevation_base_url_php')."?lon=$long&lat=$lat&outtype=JSON";
            $data = json_decode(file_get_contents($url), true);
            return $data['elevation'];
    
        }catch(\Exception $err){
            throw $err;
        }
       
    }

}
