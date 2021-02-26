<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;

trait GeometryChart
{
    function getGeoChart($id, $geometry, $range, $elevation)
    {
        $listChart = [];
        $numberOfPartDistance = 10;
        $aPartElevation = 100;
        $numberOfPartElevation = 5;

        if ($range > 10) {
            $numberOfPartDistance = 5;
        };
        $maxDistance = ceil($range / 10) * 10;

        $aPartDistance = $maxDistance / $numberOfPartDistance;

        for ($i = 0; $i < count($geometry); $i++) {
            $x = 0;
            if ($i > 0) {
                $distance = $this->getDistanceFromLatLonInKm(
                    $geometry[$i][0],
                    $geometry[$i][1],
                    $geometry[$i - 1][0],
                    $geometry[$i - 1][1]
                );
                $x = $listChart[$i - 1]["x"] * $aPartDistance + $distance;
            }
            $ele = $this->getElevation($id, $geometry[$i][0], $geometry[$i][1]);
            if ($ele > 500) {
                $numberOfPartElevation = 10;
            };
            array_push($listChart, ["x" => $x / $aPartDistance, "y" => ($ele / $aPartElevation)]);
        }
        $graph = [
            'list' => $listChart,
            'a_part_distance' => $aPartDistance,
            'number_of_part_distance' => $numberOfPartDistance,
            'a_part_elevation' => $aPartElevation,
            'number_of_part_elevation' => $numberOfPartElevation,
            'a_part_elevation' => $aPartElevation
        ];

        return $graph;
    }

    function getDistanceFromLatLonInKm($lat1, $lon1, $lat2, $lon2)
    {
        $r = 6371; // Radius of the earth in km
        $dLat = deg2rad($lat2 - $lat1);  // deg2rad below
        $dLon = deg2rad($lon2 - $lon1);
        $a =
            sin($dLat / 2) * sin($dLat / 2) +
            cos(deg2rad($lat1)) * cos(deg2rad($lat2)) *
            sin($dLon / 2) * sin($dLon / 2);
        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
        $d = $r * $c; // Distance in km
        return $d;
    }

    function deg2rad($deg)
    {
        return $deg * (pi() / 180);
    }

    function deg2num($lat, $long, $zoom)
    {
        $xTile = floor((($long + 180) / 360) * pow(2, $zoom));
        $yTile = floor((1 - log(tan(deg2rad($lat)) + 1 / cos(deg2rad($lat))) / pi()) /
            2 *
            pow(2, $zoom));
        return [$xTile, $yTile];
    }

    function getElevation($id, $lat, $long)
    {
        $tile = $this->deg2num($lat, $long, 14);
        $yPix = $this->getPixelByLat($lat, $tile[1]);
        $xPix = $this->getPixelByLong($long, $tile[0]);
        $ele = 0.0;
        $exists = \Illuminate\Support\Facades\File::exists("route_elevation/route_$id/elevations/14/$tile[0]/$tile[1].txt");
        if ($exists) {
            $string = \Illuminate\Support\Facades\File::get(public_path("route_elevation/route_$id/elevations/14/$tile[0]/$tile[1].txt"));
            $line = explode("\n", $string);
            $list = explode(",", $line[$yPix]);
            $ele = $list[$xPix] ? $list[$xPix] : 0.0;
        }
        return floatval($ele);
    }

    function getPixelByLat($lat, $yTile): int
    {
        $offset = 256 << (14 - 1);
        return floor($offset -
            $offset /
            pi() *
            log((1 + sin($lat * pi() / 180)) / (1 - sin($lat * pi() / 180))) /
            2)
            -
            256 * $yTile;
    }

    function getPixelByLong($long, $xTile): int
    {
        $offset = 256 << (14 - 1);
        return $offset + floor($offset * $long / 180) - 256 * $xTile;
    }
}
