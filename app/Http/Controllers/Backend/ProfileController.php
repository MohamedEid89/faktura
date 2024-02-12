<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index () {
        return view('backend.users.index');
    }



    public function uploadSingleImage(Request $request)
    {
        // Handle single image upload
        $imageName = FileHelper::uploadSingleImage($request->file('image'), $request->old_image);

        // Return a response or do something else with the image
        return response()->json(['image' => $imageName]);
    }

    public function uploadMultipleImages(Request $request)
    {
        // Handle multiple image upload
        $uploadedImages = FileHelper::uploadMultipleImages($request->file('images'), $request->old_images);

        // Return a response or do something else with the images
        return response()->json(['images' => $uploadedImages]);
    }

    public function uploadFile(Request $request)
    {
        // Handle file upload
        $fileName = FileHelper::uploadFile($request->file('file'), $request->old_file);

        // Return a response or do something else with the file
        return response()->json(['file' => $fileName]);
    }
}