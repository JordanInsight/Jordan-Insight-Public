<?php

namespace App\Services;

 
use Illuminate\Support\Facades\Storage;

class ImageService
{
    public function uploadImage($dir, $image): ?string
    {
        if ($image) {
            $file = $image;
            $extension = $file->getClientOriginalExtension();
            $imageName = time() . '.' . $extension;
            $path = 'uploads/'.$dir;
            $file->move($path, $imageName);
            return $imageName;
        }

        return null;
    }
    public function deleteImage($dir, $imageName): void
    {
        $path = 'public/' . $dir . '/' . $imageName;
        if (Storage::exists($path)) {
            Storage::delete($path);
        }
    }
    
}