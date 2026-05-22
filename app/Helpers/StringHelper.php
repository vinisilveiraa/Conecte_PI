<?php

namespace App\Helpers;

use Illuminate\Support\Str;

class StringHelper
{
    public static function onlyNumbers($string)
    {
        $newString = preg_replace('/\D/', '', $string);

        return $newString;
    }

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

    public function formatTelefone($telefone)
    {
        $telefone = preg_replace('/\D/', '', $telefone);

        if (strlen($telefone) === 11) {
            return preg_replace(
                '/(\d{2})(\d{5})(\d{4})/',
                '($1) $2-$3',
                $telefone
            );
        }

        return $telefone;
    }

    public function formatCpf($cpf)
    {
        $cpf = preg_replace('/\D/', '', $cpf);

        return preg_replace(
            '/(\d{3})(\d{3})(\d{3})(\d{2})/',
            '$1.$2.$3-$4',
            $cpf
        );
    }
}
