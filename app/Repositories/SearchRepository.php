<?php

namespace App\Repositories;

interface SearchRepository
{

   /**
    * Gets all the records in the system.
    *
    * @return \Illuminate\Database\Eloquent\Collection|null
    */
   public function all();

   /**
    * Finds a list of results that matches the word among all tables in the system.
    *
    * @return \Illuminate\Database\Eloquent\Collection|null
    */
   public function find($query);

   /**
    * Finds a list of results that closely matches the word among all tables in the system.
    *
    * @return \Illuminate\Database\Eloquent\Collection|null
    */
   public function fuzzy_find($query);

   /**
    * A big script to read a XML file from USA OFAC, parse it then insert to DB
    *
    * @return \Illuminate\Database\Eloquent\Collection|null
    */
   public function bulk_insert();

   /**
    * Returns the record.
    *
    * @return \Illuminate\Database\Eloquent\Collection|null
    */
   public function first($query);
}
