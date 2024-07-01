<?php

namespace App;

enum ErrorCode: int
{
    case NOT_FOUND = 404;
    case UNAUTHORIZED = 401;
    case FORBIDDEN = 403;
    case VALIDATION_ERROR = 422;
    case SERVER_ERROR = 500;

    public function message(): string
    {
        return match($this) {
            self::NOT_FOUND => 'Not found',
            self::UNAUTHORIZED => 'Unauthorized',
            self::FORBIDDEN => 'Forbidden',
            self::VALIDATION_ERROR => 'Validation error',
            self::SERVER_ERROR => 'Server error',
        };
    }

    public static function getDetails(ErrorCode $errorCode): array
    {
        return [
            'message' => $errorCode->message(),
            'code' => $errorCode->value,
        ];
    }
}
