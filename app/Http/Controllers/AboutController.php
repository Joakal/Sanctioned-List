<?php

namespace App\Http\Controllers;

class AboutController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | About Controller
    |--------------------------------------------------------------------------
    |
    | This just displays the About page
    |
    */

    public function showIndex()
    {
        return view('about');
    }
	
}
