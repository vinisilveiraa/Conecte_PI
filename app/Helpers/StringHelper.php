<?php

namespace App\Helpers;

class StringHelper
{
    public static function removeAccents($string)
    {
        return iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE', $string);
    }
}
