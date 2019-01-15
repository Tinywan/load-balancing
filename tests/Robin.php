<?php
require_once dirname(dirname(__FILE__)).'/vendor/autoload.php';

$services = [
    '192.168.10.1',
    '192.168.10.2',
    '192.168.10.3'
];

$robin = new \Robin\Robin();
$robin->init($services);
$nodes = [];
for ($i = 1; $i <= count($services); $i++) {
    $node = $robin->next();
    $nodes[$i] = $node;
}
var_export($nodes);