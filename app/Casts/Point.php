<?php

namespace App\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;

class Point implements CastsAttributes
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
        return $value ? $this->convertPointStringToArray($value) : $value;
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
        return \Illuminate\Support\Facades\DB::raw("ST_GeomFromText('POINT(" . $value . ")', 4326)");
    }

    /**
     * Convert the string to array lat long when get from database
     *
     * @param string $lines
     * @return array
     */
    private function convertPointStringToArray(string $lines)
    {
        $str = $lines;
        $str = substr($str, 6, (strlen($str) - 1) - 6);
        list($x, $y) = explode(" ", $str);

        return [
            (float) $x,
            (float) $y,
        ];
    }
}
