<?php

namespace App\Traits;


trait UploadFileAPI
{
    /**
     * Upload File
     *
     * @param  mixed $file
     * @param  mixed $path
     * @param  mixed $disk
     * @return void
     */
    public function upload($file, $path, $disk = 'public_uploads')
    {
        return env('APP_URL') . '/' . 'uploads/' . $file->store($path, ['disk' => $disk]);
    }
}
