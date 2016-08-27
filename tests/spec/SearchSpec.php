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

	public function it_should_sum()
	{
		$this->sum(4, 7);
		$this->result()->shouldBe(11);
	}

}


