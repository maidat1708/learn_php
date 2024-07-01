<?php

namespace App\Exceptions;

use App\ErrorCode;
use Exception;

class CustomException extends Exception
{
    protected $message;
    protected $statusCode;

    public function __construct(ErrorCode $errorCode)
    {
        $details = ErrorCode::getDetails($errorCode);
        parent::__construct($details['message'], $details['code']);  // Gọi constructor của lớp Exception
        // $this->message = $details['message'];
        // $this->statusCode = $errorCode;
    }

    public function render($request)
    {
        return response()->json([
            'code' => $this->getCode(),
            'error' => $this->getMessage(),
        ], $this->getCode());
    }
}
