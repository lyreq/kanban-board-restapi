<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ResponseController extends Controller
{
    static function response($code,$status,$message)
    {
        $addData['response']['code'] = $code;
        $addData['response']['status'] = $status;
        $addData['response']['message'] = $message;
        
        return $addData;
    }
}
