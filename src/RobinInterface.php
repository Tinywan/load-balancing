<?php
/**
 * 调度算法接口
 */
namespace Robin;

interface RobinInterface
{
    /**
     * 初始化服务权重
     *
     * @param array $services
     */
    public function init(array $services);

    /**
     * 获取一个服务
     *
     * @return string
     */
    public function next();

}
