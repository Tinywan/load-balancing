<?php

use Robin\WeightedRobin;

require_once '../Autoloader.php';

// 加权轮询
$services = [
    '192.168.10.1:2202' => 6,
    '192.168.10.2:2202' => 2,
    '192.168.10.3:2202' => 1,
    '192.168.10.4:2202' => 1,
];

$robin = new WeightedRobin();
$robin->init($services);

$nodes = [];
for ($i = 1; $i <= 20; $i++) {
    $node = $robin->next();
    $nodes[$i] = $node;
}

//var_export(array_count_values($nodes));
var_export($nodes);