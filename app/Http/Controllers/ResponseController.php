<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller as Controller;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Jobs\SendEmail;

class ResponseController extends Controller
{
    public function successResponse($response)
    {
        return response()->json($response, 200);
    }

    public function errorResponse($response)
    {
        return response()->json($response, 200);
    }


    public function sendError($error, $code = 404,$platform=null)
    {
        $response = [
            'error' => $error,
        ];
        return response()->json($response, $code);
    }

    public function sendmail($recipient, $message, $subject){

        $mail_error = '';
            try {
                dispatch(new SendEmail($recipient, $message, $subject));
            }catch (\Exception $e) {
                $mail_error = config('constants.mail_error');
            }
            
        return $mail_error;

    }

}
