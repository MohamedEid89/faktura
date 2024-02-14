<?php

namespace App\Helpers;

class ApiResponse 
{
    static function sendResponse($type = null ,$msg = null , $status = 200 , $data = [])
    {
        $response = [
            'type' => $type,
            'msg' => $msg,
            'status' => $status,
            'data' => $data,
            
        ];
        
        return response()->json($response, $status);
    }
    static function sendError($data = [] ,$msg = 'Profile not found' , $status = 404)
    {
        $response = [
            'msg' => $msg,
            'status' => $status,
            'data' => $data,
        ];
        
        return response()->json($response, $status);
    }
}