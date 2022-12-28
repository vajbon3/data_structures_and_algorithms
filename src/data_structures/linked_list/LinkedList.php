<?php

require 'Node.php';

class LinkedList
{
    public ?Node $head = null;
    public ?Node $tail = null;

    public function add(mixed $value)
    {
        // if empty
        if(!$this->head) {
            $this->head = new Node($value);
            $this->tail = $this->head;
        }

        $this->tail->next = new Node($value);
        $this->tail = $this->tail->next;

        return $this->tail;
    }

    public function popHead()
    {
        $value = $this->head?->value;

        // if head was also tail - edge case
        if($this->head === $this->tail) {
            $this->tail = null;
        }

        $this->head = $this->head?->next;

        return $value;
    }

    public function empty(): bool {
        return is_null($this->head);
    }
}
