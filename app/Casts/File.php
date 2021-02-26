<?php

namespace App\Casts;

use App\Traits\UploadFileAPI;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;

class File implements CastsAttributes
{
    use UploadFileAPI;
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
        return $value;
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
        $folder = \Illuminate\Support\Str::snake(class_basename($model)) . '_imgs';
        if ($value && gettype($value) === "object") {
            return $this->upload($value, $folder);
        }
        return $value;
    }
}
