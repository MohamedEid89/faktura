<?php

namespace App\Http\Controllers\Api;

use App\Models\Profile;
use App\Helpers\ApiResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use App\Http\Requests\ProfileRequest;
use App\Http\Resources\ProfileResource;
use function PHPUnit\Framework\returnSelf;

class ProfileController extends Controller
{
    ################---------# {{ Register }} #---------################
    // @desc User Register with basic info
    // @route POST /api/v1/register
    // @access Plublic
    public function show ($id) 
    {
        // show profile
        $profile = Profile::where('id', $id)->first();
        
        if($profile)
        {
            return ApiResponse::sendResponse( 'Show', 'success', 200 ,new ProfileResource($profile));
        }
            return ApiResponse::sendResponse( 'Show', 'not found', );
        
    }

        ################---------# {{ Register }} #---------################
    // @desc User Register with basic info
    // @route POST /api/v1/register
    // @access Plublic
    public function update (ProfileRequest $request, $id) 
    {
        
        $profile = Profile::findOrFail($id);
        if(!$profile)
        return ApiResponse::sendError('Profile not found', [], 404);
        
        //validation 
        $data = $request->validated();
        // image validation 
        if($request->file('logo')){
            $filePath = public_path('images/profiles/').$profile->logo;
            if(File::exists($filePath))
            {
                File::delete($filePath);
            }
            $file = $request->file('logo');
            $fileName = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('images/profiles/'),$fileName);
            $data['logo'] = $fileName;
            //$data->save();
        }
        //update profile
        $profile->update($data);
        return ApiResponse::sendResponse('update', 'success', 200, new ProfileResource($profile));

        //Check if validation fails
        if($errors = $request->errors()) {
            return ApiResponse::sendResponse('update', 'Fail validation', 422, $errors);
        }
    
        
    }
}