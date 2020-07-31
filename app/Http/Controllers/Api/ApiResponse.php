<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
trait ApiResponse
{
    /*
     * $message
     * $data
     * $errors
     * $status: true, false
     */
    protected function sendResult($message,$data,$errors = [],$status = true)
    {
        $errorCode = $status ? 200 : 422;
        $result = [
            "message" => $message,
            "status"  => $status,
            "data"    => $data,
            "errors"  => $errors
        ];
        return response()->json($result,$errorCode);
    }
}
