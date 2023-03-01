<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function about()
    {
        echo 'This is about controll';
    }

    public function contactMethod()
    {
        echo 'This is contact controll';
    }
}
