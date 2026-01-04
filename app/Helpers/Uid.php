<?php

namespace App\Helpers;

class Uid
{
    public static function generate($length = 13) : string
    {
        return substr(base_convert(sha1(uniqid(mt_rand())), 16, 36), 0, $length);
    }
}
