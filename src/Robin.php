<?php

/**.-------------------------------------------------------------------------------------------------------------------
 * |  Github: https://github.com/Tinywan
 * |  Blog: http://www.cnblogs.com/Tinywan
 * |--------------------------------------------------------------------------------------------------------------------
 * |  Author: Tinywan(ShaoBo Wan)
 * |  DateTime: 2019/1/15 15:51
 * |  Mail: 756684177@qq.com
 * |  Desc: 轮询调度算法
 * '------------------------------------------------------------------------------------------------------------------*/

namespace Robin;

class Robin implements RobinInterface
{
    private $services = [];

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
