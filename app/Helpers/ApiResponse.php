<?php

namespace App\Helpers;

class ApiResponse 
{
    static function sendResponse($data = [] ,$status = 200, $msg = null)
    {
        $response = [
            'data' => $data,
            'status' => $status,
            'msg' => $msg,
        ];
        
        return response()->json($response, $status);
    }
}