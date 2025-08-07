<?php

namespace App\Actions;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

/**
 * Summary of StorageHelper Facade
 */
class StorageHelper
{
    /**
     * Summary of storeFile
     * @param ?UploadedFile $file   // File to upload
     * @param ?object $object       // Object to update or create
     * @param bool $hasFile         // Check if file is uploaded
     * @param string $disk          // Type Disk public or local
     * @param string $directory     // path in storage
     * @param string $column        //name col edit or create
     * 
     * @return string|null          //Path Or Old Path Or null
     */
    public static function storeFile(?UploadedFile $file, ?object $object, bool $hasFile,string $disk ,string $directory, string $column)
    {
        if ($hasFile) {
            if ($file?->isValid()) {
                if ($object?->{$column}) {
                    Storage::disk($disk)->delete($object->{$column});
                }

                $pathFile = $file->store($directory, $disk);

                return $pathFile;
            }
        }
        return  $object?->{$column} ?? null;
    }
}
