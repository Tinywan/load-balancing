# 负载均衡算法

## 介绍

用 PHP 实现几种负载均衡调度算法，详细见 [负载均衡算法](https://www.fanhaobai.com/2018/11/load-balance-round-robin.html) 系列。

![预览图](https://img1.fanhaobai.com/2018/11/load-balance-round-robin/1e858872-6235-4131-98ba-433690eb32c1.jpg)

## 调度算法

### 轮询

* [普通轮询](https://github.com/fan-haobai/load-balance/blob/master/Robin/Robin.php)
* [加权轮询](https://github.com/fan-haobai/load-balance/blob/master/Robin/WeightedRobin.php)
* [平滑加权轮询](https://github.com/fan-haobai/load-balance/blob/master/Robin/SmoothWeightedRobin.php)

## 快速使用

```PHP
use Robin\SmoothWeightedRobin;

require_once '/Autoloader.php';

// 加权轮询
$services = [
    '192.168.10.1:2202' => 5,
    '192.168.10.2:2202' => 1,
    '192.168.10.3:2202' => 1,
];

// 使用平滑加权算法
$robin = new SmoothWeightedRobin();
$robin->init($services);

$nodes = [];
for ($i = 1; $i <= 7; $i++) {
    $node = $robin->next();
    $nodes[$i] = $node;
}

//var_export(array_count_values($nodes));
var_export($nodes);
```

## 调度结果

使用平滑加权算法调度，会生成如下均匀序列：

```Bash
'192.168.10.1:2202'
'192.168.10.1:2202'
'192.168.10.2:2202'
'192.168.10.1:2202'
'192.168.10.3:2202'
'192.168.10.1:2202'
'192.168.10.1:2202'
```

## Composer

安装错误`Could not find package tinywan/load-polling in a version matching 1.0`
尝试改成Packagist的地址 https://packagist.org
```composer log
"repositories": {
    "packagist": {
        "type": "composer",
        "url": "https://packagist.org"
    }
}
```