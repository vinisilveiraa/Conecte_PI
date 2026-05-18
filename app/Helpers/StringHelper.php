<?php

namespace App\Helpers;

use Illuminate\Support\Str;

class StringHelper
{
    public static function removeAccents($string)
    {
        return iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE', $string);
    }

    public static function normalizeString(string $texto): string
    {
        $texto = mb_strtolower($texto);
        $texto = trim($texto);

        $texto = preg_replace(
            '/[^\p{L}\p{N}\s]/u',
            '',
            $texto
        );

        $texto = iconv(
            'UTF-8',
            'ASCII//TRANSLIT',
            $texto
        );

        return $texto;
    }
}
