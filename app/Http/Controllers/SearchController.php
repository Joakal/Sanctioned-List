<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Repositories\SearchRepository;

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
    /**
     * The search repository implementation.
     *
     * @var SearchRepository
     */
    protected $searchRepo;

    /**
     * Create a new controller instance.
     *
     * @param  SearchRepository  $searchRepo
     * @return void
     */
    public function __construct(SearchRepository $searchRepo)
    {
        $this->searchRepo = $searchRepo;
    }

    public function showIndex($query = null)
    {

		return $this->searchRepo->all();
    }
	
}
