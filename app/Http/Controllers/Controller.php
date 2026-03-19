<?php

namespace App\Http\Controllers;

abstract class Controller
{
    protected function cleanInput(string $value): string
    {
        $data = strip_tags(mb_strtolower(trim($value)));
        return $data;
    }
}
