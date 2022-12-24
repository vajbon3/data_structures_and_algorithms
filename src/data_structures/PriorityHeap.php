<?php

namespace data_structures;

class PriorityHeap
{
    private array $array = [];
    private int $lastIdx = -1;

    // comparison function can make this Priority heap either a MinHeap or a MaxHeap
    public $comparison;

    public function __construct(callable $comparison)
    {
        // save passed comparison function inside a property
        $this->comparison = $comparison;
    }

    public function insert(mixed $num): int
    {
        // insert to internal array
        $this->array[++$this->lastIdx] = $num;

        // bubble up
        $this->bubbleUp($this->lastIdx);

        return $this->lastIdx;
    }

    public function getRoot() {
        // if heap is empty
        if($this->lastIdx < 0) {
            throw new \OutOfBoundsException('heap is empty!');
        }

        $min = $this->array[0];

        // set last element as root instead
        $this->array[0] = $this->array[$this->lastIdx];

        // decrement last index of the root so that it is rewritten on next write
        $this->lastIdx--;

        // bubble down head to its correct position
        $this->bubbleDown();

        return $min;
    }

    public function bubbleUp(int $idx): int
    {
        while($idx > 0) {
            // if at right place
            if(call_user_func($this->comparison,$this->array[$this->parent($idx)],$this->array[$idx])) {
                break;
            }

            // swap with parent
            $this->swap($idx,$this->parent($idx));
            $idx = $this->parent($idx);
        }

        return $idx;
    }

    private function bubbleDown(): void
    {
        $idx = 0;

        while($idx < $this->lastIdx) {
            $priorityChild = $this->priorityChild($idx);

            // if no children or at right place already, break
            if($priorityChild > $this->lastIdx || call_user_func($this->comparison,$this->array[$idx],$this->array[$priorityChild])) {
                break;
            }

            // swap with min child
            $this->swap($idx,$priorityChild);
            $idx = $priorityChild;
        }
    }

    private function swap(int $idx, $parent): void
    {
        $backup = $this->array[$idx];
        $this->array[$idx] = $this->array[$parent];
        $this->array[$parent] = $backup;
    }

    private function parent(int $idx): int
    {
        return intdiv($idx,2);
    }

    private function priorityChild(int $idx): int
    {
        // if no children or only left child, return left child index
        if($idx * 2 > $this->lastIdx || $idx * 2 + 1 > $this->lastIdx) {
            return $idx * 2;
        }

        return call_user_func($this->comparison,$this->array[$idx * 2],$this->array[$idx * 2 + 1])
            ? $idx * 2 : $idx * 2 + 1;
    }
}
