<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Repositories\SearchRepository;
use Request;

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

    public function showIndex()
    {
		$query = Request::input('search');

		// Send request to db		
		$results = $this->searchRepo->bulk_insert();
		
		// Send request to db		
		$results = $this->searchRepo->find($query);

        return view('search', ['results' => $results, 'query' => $query]);
    }
	
}
