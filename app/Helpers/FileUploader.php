<?php

namespace App\Helpers;


use Illuminate\Support\Str;
use Illuminate\Http\UploadedFile;


class FileUploader
{
    /**
     * Upload an image file for a specific type ('pan' or 'aadhaar').
     *
     * @param UploadedFile $file The uploaded file instance.
     * @return string The file path if successful.
     */
    public static function imageUpload(UploadedFile $file)
    {
        $fileName = Str::uuid() . "-" . $file->getClientOriginalName();
        $path = "uploads";
        $file->move(public_path($path), $fileName);

        return "/$path/" . $fileName;
    }
}
