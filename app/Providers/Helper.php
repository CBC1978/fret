<?php

    namespace App\Providers;

    class Helper
    {

       public static function random_string($length) {
            $str = random_bytes($length);
            $str = base64_encode($str);
            $str = str_replace(["+", "/", "="], "", $str);
            $str = substr($str, 0, $length);
            return $str;
        }
        public static function random_int($min, $max)
    {
        return random_int($min, $max);
    }
    
    }
