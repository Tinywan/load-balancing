<?php

use Robin\SmoothWeightedRobin;

require_once '../Autoloader.php';

// 平滑加权轮询
$services = [
    '192.168.10.1:2202' => 5,
    '192.168.10.2:2202' => 1,
    '192.168.10.3:2202' => 1,
];

$robin = new SmoothWeightedRobin();
$robin->init($services);

$nodes = [];
for ($i = 1; $i <= 20; $i++) {
    $node = $robin->next();
    $nodes[$i] = $node;
}

//var_export(array_count_values($nodes));
var_export($nodes);