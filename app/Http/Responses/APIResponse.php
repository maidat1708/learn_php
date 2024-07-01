<?php

namespace App\Http\Responses;

use App\ErrorCode;
use App\Exceptions\CustomException;

class ApiResponse
{
    public static function success($data, $message = 'Success', $statusCode = 200)
    {
        return response()->json([
            'success' => true,
            'message' => $message,
            'data' => $data
        ], $statusCode);
    }

    public static function error($message, $statusCode = 400, $errors = [])
    {
        return response()->json([
            'success' => false,
            'message' => $message,
            'errors' => $errors,
            // 'data' => [],
        ], $statusCode);
    }
    public static function responseException(ErrorCode $errorCode)
    {
        throw new CustomException($errorCode);
    }
}
