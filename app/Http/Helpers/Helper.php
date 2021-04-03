<?php

namespace App\Http\Helpers;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\File;
class Helper
{

	use \App\Traits\DownloadFile;
	const areaImagePath = 'images/areas/';
	const pointImagePath = 'images/points/';
	const stampImagePath = 'images/stamps/';
	const landmarkImagePath = 'images/landmarks/';
	const newsImagePath = 'images/news/';
	const badgesImagePath = 'images/badges/';
	const ROUTE_GENERAL = "route_data/route_general/";
	/**
	 * calculatorTiles
	 *
	 * @param  mixed $inputs
	 * @param  mixed $zoom
	 * @return void
	 */
	function calculatorTiles($inputs, $zoom)
	{
		$geometrys = $inputs->geometry;
		$minLat = $geometrys[0][0];
		$maxLat = $geometrys[0][0];
		$minLong = $geometrys[0][1];
		$maxLong = $geometrys[0][1];

		foreach ($geometrys as $geometry) {
			$minLat = ($geometry[0] < $minLat) ? $geometry[0] : $minLat;
			$maxLat = ($geometry[0] > $maxLat) ? $geometry[0] : $maxLat;

			$minLong = ($geometry[1] < $minLong) ? $geometry[1] : $minLong;
			$maxLong = ($geometry[1] > $maxLong) ? $geometry[1] : $maxLong;
		}

		return [
			'topLeftTile' => $this->deg2num($minLat, $maxLong, $zoom),
			'bottomRightTile' => $this->deg2num($maxLat, $minLong, $zoom)
		];
	}

	/**
	 * deg2num
	 *
	 * @param  mixed $lat
	 * @param  mixed $long
	 * @param  mixed $zoom
	 * @return void
	 */
	function deg2num($lat, $long, $zoom)
	{
		$xtile = floor((($long + 180) / 360) * pow(2, $zoom));
		$ytile = floor((1 - log(tan(deg2rad($lat)) + 1 / cos(deg2rad($lat))) / pi()) / 2 * pow(2, $zoom));
		return [
			'x' => (int) $xtile,
			'y' => (int) $ytile,
			'zoom' => (int) $zoom
		];
	}

	/**
	 * getTiles
	 *
	 * @param  mixed $data
	 * @param  mixed $zoom
	 * @param  mixed $routeId
	 * @return void
	 */
	function getTiles($data, $zoom, $routeId)
	{

		$minX = $data['bottomRightTile']['x'];
		$maxX = $data['topLeftTile']['x'];
		$minY = $data['bottomRightTile']['y'];
		$maxY = $data['topLeftTile']['y'];

		self::debug("start route_id=$routeId, zoom=$zoom, minX=$minX, maxX=$maxX, minY=$minY, maxY=$maxY");
		for ($x = $minX; $x <= $maxX; $x++) {
			for ($y = $minY; $y <= $maxY; $y++) {
				// $this->downloadTile($x, $y, $zoom, $routeId);
				$tilesParams = $zoom . "/" . $x . "/" . $y . ".png";
				$url = config('api.map.tile_url') . $tilesParams;
				self::debug("url=$url");
				
				// check exist file 
				$filename = "route_" . $routeId . "/tiles/" . $tilesParams; // route_35/tiles/15/x/y.png

				$routeTilesGeneralPath = "route_general/tiles/".$tilesParams;
				

				if($this->checkFileExist($filename)){
					// copy tiles
					$this->copyTiles($routeTilesGeneralPath,$filename);
					continue;
				}else{
					if ($this->checkUrlExist($url)) {
						// download into general folder
						$routeTilesGeneralPath = "route_general/tiles/".$tilesParams;
						Storage::disk('route_data')->put($routeTilesGeneralPath, file_get_contents($url));
						self::debug("Download file: $url");
						// copy tiles
						$this->copyTiles($routeTilesGeneralPath,$filename);
					}else {
						break;
					}
				}
				
			}
		}
		self::debug("end   route_id=$routeId, zoom=$zoom");
	}

