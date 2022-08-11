<?php

namespace App\Helper;

class StringHelper
{
    public static function mb_strrev(?string $str): string
    {
        $res = '';
        for ($i = mb_strlen($str, 'UTF-8'); $i >= 0; $i--) {
            $res .= mb_substr($str, $i, 1, 'UTF-8');
        }

        return $res;
    }

    public static function mb_count_chars(string $input): array
    {
        $length = mb_strlen($input, 'UTF-8');
        $res = [];
        for($i = 0; $i < $length; $i++) {
            $char = mb_substr($input, $i, 1, 'UTF-8');
            if (!array_key_exists($char, $res)) {
                $res[$char] = 0;
            }
            $res[$char]++;
        }

        return $res;
    }
}