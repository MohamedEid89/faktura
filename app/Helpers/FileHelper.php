<?php

namespace App\Helpers;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class FileHelper
{
    public static function uploadSingleImage($file, $oldImage = null)
    {
        // Validate the request
        $file->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Generate a random name for the new image
        $imageName = Str::random(20) . '.' . $file->extension();

        // Check if old image exists and delete it
        if ($oldImage) {
            $oldImagePath = public_path('images/' . $oldImage);
            if (File::exists($oldImagePath)) {
                File::delete($oldImagePath);
            }
        }

        // Upload the image to the public/images directory
        $file->move(public_path('images'), $imageName);

        return $imageName;
    }

    public static function uploadMultipleImages($files, $oldImages = [])
    {
        $uploadedImages = [];

        // Validate each image
        foreach ($files as $file) {
            $file->validate([
                'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            // Generate a random name for each image
            $imageName = Str::random(20) . '.' . $file->extension();

            // Check if old image exists and delete it
            foreach ($oldImages as $oldImage) {
                $oldImagePath = public_path('images/' . $oldImage);
                if (File::exists($oldImagePath)) {
                    File::delete($oldImagePath);
                }
            }

            // Upload each image to the public/images directory
            $file->move(public_path('images'), $imageName);
            $uploadedImages[] = $imageName;
        }

        return $uploadedImages;
    }

    public static function uploadFile($file, $oldFile = null)
    {
        // Validate the request
        $file->validate([
            'file' => 'required|mimes:pdf,doc,docx|max:2048',
        ]);

        // Generate a random name for the new file
        $fileName = Str::random(20) . '.' . $file->extension();

        // Check if old file exists and delete it
        if ($oldFile) {
            $oldFilePath = public_path('files/' . $oldFile);
            if (File::exists($oldFilePath)) {
                File::delete($oldFilePath);
            }
        }

        // Upload the file to the public/files directory
        $file->move(public_path('files'), $fileName);

        return $fileName;
    }
}