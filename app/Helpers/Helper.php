<?php

namespace App\Helpers;

class Helper{
    static function forgotPassword($password){
        return "hehe";
    }
    static function generateOTP($length = 6) {
        $otp = '';
        for ($i = 0; $i < $length; $i++) {
            $otp .= mt_rand(0, 9);
        }
        return $otp;
    }
}
