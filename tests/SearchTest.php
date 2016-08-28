<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class SearchTest extends TestCase
{
    /**
     * A basic functional test example.
     *
     * @return void
     */

    public function testBasicExample()
    {
        $this->visit('/')
             ->see('Sanction Search');
    }

}

