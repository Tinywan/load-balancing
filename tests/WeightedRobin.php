<?php
/**.-------------------------------------------------------------------------------------------------------------------
 * |  Github: https://github.com/Tinywan
 * |  Blog: http://www.cnblogs.com/Tinywan
 * |--------------------------------------------------------------------------------------------------------------------
 * |  Author: Tinywan(ShaoBo Wan)
 * |  DateTime: 2019/1/15 16:07
 * |  Mail: 756684177@qq.com
 * |  Desc: 描述信息
 * '------------------------------------------------------------------------------------------------------------------*/

require_once dirname(dirname(__FILE__)).'/vendor/autoload.php';

// 加权轮询
$services = [
    '192.168.10.1' => 6,
    '192.168.10.2' => 2,
    '192.168.10.3' => 1,
    '192.168.10.4' => 1,
];

$robin = new \Robin\WeightedRobin();
$robin->init($services);

$nodes = [];
for ($i = 1; $i <= 10; $i++) {
    $node = $robin->next();
    $nodes[$i] = $node;
}
var_export($nodes);