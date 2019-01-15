<?php
/**
 * 加权轮询调度算法
 */

namespace Robin;

class WeightedRobin implements RobinInterface
{
    private $services = array();

    private $total;

    private $currentPos = -1;

    private $currentWeight;

    public function init(array $services)
    {
        foreach ($services as $ip => $weight) {
            $this->services[] = [
                'ip' => $ip,
                'weight' => $weight,
            ];
        }

        $this->total = count($this->services);
    }

    public function next()
    {
        $i = $this->currentPos;
        while (true) {
            $i = ($i + 1) % $this->total;

            // 已全部被遍历完一次
            if (0 === $i) {
                // 减currentWeight
                $this->currentWeight -= $this->getGcd();

                // 赋值currentWeight为0,回归到初始状态
                if ($this->currentWeight <= 0) {
                    $this->currentWeight = $this->getMaxWeight();
                }
            }

            // 直到当前遍历实例的weight大于或等于currentWeight
            if ($this->services[$i]['weight'] >= $this->currentWeight) {
                $this->currentPos = $i;

                return $this->services[$this->currentPos]['ip'];
            }
        }
    }

    /**
     * 求两数的最大公约数(基于欧几里德算法,可使用gmp_gcd())
     *
     * @param integer $a
     * @param integer $b
     *
     * @return integer
     */
    private function gcd($a, $b)
    {
        $rem = 0;
        while ($b) {
            $rem = $a % $b;
            $a = $b;
            $b = $rem;
        }

        return $a;
    }

    /**
     * 获取最大公约数
     *
     * @return integer
     */
    private function getGcd()
    {
        $gcd = $this->services[0]['weight'];

        for ($i = 0; $i < $this->total; $i++) {
            $gcd = $this->gcd($gcd, $this->services[$i]['weight']);
        }

        return $gcd;
    }

    /**
     * 获取最大权重值
     *
     * @return integer
     */
    private function getMaxWeight()
    {
        $maxWeight = 0;
        foreach ($this->services as $node) {
            if ($node['weight'] >= $maxWeight) {
                $maxWeight = $node['weight'];
            }
        }

        return $maxWeight;
    }

}
