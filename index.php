<?php
namespace app;

use data_structures\PriorityHeap;

require 'src/data_structures/PriorityHeap.php';

$PriorityHeap = new PriorityHeap(fn($a, $b) => $a > $b);

$PriorityHeap->insert(2);
$PriorityHeap->insert(10);
$PriorityHeap->insert(5);
$PriorityHeap->insert(1);
$PriorityHeap->insert(6);

print($PriorityHeap->getRoot() . PHP_EOL);
print($PriorityHeap->getRoot() . PHP_EOL);
print($PriorityHeap->getRoot() . PHP_EOL);
print($PriorityHeap->getRoot() . PHP_EOL);
print($PriorityHeap->getRoot() . PHP_EOL);
print($PriorityHeap->getRoot() . PHP_EOL);

