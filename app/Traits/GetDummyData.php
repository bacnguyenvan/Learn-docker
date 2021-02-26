<?php

namespace App\Traits;

trait GetDummyData
{
    public function dummyData(string $fileLocate): array
    {
        $json = \Illuminate\Support\Facades\File::get($fileLocate);

        return json_decode($json);
    }
}
