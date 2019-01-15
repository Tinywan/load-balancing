<?php

use Robin\Robin;

require_once '../Autoloader.php';

// 简单轮询
$services = [
    '192.168.10.1:2202',
    '192.168.10.2:2202',
    '192.168.10.3:2202',
    '192.168.10.4:2202',
];

$robin = new Robin();
$robin->init($services);

$nodes = [];
for ($i = 1; $i <= 20; $i++) {
    $node = $robin->next();
    $nodes[$i] = $node;
}

//var_export(array_count_values($nodes));
var_export($nodes);