<?php

namespace App\Repositories;

interface SearchRepository
{

   /**
    * Gets all the users in the system.
    *
    * @return \Illuminate\Database\Eloquent\Collection|null
    */
   public function all();
}
