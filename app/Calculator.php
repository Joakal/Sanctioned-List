<?php

namespace App;

class Calculator
{
    public function sum($argument1, $argument2)
    {
        $this->result = (int)$argument1 + (int)$argument2;
    }

    public function result()
    {
        return $this->result;
    }
}
