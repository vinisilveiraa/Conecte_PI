<?php

if (!function_exists('formatTelefone')) {
    function formatTelefone($telefone)
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
}

if (!function_exists('formatCpf')) {
    function formatCpf($cpf)
    {
        $cpf = preg_replace('/\D/', '', $cpf);

        return preg_replace(
            '/(\d{3})(\d{3})(\d{3})(\d{2})/',
            '$1.$2.$3-$4',
            $cpf
        );
    }
}
