<?php

namespace data_structures;

use LinkedList;
use Node;

require 'linked_list/LinkedList.php';
require 'linked_list/Node.php';

class Queue extends LinkedList
{
    public function enqueue($value): Node
    {
        return $this->add($value);
    }

    public function dequeue()
    {
        return $this->popHead();
    }

    public function peak()
    {
        return $this->head?->value;
    }

}
