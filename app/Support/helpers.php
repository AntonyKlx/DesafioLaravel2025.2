<?php

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

if(! function_exists('isUserLoggedIn')){
    function isUserLoggedIn()
    {
        return Auth::guard('web')->check();
    }
}

if(! function_exists('isAdminLoggedIn')){
    function isAdminLoggedIn()
    {
        return Auth::guard('adm')->check();
    }
}

if(! function_exists('getCurrentLoggedinUser')){
    function getCurrentLoggedinUser(): \App\Models\User|\App\Models\Admin|null{
        if(isUserLoggedIn()){
            return Auth::guard('web')->user();
        }
        if(isAdminLoggedIn()){
            return Auth::guard('adm')->user();
        }
        return null;
    }
}