	/**
	 * downloadTile
	 *
	 * @param  mixed $tileX
	 * @param  mixed $tileY
	 * @param  mixed $zoom
	 * @param  mixed $routeId
	 * @return void
	 */
	function downloadTile($tileX, $tileY, $zoom, $routeId)
	{
		$url = config('api.map.tile_url') . $zoom . "/" . $tileX . "/" . $tileY . ".png";
		self::debug("url=$url");
		$filename = "route_" . $routeId . "/tiles/" . $zoom . "/" . $tileX . "/" . $tileY . ".png";
		\Illuminate\Support\Facades\Storage::disk('route_data')->put($filename, file_get_contents($url));

		// $this->downloadImage($url, $filename, $disk = 'route_data');
	}

	/**
	 * getElevations
	 *
	 * @param  mixed $data
	 * @param  mixed $zoom
	 * @param  mixed $routeId
	 * @return void
	 */
	function getElevations($data, $zoom, $routeId)
	{
		for ($i = $data['bottomRightTile']['x']; $i <= $data['topLeftTile']['x']; $i++) {
			for ($j = $data['bottomRightTile']['y']; $j <= $data['topLeftTile']['y']; $j++) {

				$this->downloadElevation($i, $j, $zoom, $routeId);
			}
		}
	}

	/**
	 * downloadElevation
	 *
	 * @param  mixed $tileX
	 * @param  mixed $tileY
	 * @param  mixed $zoom
	 * @param  mixed $routeId
	 * @return void
	 */
	function downloadElevation($tileX, $tileY, $zoom, $routeId)
	{
		$urlElevation = config('api.map.elevation_base_url') . $zoom  . "/" . $tileX . "/" . $tileY . ".txt";
		$filenameElevation = "route_" . $routeId . "/elevations/" . $zoom . "/" . $tileX . "/" . $tileY . ".txt";
		$this->downloadImage($urlElevation, $filenameElevation, $disk = 'route_data');
	}


	/**
	 * zipFiles
	 *
	 * @param  mixed $routeId
	 * @return void
	 */
	function zipFiles($routeId)
	{
		$zip_file = public_path("route_data/route_$routeId.zip");
		self::debug("start zip file: $zip_file ");
		$zip = new \ZipArchive();
		$zip->open($zip_file, \ZipArchive::CREATE);
		$path = public_path("route_data/route_$routeId/");

		$files = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($path));
		foreach ($files as $file) {
			// Skipping all subfolders
			if (!$file->isDir()) {
				$filePath     = $file->getRealPath();
				// Extracting filename
				$relativePath = "route_$routeId/" . substr($filePath, strlen($path));

				$zip->addFile($filePath, $relativePath);
			}
		}

