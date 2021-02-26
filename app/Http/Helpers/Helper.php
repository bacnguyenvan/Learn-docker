<?php 
namespace App\Http\Helpers;

class Helper{

	use \App\Traits\DownloadFile;
	const areaImagePath = 'images/areas/';
	
	function caculatorTiles($inputs, $zoom)
	{
		$geometrys = $inputs->geometry;
        $minLat = $geometrys[0][0];
        $maxLat = $geometrys[0][0];
        $minLong = $geometrys[0][1];
        $maxLong = $geometrys[0][1];
        
        foreach($geometrys as $geometry){
            $minLat = ($geometry[0] < $minLat) ? $geometry[0] : $minLat;
            $maxLat = ($geometry[0] > $maxLat) ? $geometry[0] : $maxLat;

            $minLong = ($geometry[1] < $minLong) ? $geometry[1] : $minLong;
            $maxLong = ($geometry[1] > $maxLong) ? $geometry[1] : $maxLong;
        }

        return [
        	'topLeftTile' => $this->deg2num($minLat,$maxLong, $zoom),
        	'bottomRightTile' => $this->deg2num($maxLat, $minLong, $zoom)
        ];

	}

	function deg2num($lat, $long, $zoom)
	{
	  $xtile = floor((($long + 180) / 360) * pow(2, $zoom));
	  $ytile = floor((1 - log(tan(deg2rad($lat)) + 1 / cos(deg2rad($lat))) / pi()) /2 * pow(2, $zoom));
	  return [
	  	'x' => (int) $xtile,
	    'y' => (int) $ytile,
	    'zoom' => (int) $zoom
	  ];
	} 

	function getTiles($data, $zoom, $routeId)
	{
		for($i = $data['bottomRightTile']['x']; $i <= $data['topLeftTile']['x']; $i++){
			for($j = $data['bottomRightTile']['y']; $j <= $data['topLeftTile']['y']; $j++){
				
				$this->downloadTiles($i , $j , $zoom, $routeId);

			}
		}
		
	}

	function downloadTiles($tileX, $tileY, $zoom, $routeId)
	{
		$url = "https://cyberjapandata.gsi.go.jp/xyz/std/". $zoom . "/" . $tileX . "/" . $tileY . ".png";
		$filename = "route_".$routeId."/tiles/".$zoom."/".$tileX."/" .$tileY. ".png";
		$this->downloadImage($url, $filename , $disk = 'route_data');
	}

	function getElevations($data, $zoom, $routeId){
		for($i = $data['bottomRightTile']['x']; $i <= $data['topLeftTile']['x']; $i++){
			for($j = $data['bottomRightTile']['y']; $j <= $data['topLeftTile']['y']; $j++){
				
				$this->downloadElevation($i , $j , $zoom, $routeId);

			}
		}
	}

	function downloadElevation($tileX, $tileY, $zoom, $routeId)
	{
		$urlElevation = "https://cyberjapandata.gsi.go.jp/xyz/dem/". $zoom  . "/" . $tileX . "/" . $tileY . ".txt";
		$filenameElevation = "route_".$routeId."/elevations/".$zoom ."/".$tileX."/" .$tileY. ".txt";
		$this->downloadImage($urlElevation, $filenameElevation , $disk = 'route_data');
	}


	function zipFiles($routeId)
	{
	    $zip_file = "route_data/route_$routeId.zip";
		$zip = new \ZipArchive();
		$zip->open($zip_file, \ZipArchive::CREATE | \ZipArchive::OVERWRITE);
		$path = public_path("route_data/route_$routeId/");
		
		$files = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($path));
		foreach ($files as $name => $file)
		{
		    // Skipping all subfolders
		    if (!$file->isDir()) {
		        $filePath     = $file->getRealPath();
		        // Extracting filename
		        $relativePath = "route_$routeId/" . substr($filePath, strlen($path) );

		        $zip->addFile($filePath, $relativePath);
		    }
		}
		$zip->close();
		return response()->download($zip_file);
	}

	
	static public function getUrlApplication()
	{
		return config('app-config.urlApp');
	}

}

?>