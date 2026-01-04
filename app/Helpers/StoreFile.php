<?php

namespace App\Helpers;
use Illuminate\Support\Facades\Storage;
use File;

class StoreFile
{
    /**
     * store public file
     * @param $file
     * @param $to
     * @return string
     */
    public static function toPublic($file, $to): string
    {
        if (!file_exists($to)) {
            File::makeDirectory($to, 0775, true, true);
        }

        $fileData = $file;
        $ext = $fileData->getClientOriginalExtension();
        $filename = rand(100000,1001238912).".".$ext;
        $fileData->move($to,$filename);
        return $to.'/'.$filename;
    }


    /**
     * store private file
     * @param $file
     * @param $to
     * @return string
     */
    public static function toPrivate($file, $to): string
    {
        $fileData = $file;
        $ext = $fileData->getClientOriginalExtension();
        $filename = rand(100000,1001238912).".".$ext;

        Storage::put($to.'/'.$filename, File::get($file));

        return $to.'/'.$filename;
    }
}