		$zip->close();
		return response()->download($zip_file);
	}


	/**
	 * getUrlApplication
	 *
	 * @return void
	 */
	public static function getUrlApplication()
	{
		return config('app-config.urlApp');
	}

	public function str2Bool($val)
	{
		if (is_string($val)) {
			$val = strtolower(trim($val));
			if ($val === 'true') return true;
			if ($val === 'false') return false;
		}

		return (bool) $val;
	}

	public static function formatPhone($phone)
	{
		$phone = self::removeDashInPhone($phone);
		return preg_replace('/\d{3}/', '$0-', str_replace('.', null, trim($phone)), 2);
	}

	public static function removeDashInPhone($phone)
	{
		return str_replace("-", "", $phone);
	}

	public static function debug($msg, $arr = null)
	{
		if (config('app.debug')) {
			$bt = debug_backtrace();
			$caller = basename($bt[0]["file"], '.php') . "(" . $bt[0]["line"] . ")->" . $bt[1]["function"] . "()";
			$str = "[" . $caller . "] " . $msg;
			if (!is_null($arr)) {
				$str .= json_encode($arr, JSON_UNESCAPED_UNICODE);
			}
			Log::info($str);
		}
	}

	public static function getThumbnailByActivities($type, $activities)
	{
		$thumbnail = '';
		if (!empty($activities)) {
			if ($type == 'badge') {
				$activityLink = "medal_";
				$path = self::badgesImagePath;
			} else {
				$activityLink = "stamp_";
				$path = self::stampImagePath;
			}


			foreach ($activities as $activity) {

				$activityLink .= $activity->value . "-";
			}
			$thumbnail .= self::getUrlApplication() . '/' . $path . trim($activityLink, "-") . '.png';
		}

		return $thumbnail;
	}

	public static function getTotalEachActivity($trackPoint)
	{
		if (!empty($trackPoint)) {
			$collection = collect($trackPoint);
			$isFinishTrack = $collection->filter(function ($value) {
				return $value['is_finished'] == 1;
			})->sortBy('journey_time');

			$group = $isFinishTrack->groupBy('movement');

			$activityList = $group->map(function ($item) {
				$value = collect($item);
				return [
					'total_distance' => $value->sum('distance_per_point'),
					'total_elevation' => $value->sum('elevation_per_point'),
					'total_journey_time' => $value->sum('journey_time_per_point'),
				];
			});

			return $activityList->all();
		}
		return null;
	}

	public static function getStampsByPoints($points, $badge)
	{
		$stamps = $points;
		foreach ($stamps as $item) {
			$item->stamp_thumbnail = $badge;
		}
		return $stamps;
	}
	public static function getActivity($activities)
	{
		$activityType = "";

		if (!empty($activities)) {
			foreach ($activities as $activity) {
				$activityType .= $activity->value . "-";
			}
		}
		return trim($activityType, "-");
	}

	public static function getActivityStatistics($resources)
	{
		$data = collect($resources)->groupBy('activity')
			->map(function ($value) {
				return [
					'count' => $value->count(),
					'total_distance' => $value->sum('distance'),
					'total_elevation' => $value->sum('total_elevation'),
					'total_journey_time' => $value->sum('time'),
				];
			});
		$combinationList = $data->filter(function ($value, $key) {
			return (count(explode("-", $key)) > 1);
		});

		$data = $data->filter(function ($value, $key) {
			return (count(explode("-", $key)) < 2);
		});
		$data->put('combination', [
			'count' => $combinationList->sum('count'),
			'total_distance' => $combinationList->sum('total_distance'),
			'total_elevation' => $combinationList->sum('total_elevation'),
			'total_journey_time' =>  $combinationList->sum('total_journey_time'),
		]);

		return collect($resources)->map(function ($track) use ($data) {
			$track['activity_statistics'] = $data->all();

			return $track;
		})->all();
	}

    public function isEmptyInput($field)
    {
        if (is_array($field)) {
            foreach ($field as $value) {
                if (!$this->isEmptyInput($value)) {
                    return false;
                }
            }
            return true;
        }

        return !filled($field);
    }


	public function checkUrlExist($url)
    {
        $curl = curl_init($url); 
        curl_setopt($curl, CURLOPT_NOBODY, true); 
        $result = curl_exec($curl); 
          
        if ($result !== false) { 
            $statusCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);  
            if ($statusCode != 404) { 
                return true;
            } 
        } 
       
        return false;
    }

	/*
	$filename = "route_35/tiles/15/x/y.png
	*/
	public function checkFileExist($filename) 
	{
		$path = public_path("route_data/route_general/");
		$pathTilesDestination = substr($filename, strpos($filename,"tiles"));
		$files = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($path));
		foreach ($files as $file) {
		
			if (!$file->isDir()) {
				$filePath  = $file->getRealPath(); // get full path
				$pathTilesGeneral = substr($filePath, strpos($filePath,"tiles")); // get tiles path: tiles/15/1235/222.png
				if($pathTilesGeneral ==  $pathTilesDestination){
					return true;
				} 
			}
			
		}
		return false;
	}

	public function copyTiles($generalPath,$filename) 
	{
		$generalFullPath = public_path("route_data/".$generalPath);
		
		$dest = substr($filename, 0 , strrpos($filename,"/") )  ; // route_routeID/zoom/x

		$newFolder = public_path("route_data/".$dest);  // route_data/route_routeID/zoom/x
		if(!File::isDirectory($newFolder)){
			File::makeDirectory($newFolder, 0777, true, true);
		}

		shell_exec("cp -r $generalFullPath $newFolder");
		self::debug("Copy file $filename");
	}
}
