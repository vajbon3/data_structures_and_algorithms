<?php

namespace Data_structures\Trie;

require 'TrieNode.php';

class Trie
{
    private TrieNode $root;

    public function __construct()
    {
        $this->root = new TrieNode();
    }

    // add a word to the Trie ( prefix tree )
    public function insertWord(string $word): void
    {
        // make string iterable by converting it into a character array
        $charArray = str_split($word);

        // start traversing from root
        $node = $this->root;

        foreach($charArray as $char) {
            // if char does not exist in children, create a new trienode for the character
            if(!array_key_exists($char,$node->children)) {
                $node->children[$char] = new TrieNode($char);
            }

            // traverse down the tree
            $node = $node->children[$char];
        }

        // set the property for current node indicating that it is a last character
        $node->terminating = true;
    }

    public function startsWith(string $prefix) {
        // make string iterable by converting it into a character array
        $charArray = str_split($prefix);

        // start traversing from root
        $node = $this->root;

        // traverse down until we get to the node where prefix ends and words with that prefix start
        foreach($charArray as $char) {
            // if character exists in children: traverse, else: return empty array since prefix does not exist
            // inside the tree
            if(array_key_exists($char,$node->children)) {
                $node = $node->children[$char];
            } else {
                return [];
            }
        }

        // after traversing down to the right place, collect all the words stemming from there
        $bucket = [];
        $this->collectWords($node,$bucket,$prefix);

        return $bucket;
    }

    private function collectWords(TrieNode $node,&$bucket,String $prefix) : void
    {
        // if at an end for a word - add the word to the bucket
        if($node->terminating) {
            $bucket[] = $prefix;
        }

        // if empty prefix - set to current node's char
        $prefix = $prefix ?? $node->char;

        // iterate over children and recurse deeper
        foreach($node->children as $child) {
            $this->collectWords($child,$bucket,$prefix . $child->char);
        }

    }
}
