<?php

class Node
{
    public mixed $value;
    public ?Node $next = null;
    public ?Node $prev = null;

    public function __construct($value)
    {
        $this->value = $value;
    }
}
