<?php

namespace App\Traits;

use Illuminate\Support\Facades\Http;



trait DownloadFile
{
    /**
     * Download File
     *
     * @param  mixed $url
     * @param  mixed $disk
     * @return void
     */
    public function downloadImage($url, $filename, $disk = 'route_data')
    {
        // $response = Http::get($url);

        // if ($response->successful()) {
        //     $contents = file_get_contents($url);
        //     return \Illuminate\Support\Facades\Storage::disk($disk)->put($filename, $contents);
        // }
        return \Illuminate\Support\Facades\Storage::disk($disk)->put($filename, file_get_contents($url));
    }
}
