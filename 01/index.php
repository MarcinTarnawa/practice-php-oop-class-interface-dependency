<?php

class Counter
{

    public function __construct(private $amount)
    {
        return $amount;
    }

    public function getCount()
    {
        echo $this->amount . ", ";
    }

    public function inkrement()
    {
        return $this->amount++;
    }

    public function decrement()
    {
        return $this->amount--;
    }
}

$test = new Counter(2);
$test->getCount();
$test->inkrement();
$test->inkrement();
$test->inkrement();
$test->getCount();
$test->decrement();
$test->getCount();
$test->inkrement();
$test->inkrement();
$test->inkrement();
$test->getCount();
$test->decrement();
$test->getCount();
