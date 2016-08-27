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

    public function showPage()
    {
        return view('about');
    }
	
}
