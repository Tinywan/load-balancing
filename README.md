### Introduction（介绍）

用 PHP 实现几种负载均衡调度算法，详细见 [负载均衡算法](https://www.fanhaobai.com/2018/11/load-balance-round-robin.html) 系列。[fork](https://github.com/fan-haobai/load-balance)

### Scheduling Algorithm （调度算法）

*   [普通轮询（general Round Robin）](https://github.com/Tinywan/load-polling/blob/master/src/Robin.php)
*   [加权轮询（Weighted Round Robin）](https://github.com/Tinywan/load-polling/blob/master/src/WeightedRobin.php)
*   [平滑加权轮询（Smooth Weighted Round Robin）](https://github.com/Tinywan/load-polling/blob/master/src/SmoothWeightedRobin.php)

### Install  

```composer log
composer require tinywan/load-balancing
```

### Basic Usage  

```php
// 服务器数
$services = [
    '192.168.10.1' => 5,
    '192.168.10.2' => 1,
    '192.168.10.3' => 1,
];

// 使用平滑加权算法 (Smooth Weighted Round Robin)
$robin = new \Robin\SmoothWeightedRobin();
$robin->init($services);

$nodes = [];
$sumWeight = $robin->getSumWeight();
for ($i = 1; $i <= $sumWeight; $i++) {
    $node = $robin->next();
    $nodes[$i] = $node;
}
var_export($nodes);

// 会生成如下均匀序列
array (
  1 => '192.168.10.1',
  2 => '192.168.10.1',
  3 => '192.168.10.2',
  4 => '192.168.10.1',
  5 => '192.168.10.3',
  6 => '192.168.10.1',
  7 => '192.168.10.1',
)
```

### Help

*   [负载均衡算法](https://github.com/fan-haobai/load-balance)  
*   [负载均衡算法 — 轮询](https://www.fanhaobai.com/2018/11/load-balance-round-robin.html)  
*   [负载均衡算法 — 平滑加权轮询](https://www.fanhaobai.com/2018/11/load-balance-smooth-weighted-round-robin.html)  
*   [Nginx的负载均衡 - 加权轮询 (Weighted Round Robin) 上篇](https://blog.csdn.net/zhangskd/article/details/50194069)  
*   [Nginx的负载均衡 - 加权轮询 (Weighted Round Robin) 下篇](https://blog.csdn.net/zhangskd/article/details/50197929)  
*   [Composer/Packagist包](https://www.chenjie.info/1880)  
