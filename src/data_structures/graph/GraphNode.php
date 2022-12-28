<?php

namespace Data_structures\Graph;

class GraphNode
{
    public int $value;
    public array $neighbors;

    public function __construct($value)
    {
        $this->value = $value;
    }
}
