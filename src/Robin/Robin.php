<?php
/**
 * 轮询调度算法
 */
namespace Robin;

class Robin implements RobinInterface
{
    private $services = array();

    private $total;

    private $currentPos = -1;

    public function init(array $services)
    {
        $this->services = $services;
        $this->total = count($services);
    }

    public function next()
    {
        // 已调度完一圈,重置currentPos值为第一个实例位置
        $this->currentPos = ($this->currentPos + 1) % $this->total;

        return $this->services[$this->currentPos];
    }

}