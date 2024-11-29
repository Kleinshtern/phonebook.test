<?php

namespace App\Traits;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

trait StorageTrait
{
    static public function uploadFile($file, string $filename, string $directory, string $disk = "public"): bool
    {
        if(Storage::disk($disk)->exists("$directory/$filename")) {
            return false;
        }

        return Storage::disk($disk)->put("$directory/$filename", $file);
    }

    static public function deleteFile(string $path, string $disk = "public"): bool
    {
        if(Storage::disk($disk)->exists($path)) {
            return Storage::disk($disk)->delete($path);
        }

        return true;
    }
}
