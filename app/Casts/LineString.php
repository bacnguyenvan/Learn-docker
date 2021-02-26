<?php

namespace App\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;

class LineString implements CastsAttributes
{
    /**
     * Cast the given value.
     *
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @param  string  $key
     * @param  mixed  $value
     * @param  array  $attributes
     * @return array
     */
    public function get($model, $key, $value, $attributes)
    {
        return $value ? $this->convertLineStringToArray($value) : $value;
    }

    /**
     * Prepare the given value for storage.
     *
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @param  string  $key
     * @param  array  $value
     * @param  array  $attributes
     * @return string
     */
    public function set($model, $key, $value, $attributes)
    {
        return \Illuminate\Support\Facades\DB::raw("ST_GeomFromText('LINESTRING(" . implode(',', $value) .")', 4326)");
    }

    /**
     * Convert the string get from database to a array listing the latitude and longitude
     *
     * @param string $lines
     * @return array
     */
    private function convertLineStringToArray(string $lines)
    {
        $str = $lines;
        $str = substr($str, 11, (strlen($str) - 1) - 11);
        $objective = array();

        foreach (str_getcsv($str) as $k => $v) {
            list($x, $y) = explode(' ', $v);
            $objective[$k][] = (float)$x;
            $objective[$k][] = (float)$y;
        }

        return $objective;
    }
}