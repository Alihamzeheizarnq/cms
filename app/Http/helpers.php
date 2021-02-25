<?php


use Illuminate\Support\Facades\Route;

if (!function_exists('isActive')) {


    function isActive($key, $className = 'active')
    {
        if (is_array($key)){
            return in_array(Route::currentRouteName() , $key) ? $className : '';
        }

        return Route::currentRouteName() == $key ? $className : '';
    }
}
