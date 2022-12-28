<?php

namespace Data_structures\Trie;

class TrieNode
{
    public ?string $char;
    public array $children = [];
    public bool $terminating = false;

    public function __construct($char = null)
    {
        $this->char = $char;
    }
}
