<?php

namespace App\Repositories;

use App\Repositories\SearchRepository;
use DB;

class SearchEloquentRepository implements SearchRepository
{
    public function all()
    {
/*
        $ofac = DB::table('ofac')->get();

        return view('search', ['ofac' => $ofac]);*/
        return DB::table('ofac')->get();
    }
}
