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
		//$results = $this->searchRepo->bulk_insert();
		
		// Send request to db		
		$results = $this->searchRepo->fuzzy_find($query);

        return view('search', ['results' => $results, 'query' => $query]);
    }

    public function showDetail($query)
    {
		
		// Send request to db		
		$result = $this->searchRepo->first($query);
		
		if(!$result){
			\App::abort(404, 'Record not found');
		}


        return view('detail', ['result' => $result, 'query' => $query]);
    }

    public function showBrowse($query = 'A')
    {
		
		// It must be one character for browsing.
		if(strlen($query) != 1){
			\App::abort(404);
		}

		// Send request to db		
		$results = \App\sdnEntry::where('lastName','like', $query.'%')->paginate(15); 

		if(!$results){
			\App::abort(404, 'Record not found');
		}


        return view('browse', ['results' => $results, 'query' => $query]);
    }
	
}
