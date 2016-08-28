<?php

namespace spec\App;

use App\Search;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class SearchSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType(Search::class);
    }

	public function it_should_search()
	{
		$this->find("John")->shouldBe(11);
	}

}


