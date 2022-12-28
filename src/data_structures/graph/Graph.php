<?php

namespace Data_structures\Graph;

use data_structures\Queue;

require '../Queue.php';

class Graph
{
    public array $nodes;

    public function insert(int $value): GraphNode
    {
        $this->nodes[$value] = new GraphNode($value);

        return $this->nodes[$value];
    }

    // depth-first search
    public static function dfs(?GraphNode $node,int $value): bool {
        if(!$node) {
            return false;
        }
        if($node->value === $value) {
            return true;
        }

        foreach($node->neighbors as $neighbor) {
            if(self::dfs($neighbor,$value)) {
                return true;
            }
        }

        return false;
    }

    public static function bfs(?GraphNode $node,int $value): bool {
        // if out of graph to traverse :(
        if(!$node) {
            return false;
        }

        // queue for FIFO node retrieval for necessary for BFS
        $queue = new Queue();

        // add root to queue and mark as visited
        $queue->enqueue($node);

        // visited array
        $visited = [];
        $visited[] = $node;

        while(!$queue->empty()) {
            $first = $queue->dequeue();

            // if right value was found
            if($first->value === $value) {
                return true;
            }

            foreach($first->neighbors as $neighbor) {
                if(!in_array($neighbor, $visited, true)) {
                    // enqueue for further processing and mark as visited
                    $queue->enqueue($neighbor);
                    $visited[] = $neighbor;
                }
            }
        }

        return false;
    }
}
