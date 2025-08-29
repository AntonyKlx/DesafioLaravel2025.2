<?php

use Illuminate\Support\Str;

if(! function_exists('human_case')) {
    function human_case($string)
    {
        return Str::tittle(__(Str::snake(Str::studly($string)," ")));
    }
}
