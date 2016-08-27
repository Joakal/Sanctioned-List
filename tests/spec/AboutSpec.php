<?php

namespace spec\App\Http\Controllers;

use App\Http\Controllers\About;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class AboutSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType(About::class);
    }
}
