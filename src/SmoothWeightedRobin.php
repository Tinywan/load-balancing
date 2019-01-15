<?php
/**
 * 平滑加权轮询调度算法
 * https://github.com/phusion/nginx/commit/27e94984486058d73157038f7950a0a36ecc6e35
 */

namespace Robin;

class SmoothWeightedRobin implements RobinInterface
{
    private $services = array();

    private $total;

    private $currentPos = -1;

    public function init(array $services)
    {
        foreach ($services as $ip => $weight) {
            $this->services[] = [
                'ip' => $ip,
                'weight' => $weight,
                'current_weight' => $weight,
            ];
        }

        $this->total = count($this->services);
    }

    public function next()
    {
        // 获取最大当前有效权重的实例位置
        $this->currentPos = $this->getMaxCurrentWeightPos();

        // 当前权重减去权重和
        $currentWeight = $this->getCurrentWeight($this->currentPos) - $this->getSumWeight();
        $this->setCurrentWeight($this->currentPos, $currentWeight);

        // 每个实例的当前有效权重加上配置权重
        $this->recoverCurrentWeight();

        return $this->services[$this->currentPos]['ip'];
    }

    /**
     * 获取最大当前有效权重实例位置
     *
     * @return int
     */
    public function getMaxCurrentWeightPos()
    {
        $currentWeight = $pos = 0;
        foreach ($this->services as $index => $service) {
            if ($service['current_weight'] > $currentWeight) {
                $currentWeight = $service['current_weight'];
                $pos = $index;
            }
        }

        return $pos;
    }

    /**
     * 配置权重和
     *
     * @return integer
     */
    public function getSumWeight()
    {
        $sum = 0;
        foreach ($this->services as $service) {
            $sum += $service['weight'];
        }

        return $sum;
    }

    /**
     * 设置当前有效权重
     *
     * @param integer $pos
     * @param integer $weight
     */
    public function setCurrentWeight($pos, $weight)
    {
        $this->services[$pos]['current_weight'] = $weight;
    }

    /**
     * 获取当前有效权重
     *
     * @param integer $pos
     *
     * @return integer
     */
    public function getCurrentWeight($pos)
    {
        return $this->services[$pos]['current_weight'];
    }

    /**
     * 用配置权重调整当前有效权重
     */
    public function recoverCurrentWeight()
    {
        foreach ($this->services as $index => &$service) {
            $service['current_weight'] += $service['weight'];
        }
    }

}
