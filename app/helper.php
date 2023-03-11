<?php

use Illuminate\Support\Facades\Route;

function active_nav($currRoute)
{
    $route = Route::current()->getName();

    if ($route == $currRoute) {
        return 'active';
    } else {
        return '';
    }
}
