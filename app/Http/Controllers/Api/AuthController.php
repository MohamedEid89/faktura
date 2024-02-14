<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Helpers\ApiResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

class AuthController extends Controller
{
    
    ################---------# {{ Register }} #---------################
    // @desc User Register with basic info
    // @route POST /api/v1/register
    // @access Plublic
    public function register (Request $request) 
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string' , 'max:255'],
            'email' => ['required', 'email' , 'string' , 'max:255' , 'unique:' . User::class],
            'password' => ['required', 'confirmed' , Password::defaults()],
        ], 
        // Messages
        [], 
        [
        // Attributes
            'name' => __('validation.attributes.name'),
            'email' => __('validation.attributes.email'),
            'password' => __('validation.attributes.password'),
        ]);

        if($validator->fails())
        {
            return ApiResponse::sendResponse('register', 'Error Validation' ,422 ,$validator->errors());
        }
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
            $data['taken'] = $user->createToken('UserToken')->plainTextToken;
            $data['name'] = $user->name;
            $data['email'] = $user->email;
            
            return ApiResponse::sendResponse('register', 'success' ,201, $data);
    }

    ################---------# {{ Login }} #---------################
    // @desc User Login 
    // @route POST /api/v1/login
    // @access Plublic
    public function login (Request $request) 
    {
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'email' , 'string' , 'max:255'],
            'password' => ['required'],
        ], 
        // Messages
        [], 
        [
        // attributes
            'email' => __('validation.attributes.email'),
            'password' => __('validation.attributes.password'),
        ]);

        if($validator->fails())
        {
            return ApiResponse::sendResponse('login', 'Error Validation' ,422 ,$validator->errors());
        }
            
            if(Auth::attempt(['email' => $request->email, 'password' => $request->password]))
                {
                    $user = Auth::user();
                    $data['taken'] = $user->createToken('UserToken')->plainTextToken;
                    $data['name'] = $user->name;
                    $data['email'] = $user->email;
                    return ApiResponse::sendResponse('login', 'success' ,200 ,$data);
                }
                return ApiResponse::sendResponse([], 401 , __('auth.failed'));
    }

    ################---------# {{ Logout }} #---------################
    // @desc User Logout
    // @route POST /api/v1/Logout
    // @access Private
    public function logout (Request $request) 
    {
        $request->user()->currentAccessToken()->delete();
        return ApiResponse::sendResponse('logout', 'sccesss', '200', __('auth.logout'));
    }
}