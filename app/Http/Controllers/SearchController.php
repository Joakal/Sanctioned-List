<?php

namespace App\Http\Controllers;

use DB;

use App\Http\Controllers\Controller;

class SearchController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Search Controller
    |--------------------------------------------------------------------------
    |
    | This displays the Search page
    |
    */

    public function showPage($query = null)
    {
        $ofac = DB::table('ofac')->get();

        return view('search', ['ofac' => $ofac]);
    }
	
}
