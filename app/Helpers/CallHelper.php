<?php

use App\Helpers\Helper;

if(!function_exists("helper"))
{
    function helper(){
        return new Helper();
    }
}
